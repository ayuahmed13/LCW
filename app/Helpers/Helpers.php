<?php

namespace App\Helpers\Helpers;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Master\Master_admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\Role_privilege;
use App\Models\Master\Visual_setting;

class Helper {
    public static function getCreatedByName($Master_admin){
        return Master_admin::where('status', 'active')->where('id', $Master_admin)->first()->user_name;
    }
    public static function getCreatedAtDateTime($date){
        return Carbon::createFromTimestamp(strtotime($date))->setTimezone('Asia/Kolkata')->format('d-m-Y h:i A');
    }
    public static function getCreatedAtDate($date){
        return Carbon::createFromTimestamp(strtotime($date))->setTimezone('Asia/Kolkata')->format('d-m-Y');
    }
    public static function getTimeFormat($time){
        return Carbon::createFromTimestamp(strtotime($time))->format('h:i A');
    }
    public static function getRoleName(){
        return Role_privilege::where('status', 'active')->where('id', Auth::guard('master_admins')->user()->role_id)->first()->role_name;
    }
    public static function getVisualImages(){
        return Visual_setting::where('status', 'active')->first();
    }
    public static function getCartCount(){
        $user_id = Auth::guard('master_users')->id();

        if(!empty($user_id)){
             $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            if(!empty($cart)){

                $cart = CartProduct::where('user_id', $user_id)
                                ->where('cart_id', $cart->id)
                                ->get();
                session()->put('cart_count', count($cart));
                
                return session()->put('cart_count', count($cart));
            }
        }
    }
}