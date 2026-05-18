<?php

namespace App\Http\Controllers\Front\Login;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Front\UserRegister;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\UserForgotPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserLoginController extends Controller
{
    public function index(){
        return !empty(Session::has('MasterUser*%')) ? redirect('my-account') :  view('Front.login'); 
    }
    public function SendUserLoginOtp($request){

    }
    public function UserLoginAction(Request $request){

        $puser = Auth::guard('master_users')->user();
        if($puser){
                return redirect('my-account')->with('warning','Already logged in with another account!');
        }
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ); 

        $user = UserRegister::where('email', $user_data['email'])->where('status', '!=', 'delete')->first();

        if($user && Hash::check($user_data['password'], $user->password)){
            Auth::guard('master_users')->login($user);
            if(Auth::guard('master_users')->user()->status == 'inactive'){
                Auth::logout();
                Session::flush();
                return redirect('/login')->with('error', 'Contact To Admin For Login.');
            }else{
                $user_id = Auth::guard('master_users')->user()->id;  
                $last_login = UserRegister::where('id', $user_id)->update([
                    'last_login' => date('Y-m-d H:i:s'),
                    // 'is_logged_in' => 'yes',
                ]);
                // check if cart
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
                // Update user timezone
                
                // $user_timezone = 'Asia/Kolkata';
                // UserRegister::where('id',$user_id)->update(['user_timezone' => $user_timezone]);
                $redirect_to = !empty($request->redirect_to)?$request->redirect_to:'my-account';
                Session::put('MasterUser*%', $user_id);
                return redirect($redirect_to)->with('success','Login Successfully!');
            }
        }else{
            return redirect('/login')->with('error', 'User does not exists.');
            
        }
    }

    public function UserLogout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('success', 'Logout Successfully!');
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
    public function ResetPassword(Request $request){
        return view('Front.forget-password');
    }

    public function ResetUserPasswordAction(Request $request){
        
        $validatedData = $request->validate([
                'email' => 'required|email',
            ]);
        
        $email = $request->email;
        $user = UserRegister::where('email', $request->email)->where('status', '!=', 'delete')->first();
        if(empty($user->id)){
           return redirect()->back()
            ->with('error', 'User does not exist!')
            ->withInput();
        }else{
            if($user->status=='inactive'){
                return redirect()->back()
                    ->with('error', 'User inactive please contact admin!')
                     ->withInput();
            }else{
                $token = Str::random(64);

                $password_reset_tokens_user = DB::table('password_reset_tokens')->where('email', $request->email)->first();
                if(!empty(isset($password_reset_tokens_user->email) && $password_reset_tokens_user->email)){
                    DB::table('password_reset_tokens')->where('email', $request->email)->update([
                        'email' => $request->email, 
                        'token' => $token, 
                        'created_at' => Carbon::now()
                    ]);
                } else {
                    DB::table('password_reset_tokens')->insert([
                        'email' => $request->email, 
                        'token' => $token, 
                        'created_at' => Carbon::now()
                    ]);
                }

                $mailData = [
                        'token' => $token,
                    ];

                try {
                    Mail::to($request->email)->send(new UserForgotPasswordMail($mailData));
                }catch (Throwable $e) {
                    return redirect()->back()->with('error', 'Thank You ! Your Request Reached To Us, Mail Not Send , Make Sure Email is Right Or Network Connection is Proper');
                }
                //return redirect('show-user-reset-password-form/'.$token)->with('success','Reset your password here.');
                return back()->with('success', 'We have e-mailed your password reset link!');

            }
        }
    }


    public function showUserResetPasswordForm($token) { 
        return view('Front/includes/reset-password', ['token' => $token]);
    }
  
    public function submitUserResetPasswordForm(Request $request)
    {
    	
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);
   
    	if(!UserRegister::where('status','active')->where('email',$request->email)->exists()){
        	return back()->with('error', 'Sorry, this mail is not associated with us!');
        }

        $updatePassword = DB::table('password_reset_tokens')->where(['email' => $request->email, 'token' => $request->token])->first();
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = UserRegister::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
        return redirect('/login')->with('success', 'Your password has been changed!');
    }

}
