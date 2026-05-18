<?php

namespace App\Http\Controllers\Front\Reseller;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ResellerEnquiry;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontResellerEnquiryController extends Controller
{
    public function index(Request $request){
        $data = '';
        $captcha =Str::random(8);
        $request->session()->put('rscaptcha', $captcha);
        return view('Front.reseller',compact('data','captcha'));
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'abn' => 'required',
            'company_trade_name' => 'required',
            'message' => 'required',
        ]);

        $input = $request->all();
                
        $input['created_by'] = Auth::guard('master_users')->id();
        $input['created_ip_address'] = $request->ip();
        ResellerEnquiry::create($input);
        return redirect('reseller')->with('success', 'Enquiry sent Successfully!');
        
    }
}
