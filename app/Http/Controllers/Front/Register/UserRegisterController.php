<?php

namespace App\Http\Controllers\Front\Register;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Mail\RegisterOtpMail;
use App\Models\Front\UserRegister;
use App\Http\Controllers\Controller;
use App\Models\Master\CountryMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class UserRegisterController extends Controller
{
    public function index(Request $request){
        $country_list = CountryMaster::where('status','active')->select('id','country_name')->get();
        return !empty(Session::has('MasterUser*%')) ? redirect('my-account') :  view('Front.register',compact('country_list')); 
        
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        $input = $request->all();
        $input['full_name'] = $input['name'];
        $input['password'] = bcrypt($request->password);
        $input['status'] = 'delete';
        $input['otp'] = rand(100000,999999);
        $input['is_otp_verified'] = 'no';
        //check email exists
        $exists = UserRegister::where('status','!=','delete')->where('email','=',$input['email'])->select('id','email','status')->first();
        
        if (!empty($exists)) {
            if($exists->status == 'inactive'){
                return response()->json([
                    'status' => false,
                    'message' => 'Account inactive, please contact admin.'
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'The email address is already in use.'
            ], 200);
        }
    
        // Create user
        $insert = UserRegister::create($input);
        $user_id = $insert->id;
        $formatted_id = 'LCU' . str_pad($user_id, 7, '0', STR_PAD_LEFT); 
        UserRegister::where('id',$user_id)->update(['customer_id'=>$formatted_id]);
        // Send OTP on email

        $data = [
            'name' => $input['name'],
            'otp' => $input['otp']
        ];

        Mail::to($input['email'])->send(new RegisterOtpMail($data));

        return response()->json([
            'status' => true,
            'uid' => Crypt::encrypt($insert->id),
            'message' => 'OTP Sent on email id successfully!'
        ], 200);
    }

    public function VerifyOtp(Request $request){
        $request->validate([
            'otp' => 'required',
            'uid' => 'required'
        ]);
        $id = Crypt::decrypt($request->uid);
        
        $input = $request->all();
        //check email exists
        $exists = UserRegister::where('status','!=','delete')->where('email','=',$input['email'])->first();
        
        if (!empty($exists)) {
            if($exists->status == 'inactive'){
                return response()->json([
                    'status' => false,
                    'message' => 'Account inactive, please contact admin.'
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'The email address is already in use.'
            ], 200);
        }
        // Check OTP
        $is_otp = UserRegister::where('id',$id)->where('otp',$request->otp)->select('id','otp')->first();
        if(!empty($is_otp)){
            // Create user
            $upd = array(
                'otp_verified_at' => date('Y-m-d H:i:s'),
                'is_otp_verified' => 'yes',
                'status' => 'active'
            );
            
        UserRegister::where('id',$id)->update($upd);
        
        $userlog = UserRegister::where('id', $id)->where('status', '=', 'active')->first();
            
        Auth::guard('master_users')->login($userlog);
            Session::put('MasterUser*%', $id);

            // cart sync code
            $user_id = $id;
            $sessionCart = session('cart', []);
                if(!empty($sessionCart)){
                    $this->afterLoginSyncCart($request);
                }else{
                    $cart = Cart::where('user_id', $user_id)
                                ->where('status', 'active')
                                ->first();

                    if (!empty($cart)) {
                        $cart_count = CartProduct::where('cart_id', $cart->id)
                                                ->where('status', 'active')
                                                ->count();
                        Session::put('cart_count', $cart_count);

                    } else {
                        // In case the cart doesn't exist or is empty, set cart_count to 0
                        Session::put('cart_count', 0);
                    }
                }

            $redirect_to = !empty($request->redirect_to)?$request->redirect_to:'my-account';

            return response()->json([
                'status' => true,
                'message' => 'OTP verified successfully!',
                'redirect_to' => url('/').'/'.$redirect_to
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP!'
            ], 200);
        }
           
    }

    public function ResendOtp(Request $request){
        $request->validate([
            'email' => 'required'
        ]);
        $input = $request->all();
        //check email exists
        $exists = UserRegister::where('status','!=','delete')->where('email','=',$input['email'])->select('id','email','status')->first();
        
        if (!empty($exists)) {
            if($exists->status == 'inactive'){
                return response()->json([
                    'status' => false,
                    'message' => 'Account inactive, please contact admin.'
                ], 200);
            }
            // return response()->json([
            //     'status' => false,
            //     'message' => 'The email address is already in use.'
            // ], 200);
        }
        $otp = rand(100000,999999);

                // Send OTP on email

                $data = [
                    'name' => '',
                    'otp' => $otp
                ];
        
                Mail::to($input['email'])->send(new RegisterOtpMail($data));
                UserRegister::where('email',$input['email'])->update(['otp' => $otp]);
        return response()->json([
            'status' => false,
            'message' => 'Otp sent successfully.'
        ], 200);
    }

    public function CheckUserEmailExists(Request $request){   
        $input['email'] = $request->email;

        $id = $request->id;
        if(!empty($id)){
            $id = Crypt::decrypt($request->id);
            $is_exists = UserRegister::where('id', '!=', $id)->where('status', '!=', 'delete')->where('email', $request->email)->first();
        }else{
            $is_exists = UserRegister::where('status', '!=', 'delete')->where('email', $request->email)->exists();           
        }
        return !empty($is_exists)?'false':'true';
    }

     public function afterLoginSyncCart(Request $request)
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
            else {
                // Update quantity (you can choose to replace or add)
                $existing->update([
                    'product_qty' => $existing->product_qty + $item['quantity'],
                    'updated_by' => $user->id ?? null,
                    'updated_ip_address' => $request->ip(),
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
