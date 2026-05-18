<?php

namespace App\Http\Controllers\Front\Cart;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class FrontCartController extends Controller
{
    public function index(Request $request){
        $user_id = Auth::guard('master_users')->id();
        
        return view('Front.shopping-cart');
    }
    public function addToCartAjax(Request $request)
    {
        $user_id = Auth::guard('master_users')->id();

        try {
            $user_id = Auth::guard('master_users')->id();

            $validatedData = $request->validate([
                'product_id' => 'required|integer',
                'product_qty' => 'required|integer|min:1',
            ]);

            // Find active cart for the user
            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();

            if (!$cart) {
                // Create a new cart if one doesn't exist
                $cart = Cart::create([
                    'user_id' => $user_id,
                    'status' => 'active',
                ]);
            }

            $cart_id = $cart->id;

            // Check if product is already in the cart
            $existingCartProduct = CartProduct::where('cart_id', $cart_id)
                                            ->where('product_id', $validatedData['product_id'])
                                            ->where('status', 'active')
                                            ->first();

            if ($existingCartProduct) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This product is already in the cart.',
                ], 200);
            }

            // Add product to the cart
            CartProduct::create([
                'cart_id' => $cart_id,
                'user_id' => $user_id,
                'product_id' => $validatedData['product_id'],
                'product_qty' => $validatedData['product_qty'],
                'status' => 'active',
                'created_by' => $user_id,
                'created_ip_address' => $request->ip()
            ]);

            $cart = Cart::where('user_id', $user_id)
            ->where('status', 'active')
            ->first();

            if ($cart) {
                $cart_count = CartProduct::where('cart_id', $cart->id)
                                        ->where('status', 'active')
                                        ->count();
                Session::put('cart_count', $cart_count);
            } else {
                // In case the cart doesn't exist or is empty, set cart_count to 0
                Session::put('cart_count', 0);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully.',
            ]);

        }  catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while adding the product.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function RemoveFromCart(Request $request){
        $user_id = Auth::guard('master_users')->id();
        
        $id = Crypt::decrypt($request->id);
        $setData=[
            'status' =>'delete',
            'modified_by' =>'',
            'modified_ip_address' =>$user_id,
        ];
        if(!empty($id)){
            $cart = Cart::where('id', $id)
                        ->where('status', 'active')
                        ->update($setData);
            return response()->json([
                'status' => 'success',
                'message' => 'Product removed from cart successfully.',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.',
            ]);
        
        }  
    }

    public function afterLoginSyncCartBackup(Request $request)
    {
        $user = Auth::guard('master_users')->user();

        $sessionCart = session('cart', []);
        if (empty($sessionCart)) {
            return;
        }

        // Find or create active cart for user
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
            'status' => 'active'
        ]);

        foreach ($sessionCart as $productId => $item) {
            // Avoid duplicates
            $existing = CartProduct::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->where('status', 'active')
                ->first();

            if (!$existing) {
                CartProduct::create([
                    'cart_id' => $cart->id,
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'product_qty' => $item['quantity'],
                    'status' => 'active',
                    'created_by' => $user->id,
                    'created_ip_address' => $request->ip(),
                ]);
            }
        }

        // Clear session cart
        Session::forget('cart');

        // Update session cart count
        $cart_count = CartProduct::where('cart_id', $cart->id)
            ->where('status', 'active')
            ->count();
        Session::put('cart_count', $cart_count);
    }

    
}
