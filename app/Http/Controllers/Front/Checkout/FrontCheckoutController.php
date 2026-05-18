<?php

namespace App\Http\Controllers\Front\Checkout;

use App\Models\Cart;
use App\Models\Products;
use App\Models\CartProduct;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Master\GstMaster;
use App\Models\Master\CityMaster;
use App\Models\Master\StateMaster;
use App\Http\Controllers\Controller;
use App\Models\Master\CountryMaster;
use App\Models\Master\General_setting;
use App\Models\Master\PinCodeMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class FrontCheckoutController extends Controller
{
      public function index(Request $request){
        
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
                                                'products.status as product_status',
                                                'products.is_available',
                                                'products.current_stock',
                                                 
                                                 ) // add needed fields
                    ->join('products', 'cart_products.product_id', '=', 'products.id')
                    ->where('cart_products.cart_id', $cart_id)
                    ->where('products.status','!=', 'delete')
                    ->where('cart_products.status', 'active')
                    ->get()->toArray();
                    if(empty($cart_products)){
                        return redirect('shopping-cart')->with('error', 'Unable to checkout, your cart is empty..');
                    }
                    $sub_total_without_tax = 0;
                    foreach($cart_products as $key => $value){
                        $cart_products[$key]['qty'] = $value['quantity'];
                        array_push($product_ids,$value['id']);
                        if(!empty($value['price'])){
                            $sub_total_without_tax += $value['price']*$value['quantity'];
                        }
                    }
                    $gst_data = GstMaster::where('status','active')
                                    ->select('id','gst_value')
                                    ->orderBy('id','desc')
                                    ->first();
                    $gst_per = !empty($gst_data->gst_value)?$gst_data->gst_value:18;
                    $gst_val = $sub_total_without_tax*$gst_per/100;
                    $sub_total_with_tax =  $sub_total_without_tax + ($sub_total_without_tax*$gst_per/100);
                   
                    
                    // get address dropdown

                    $address_type_ddl = UserAddress::where('status','active')
                                        ->where('created_by',$user_id)
                                        ->select(
                                            "id",
                                            "address_heading",
                                        )
                                        ->orderBy('address_heading','asc')
                                        ->get();

                    //address
                    
                    $default_address = UserAddress::where('status','active')
                                        ->where('is_default','yes')
                                        ->where('created_by',$user_id)
                                        ->select(
                                                "address_heading",
                                                "name",
                                                "email",
                                                "phone", 
                                                "state", 
                                                "company", 
                                                "address",
                                                "city",
                                                "street",
                                                "appartment",
                                                "pincode",

                                                "country_id","state_id","city_id"

                                        )
                                        ->first();

                if(!empty($default_address->state_id)){
                    $country_list = CountryMaster::where('status','active')->where('id',$default_address->country_id)->select('id')->first();
                    $state_list = StateMaster::where('status','active')->where('country_id',$default_address->country_id)->select('id','state_name')->get();
                    $state_option = '<option value=""> -- Select State -- </option>';
                    if(!empty($state_list)){
                        foreach($state_list as $K =>$value){
                            
                            $selected = ($default_address->state_id == $value->id)?'selected':'';
                            $state_option .= '<option '.$selected.' data-id="'.$value->id.'" value="'.$value->state_name.'"> '.$value->state_name.' </option>';
                        }
                    }
                    $data['states'] = $state_option;
                    
                    $city_list = CityMaster::where('status','active')->where('state_id',$default_address->state_id)->select('id','city_name')->get();
                    $city_option = '<option value=""> -- Select city -- </option>';
                    if(!empty($city_list)){
                        foreach($city_list as $K =>$value){
                            $selected = ($default_address->city_id == $value->id)?'selected':'';
                            $city_option .= '<option '.$selected.' data-id="'.$value->id.'" value="'.$value->city_name.'"> '.$value->city_name.' </option>';
                        }
                    }
                    $data['citys'] = $city_option;
                    
                    $pincodes = PinCodeMaster::where('status','active')->where('city_id',$default_address->city_id)->select('id','pin_codes')->first();
                    $pins = explode(',',$pincodes->pin_codes);
                    $pincodes_options = '<option value=""> -- Select pincode -- </option>';
                    foreach($pins as $K =>$value){
                        $selected = ($default_address->pincode == $value)?'selected':'';
                        $pincodes_options .= '<option '.$selected.' value="'.$value.'"> '.$value.' </option>';
                    }
                    $data['pincodes'] = $pincodes_options;
                }else{
                    $data='';
                }

            }else{
                return redirect('shopping-cart')->with('error', 'Unable to checkout, your cart is empty..');
            }
        }else{
            $cart_products = session()->get('cart', []);
            $product_ids = array_keys($cart_products);
            $sub_total_without_tax = 0;
            if(empty($cart_products)){
                return redirect('shopping-cart')->with('error', 'Unable to checkout, your cart is empty..');
            }
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
                                        'products.gst_id')
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
            }
                $default_address = '';
                $data='';
                $address_type_ddl = '';

                $gst_data = GstMaster::where('status','active')
                                    ->select('id','gst_value')
                                    ->orderBy('id','desc')
                                    ->first();

                $gst_per = !empty($gst_data->gst_value)?$gst_data->gst_value:18;
                $gst_val = $sub_total_without_tax*$gst_per/100;
                $sub_total_with_tax =  $sub_total_without_tax + ($sub_total_without_tax*$gst_per/100);
                   
        }
        $country_region_list = CountryMaster::where('status','active')
                        ->orderBy('country_name','asc')
                        ->get();
        // bank details

        $bank_data = General_setting::where('status','active')
                        ->select([
                                'account_name',
                                'bsb',
                                'account_number',
                                'bank_name',
                                'swift_code',
                                'update_log',
                                'last_updated_date',
                        ])
                        ->first();
        return view('Front.checkout',compact('bank_data','cart_products','sub_total_without_tax','gst_per','gst_val','sub_total_with_tax','default_address','country_region_list','address_type_ddl','data'));
    }

    public function get_address_by_type(Request $request){
        
        $address_id = $request->address_id;

        $data['edit_address'] = UserAddress::where('status', '=', 'active')
                                    ->where('id',$address_id)
                                    ->select(
                                        'id', 'name', 'email', 'phone', 'address_heading',
                                        'country', 'state', 'city', 'country_id',
                                        'state_id', 'city_id', 'company', 'address', 
                                        'street', 'appartment', 'pincode', 'is_default'
                                        )
                                    ->first();
        $data['edit_address_id'] = Crypt::encrypt($data['edit_address']->id);
        
        if(!empty($data['edit_address']->state_id)){
            $country_list = CountryMaster::where('status','active')->where('id',$data['edit_address']->country_id)->select('id')->first();
            $state_list = StateMaster::where('status','active')->where('country_id',$data['edit_address']->country_id)->select('id','state_name')->get();
            $state_option = '<option value=""> -- Select State -- </option>';
            if(!empty($state_list)){
                foreach($state_list as $K =>$value){
                    
                    $selected = ($data['edit_address']->state_id == $value->id)?'selected':'';
                    $state_option .= '<option '.$selected.' data-id="'.$value->id.'" value="'.$value->state_name.'"> '.$value->state_name.' </option>';
                }
            }
            $data['states'] = $state_option;
            
            $city_list = CityMaster::where('status','active')->where('state_id',$data['edit_address']->state_id)->select('id','city_name')->get();
            $city_option = '<option value=""> -- Select city -- </option>';
            if(!empty($city_list)){
                foreach($city_list as $K =>$value){
                    $selected = ($data['edit_address']->city_id == $value->id)?'selected':'';
                    $city_option .= '<option '.$selected.' data-id="'.$value->id.'" value="'.$value->city_name.'"> '.$value->city_name.' </option>';
                }
            }
            $data['citys'] = $city_option;
            
            $pincodes = PinCodeMaster::where('status','active')->where('city_id',$data['edit_address']->city_id)->select('id','pin_codes')->first();
            $pins = explode(',',$pincodes->pin_codes);
            $pincodes_options = '<option value=""> -- Select pincode -- </option>';
            foreach($pins as $K =>$value){
                $selected = ($data['edit_address']->pincode == $value)?'selected':'';
                $pincodes_options .= '<option '.$selected.' value="'.$value.'"> '.$value.' </option>';
            }
            $data['pincodes'] = $pincodes_options;
        }

         return response()->json([
            'status' => true,
            'data' => $data,
        ]);
       
        exit;
    }
}
