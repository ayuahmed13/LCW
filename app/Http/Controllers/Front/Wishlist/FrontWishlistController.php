<?php

namespace App\Http\Controllers\Front\Wishlist;

use App\Models\Cart;
use App\Models\Products;
use App\Models\CartProduct;
use App\Models\UserWishlist;
use Illuminate\Http\Request;
use App\Models\Front\UserRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class FrontWishlistController extends Controller
{
    public function index(Request $request){
        $user_id = Auth::guard('master_users')->id();
        $select = array(
            'id',
            "profile_image",
            "full_name",
            "email",
            "phone_no",
            "company_name",
        );
        $data = UserRegister::where('id',$user_id)->select($select)->first();

        $product_list = UserWishlist::where('user_wishlists.status', 'active')
                    ->join('products', 'user_wishlists.product_id', '=', 'products.id')
                    ->where('user_wishlists.user_id', $user_id)
                    ->where('products.status','!=', 'delete')
                    ->select(
                        'user_wishlists.id',
                        'products.slug_url',
                        'products.id as pid',
                        'products.current_stock',
                        'products.product_name',
                        'products.product_main_image',
                        'products.price',
                        'products.offer_price',
                        'products.status',
                        'products.is_available',
                        'products.category_id',
                        'products.sub_category_id',
                        'products.sub_sub_category_id'
                    )
                    ->get();
        // check product incart
        if(!empty($user_id)){
            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            if(!empty($cart)){
                $cart_id = $cart->id;
                $productIds = CartProduct::where('cart_id', $cart_id)
                         ->where('status', 'active')
                         ->pluck('product_id')
                         ->toArray();
            }
        }
        $cart_product_ids = !empty($productIds)?$productIds:'';
        return view('Front.wishlist',compact('data','product_list','cart_product_ids'));
    }

    public function AddToWishlist(Request $request){
        $user_id = Auth::guard('master_users')->id();
        $product_id = Crypt::decrypt($request->product_id);
        
        $input['user_id'] = $user_id;
        $input['product_id'] = $product_id;
        $input['created_by'] = $user_id;
        $input['created_ip_address'] = $request->ip();

        $exists = UserWishlist::where('status','active')->where('product_id',$product_id)->where('user_id',$user_id)->first();
        if(!empty($exists->id)){
            return response()->json([
                'message'=>'Already in wishlist',
                'status' => 404,
            ]);
        }

        $insert = UserWishlist::create($input);
         
        if(empty($insert->id)){
            return response()->json([
                'message'=>'Something went wrong',
                'status' => 404,
            ]);
        }else{
            return response()->json([
                'message'=>'Added to wishlist successfully',
                'status' => 200,
            ]);
        }
    }

    public function RemoveFromWishlistWithId(Request $request){
        $user_id = Auth::guard('master_users')->id();
        $id = Crypt::decrypt($request->id);
        
        $input['status'] = 'delete';
        $input['modified_by'] = $user_id;
        $input['modified_ip_address'] = $request->ip();

       $update =  UserWishlist::find($id)->update($input);

        return response()->json([
            'status' => 200,
            'message' => 'Removed from wishlist'
        ]);
        
    }

    public function RemoveFromWishlist(Request $request){
        $user_id = Auth::guard('master_users')->id();
        
        $product_id = $request->product_id;

        $input['status'] = 'delete';
        $input['modified_by'] = $user_id;
        $input['modified_ip_address'] = $request->ip();
        if(!empty($product_id)){
            $update =  UserWishlist::where('user_id',$user_id)->where('product_id',$product_id)->where('status','active')->update($input);
        }else{
            $id = Crypt::decrypt($request->id);
            $update =  UserWishlist::find($id)->update($input);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Removed from wishlist'
        ]);
        
    }
}
