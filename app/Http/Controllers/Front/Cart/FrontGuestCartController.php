<?php

namespace App\Http\Controllers\Front\Cart;

use App\Models\Cart;
use App\Models\Products;
use App\Models\CartProduct;
use App\Models\UserWishlist;
use Illuminate\Http\Request;
use App\Models\Master\GstMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontGuestCartController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_id = Auth::guard('master_users')->id();

        if(!empty($user_id)){
            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            $product_ids = array();

            if(!empty($cart)){
                $cart_id = $cart->id;
                $cart_products = CartProduct::select(
                                                'cart_products.id as key_id',
                                                'cart_products.product_qty as quantity',
                                                'products.id', 
                                                'products.product_name as name', 
                                                'products.slug_url',
                                                'products.product_main_image',
                                                'products.offer_price as price',
                                                'products.is_gst',
                                                'products.status as product_status',
                                                'products.is_available',
                                                'products.current_stock',
                                                'products.gst_id',
                                                 ) // add needed fields
                    ->join('products', 'cart_products.product_id', '=', 'products.id')
                    ->where('cart_products.cart_id', $cart_id)
                    ->where('products.status','!=', 'delete')
                    ->where('cart_products.status', 'active') 
                    ->get()->toArray();
                    $sub_total_without_tax = 0;
                    // Get latest active gst value  
                    $gst_data = GstMaster::where('status','active')
                                    ->select('id','gst_value')
                                    ->orderBy('id','desc')
                                    ->first();
                    foreach($cart_products as $key => $value){
                        $cart_products[$key]['qty'] = $value['quantity'];
                        array_push($product_ids,$value['id']);
                        if(!empty($value['price'])){
                            $sub_total_without_tax += $value['price']*$value['quantity'];
                        }
                        // Common gst used for all prducts
                        //  $gst_data = GstMaster::where('id',$value['gst_id'])
                        //             ->where('status','active')
                        //             ->select('id','gst_value')
                        //             ->orderBy('id','desc')
                        //             ->first();
                         //$gst_per = !empty($gst_data->gst_value)?$gst_data->gst_value:18;

                        if(!empty(($value['is_gst']) && $value['is_gst']=='yes') || !empty($gst_data)){
                            // $gst_data = GstMaster::where('id',$value['gst_id'])
                            //                 ->where('status','active')
                            //                 ->select('id','gst_value')
                            //                 ->first();
                            //$gst_per = !empty($gst_data->gst_value)?$gst_data->gst_value:18;
                            
                            //if gst is not avail then default value is 18%

                            $gst_per = !empty($gst_data->gst_value)?$gst_data->gst_value:18;
                            $gst_val = $sub_total_without_tax*$gst_per/100;
                            $sub_total_with_tax =  $sub_total_without_tax + ($sub_total_without_tax*$gst_per/100);
                            
                            $value['tax_per'] = $gst_per;
                            $value['tax_amount'] = $gst_val;
                        }else{
                            $sub_total_with_tax =  $sub_total_without_tax + ($sub_total_without_tax*18/100);
                        }
                        $value['sub_total_with_tax'] = $sub_total_with_tax;
                  
                    }
                    // $cart_alert = '';
                    // if(!empty($is_not_available)){
                    //     $cart_alert = 'Some of the products in cart are not available.';
                    // }
                    $gst_per = !empty($gst_data->gst_value)?$gst_data->gst_value:18;
                    $gst_val = $sub_total_without_tax*$gst_per/100;
                    $sub_total_with_tax =  $sub_total_without_tax + ($sub_total_without_tax*$gst_per/100);
                        
            }else{

            }
        }else{
            $cart_products = session()->get('cart', []);
            $product_ids = array_keys($cart_products);
            $sub_total_without_tax = 0;

            foreach($cart_products as $key => $value){
                $tdata = Products::where('status','active')
                            ->where('id',$key)
                            ->select(
                                        'products.id', 
                                        'products.product_name as name', 
                                        'products.slug_url',
                                        'products.product_main_image',
                                        'products.offer_price as price',
                                        'products.is_gst',
                                        'products.status as product_status',
                                        'products.is_available',
                                        'products.current_stock',
                                        'products.gst_id',
                                    )
                            ->first();
                if(!empty($tdata)){
                    $cart_products[$key]['key_id'] = $key;
                    $cart_products[$key]['slug_url'] = $tdata->slug_url;
                    $cart_products[$key]['id'] = $tdata->id;
                    $cart_products[$key]['qty'] = $value['quantity'];
                    $cart_products[$key]['product_name'] = $tdata->name;
                    $cart_products[$key]['offer_price'] = $tdata->offer_price;
                    $cart_products[$key]['product_main_image'] = $tdata->product_main_image;

                    $cart_products[$key]['is_gst'] = $tdata->is_gst;
                    $cart_products[$key]['product_status'] = $tdata->product_status;
                    $cart_products[$key]['is_available'] = $tdata->is_available;
                    $cart_products[$key]['current_stock'] = $tdata->current_stock;
                    $cart_products[$key]['gst_id'] = $tdata->gst_id;

                    if(!empty($value['price'])){
                        $sub_total_without_tax += $value['price']*$value['quantity'];
                    }

                }else{
                    $cart_products[$key]['status'] = 'delete';
                }
                $gst_data = GstMaster::where('status','active')
                                    ->select('id','gst_value')
                                    ->orderBy('id','desc')
                                    ->first();
                $gst_per = !empty($gst_data->gst_value)?$gst_data->gst_value:18;
                $gst_val = $sub_total_without_tax*$gst_per/100;
                $sub_total_with_tax =  $sub_total_without_tax + ($sub_total_without_tax*$gst_per/100);
                   
            }
        }
       
        $cart_products = !empty($cart_products)?$cart_products:array();
        $related_products = Products::where('status', 'active')
                                            ->whereNotIn('id', $product_ids)
                                            ->select(
                                                'id',
                                                'slug_url', 
                                                'product_name', 
                                                'product_main_image', 
                                                'price', 'offer_price',
                                                'status','category_id','sub_category_id',
                                                'sub_sub_category_id',
                                                'current_stock'
                                                )
                                            ->where('is_available', 'available')
                                            ->orderBy('id','desc')
                                            ->limit(4)
                                            ->get();
        if(!empty($user_id)){
            $product_ids_list = UserWishlist::where('status', 'active')
                    ->where('user_id', $user_id)
                    ->pluck('product_id')
                    ->toArray();
        }
        $wishlist_product_ids = !empty($product_ids_list)?$product_ids_list:'';
         if(empty($cart) && !empty($user_id)){
            $cart_products ='';
            $sub_total_without_tax ='';
            // $cart_products ='';
            // $cart_products ='';
        return view('Front.shopping-cart', compact('cart_products','sub_total_without_tax','related_products','wishlist_product_ids'));
            
        }else if(empty($cart_products)){
        return view('Front.shopping-cart', compact('cart_products','sub_total_without_tax','related_products','wishlist_product_ids'));

        }
        
        return view('Front.shopping-cart', compact('cart_products','sub_total_without_tax','related_products','wishlist_product_ids','gst_per','gst_val','sub_total_with_tax'));
    }
    public function addAjax(Request $request)
    {
         $request->validate([
            'id' => 'required',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);
        $productId = $request->input('id');
        $name = $request->input('name');
        $price = $request->input('price');
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                "name" => $name,
                "price" => $price,
                "quantity" => $quantity
            ];
        }

        session()->put('cart', $cart);
        session()->put('cart_count', count($cart));

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart.',
            'cartCount' => count($cart),
        ]);
    }

    public function remove(Request $request)
    {
        $productId = $request->input('id');

        $user_id = Auth::guard('master_users')->id();

        if(!empty($user_id)){
             $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            if(!empty($cart)){

                CartProduct::where('id', $productId)
                                ->where('user_id', $user_id)
                                ->where('cart_id', $cart->id)
                                ->delete();
                $cart = CartProduct::where('user_id', $user_id)
                                ->where('cart_id', $cart->id)
                                ->get();
                session()->put('cart_count', count($cart));
                
                return response()->json([
                    'status' => 'success',
                    'cartrow_id' => $productId,
                    'message' => 'Product removed from cart.',
                    'cartCount' => count($cart),
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product removed from cart.',
                    'cartCount' => 0,
                ]);        
            }
        }else{
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
                session()->put('cart_count', count($cart));
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product removed from cart.',
            'cartCount' => count($cart),
        ]);
    }

    public function clear()
    {
        session()->forget('cart');
       
        return response()->json([
            'status' => 'success',
            'message' => 'Empty cart.',
            'cartCount' => 0,
        ]);
    }

     public function updateQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $name = $request->input('name');
        $price = $request->input('price');
        $userId = Auth::guard('master_users')->id();

        if ($userId) {
            // Get or create user's active cart
            $cart = Cart::firstOrCreate(
                ['user_id' => $userId, 'status' => 'active'],
                ['status' => 'active']
            );

            // Try to find existing product in the cart
            $cartProduct = CartProduct::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->where('status', 'active')
                ->first();

            if ($cartProduct) {
                // ✅ Product exists in cart → update quantity
                $cartProduct->update([
                    'product_qty' => $quantity,
                ]);
            } else {
                // 🆕 Product not in cart → create new entry
                CartProduct::create([
                    'cart_id' => $cart->id,
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'product_qty' => $quantity,
                    'status' => 'active',
                    'created_by' => $userId,
                    'created_ip_address' => $request->ip(),
                ]);
            }

            // Update cart count
            $cart_count = CartProduct::where('cart_id', $cart->id)
                ->where('status', 'active')
                ->count();
            Session::put('cart_count', $cart_count);

        } else {
            // 🧑‍🦱 Guest user: session cart
            $cart = session()->get('cart', []);

            if (!isset($cart[$productId])) {
                // Add product if not exists
                // (You may want to fetch product info from DB)
                // $cart[$productId] = [
                //     'name' => 'Unknown Product', // Or pull from DB if needed
                //     'price' => 0,
                //     'quantity' => $quantity
                // ];
                $cart[$productId] = [
                    "name" => $name,
                    "price" => $price,
                    "quantity" => $quantity
                ];
            } else {
                // Update existing quantity
                $cart[$productId]['quantity'] = $quantity;
            }

            session()->put('cart', $cart);
            session()->put('cart_count', count($cart));

        }

        return response()->json([
            'status' => 'success',
            'message' => 'Quantity updated (or added) successfully.'
        ]);
    }

    public function EmptyCart(Request $request){
       
        $user_id = Auth::guard('master_users')->id();
        if(!empty($user_id)){
            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            if(!empty($cart->id)){
                Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->delete();
                Session::put('cart_count', 0);
            }else{

            }
            return redirect('shopping-cart')->with('success','Cart cleared successfully');
        }else{
            Session::forget('cart');  
            Session::put('cart_count', 0);

            return redirect('shopping-cart')->with('success','Cart cleard successfully');
        }

        return redirect('shopping-cart')->with('success','Cart updated successfully');
    }
}
