<?php

namespace App\Http\Controllers\Front\MyAccount;

use App\Traits\MediaTrait;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Front\UserRegister;
use App\Models\Master\StateMaster;
use App\Http\Controllers\Controller;
use App\Models\Master\CountryMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Master\CategoryMaster;
use App\Models\Master\CityMaster;
use App\Models\Master\PinCodeMaster;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserMyAccountController extends Controller
{
    use MediaTrait;
    public function index(){

        // return $categories = $categories = CategoryMaster::with(['subCategories' => function ($query) {
        //     $query->select('id', 'category_id', 'sub_category_name', 'slug') // Subcategory fields
        //           ->where('status', 'active');
        // }])
        // ->select('id', 'category_name', 'slug') // Category fields
        // ->where('status', 'active')
        // ->get();
        

        
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
        return view('Front.my-account',compact('data'));
        
    }

    public function store(Request $request){
        
        $rules = [
            //'first_name'   => 'required|string|max:255',
            //'last_name'    => 'required|string|max:255',
            'full_name'    => 'required',
            //'email'        => 'required|email|unique:user_register,email|max:255', // Ensure unique email in the UserRegister table
            'phone_no'     => 'required', // Ensure valid phone number and uniqueness
            //'company_name' => 'required|string|max:255',
        ];

        $input = $request->all();  
        $validator = Validator::make($input, $rules);
        
        unset($input['email']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $up_data = array(
            'full_name'=> $request->full_name,
            'phone_no'=> $request->phone_no,
        );
        
        if(!empty($input['profile_image'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'profile_image', 
                    'uploads/admin/profile_images/'.Crypt::decrypt($input['id']), 
                    strtolower( str_replace(' ','-',$request->input('brand_name')))
                );
        }
        if(!empty($file_path)){
            $up_data['profile_image'] = $file_path;
        }
        $up_data['modified_by'] = auth()->guard('master_users')->user()->id;
        $up_data['modified_ip_address'] = $request->ip();
        $up_data;
        $newUser = UserRegister::where('id',Crypt::decrypt($input['id']))->update($up_data);
        
        if ($newUser) {
            return redirect()->back()->with('success', 'User data inserted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert user data.');
        }
    }

    public function CheckOldPassword(Request $request){
        $old_password = $request->old_password;
        $id = auth()->guard('master_users')->user()->id;
        
        $user_data = UserRegister::where('id',$id)->where('status','active')->select('id','password')->first(); 
        $db_pass = $user_data->password;
        if(!empty($id)){
            //$old_password = Crypt::encrypt($old_password);
            //$is_exists = UserRegister::where('id', '=', $id)->where('status', '=', 'active')->where('password', $old_password)->first();
             
            if ($user_data && Hash::check($old_password, $user_data->password)) {
                return 'true';
            } else {
                return 'false';
            }
        }
       // return !empty($is_exists)?'true':'false';
    }

    public function SetNewPassword(Request $request){
        $user_id = Auth::guard('master_users')->id();
       
        $password = Crypt::encrypt($request->password);

        $rules = [
            'old_password'    => 'required',
            'new_password'    => 'required',
            'confirmnn_password'    => 'required',
        ];

        $input = $request->all();  
        $validator = Validator::make($input, $rules);
    
        $data1 = UserRegister::where('id',$user_id)->where('status','active')->select('id')->first(); 

        $up_data = array(
            'password' => $password,
            'modified_ip_address' => $request->ip(),
            'modified_by' => $user_id
        );

        $data = UserRegister::where('id',$user_id)->where('status','active')->update($up_data);

        if ($data) {
            return redirect()->back()->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to insert user data.');
        }
        
    }
    
    public function MyAccountAddress(Request $request){
        $user_id = Auth::guard('master_users')->id();

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
        //country
        $country_region_list = CountryMaster::where('status','active')
                        ->orderBy('country_name','asc')
                        ->get();
                        
        $select = ['id','address_heading',
        'name','email',
        'phone','state','company',
        'address','city','street','appartment','pincode','is_default',
        'created_by','country','country_id','state_id','city_id'];
        $address_list = UserAddress::where('status','active')->where('created_by',$user_id)->select($select)->orderBy('id','desc')->get();
        
        return view('Front.my-account-address',compact('address_list','data','country_region_list'));
    }

    public function MyAccountAddressStore(Request $request){
        $user_id = Auth::guard('master_users')->id();

        $request->validate([
            'address_heading' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'street' => 'required',
            'appartment' => 'required',
            'pincode' => 'required',
            'country' => 'required',
        ]);

        $input = $request->all();
        $id = $request->id;

        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                $input['modified_by'] = $user_id;
                $input['modified_ip_address'] = $request->ip();
                UserAddress::find($id)->update($input);
                
                if(!empty($input['is_default']) && $input['is_default']=='yes'){
                    $up=[
                        'is_default' => 'no'
                    ];
                    UserAddress::where('id','!=',$id)->where('created_by',$user_id)->where('status','active')->update($up);
                }

                return redirect('my-account-address')->with('success', 'Data Updated Successfully!');
            
        } else {
                $input['created_by'] = $user_id;
                $input['created_ip_address'] = $request->ip();
                if(!empty($input['is_default']) && $input['is_default']=='yes'){
                    $up=[
                        'is_default' => 'no'
                    ];
                    UserAddress::where('created_by',$user_id)->where('status','active')->update($up);
                }
                UserAddress::create($input);
                

                return redirect('my-account-address')->with('success', 'Data Added Successfully!');
        }
    }
    public function MyAccountDeleteAddress($id,Request $request){
        $user_id = Auth::guard('master_users')->id();

        $id = Crypt::decrypt($id);
        $input['status'] = 'delete';
        $input['modified_by'] = $user_id;
        $input['modified_ip_address'] = $request->ip();
        UserAddress::find($id)->update($input);
        return redirect('my-account-address')->with('success', 'Data Deleted Successfully!');    
    }

    public function get_state_by_country_id(Request $request){
        $country_id = $request->country_id;

        $state_list = StateMaster::where('status', '=', 'active')
                                    ->where('country_id',$country_id)
                                    ->orderBy('state_name','ASC')
                                    ->select('id', 'state_name', 'country_id')
                                    ->get();
        $html = '<option value=""> -- Select State -- </option>';
        if(!empty($state_list)){
            foreach($state_list as $K =>$value){
                $html .= '<option data-id="'.$value->id.'" value="'.$value->state_name.'"> '.$value->state_name.' </option>';
            }
        }
        echo $html;
        exit;
    }

    public function get_city_by_state_id(Request $request){
        $state_id = $request->state_id;

        $city_list = CityMaster::where('status', '=', 'active')
                                    ->where('state_id',$state_id)
                                    ->orderBy('city_name','ASC')
                                    ->select('id', 'city_name', 'state_id')
                                    ->get();
        $html = '<option value=""> -- Select city -- </option>';
        if(!empty($city_list)){
            foreach($city_list as $K =>$value){
                $html .= '<option data-id="'.$value->id.'" value="'.$value->city_name.'"> '.$value->city_name.' </option>';
            }
        }
        echo $html;
        exit;
    }

    public function get_pincode_by_city_id(Request $request){
        $city_id = $request->city_id;

        $pincodes = PinCodeMaster::where('status', '=', 'active')
                                    ->where('city_id',$city_id)
                                    ->select('id', 'city_id', 'pin_codes')
                                    ->first();
        $html = '<option value=""> -- Select pincode -- </option>';
        if(!empty($pincodes->pin_codes)){
            $pins = explode(',',$pincodes->pin_codes);

            foreach($pins as $K =>$value){
                $html .= '<option value="'.$value.'"> '.$value.' </option>';
            }
        }
        echo $html;
        exit;
    }

     public function get_address_by_id(Request $request){
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
