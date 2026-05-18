<?php

namespace App\Http\Controllers\Front\ContactUs;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ContactUsEnquiry;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\General_setting;

class FrontContactUsController extends Controller
{
    public function index(Request $request){
        $data = General_setting::where('status','active')->orderBy('id','desc')->first();
        $captcha =Str::random(8);
        $request->session()->put('captcha', $captcha);
        return view('Front.contact',compact('data','captcha'));
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $input = $request->all();
                
        $input['created_by'] = Auth::guard('master_users')->id();
        $input['created_ip_address'] = $request->ip();
        ContactUsEnquiry::create($input);
        return redirect('contact')->with('success', 'Enquiry sent Successfully!');
        
    }
}
