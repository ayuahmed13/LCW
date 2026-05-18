<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Master\CityMaster;
use App\Models\Master\StateMaster;
use App\Http\Controllers\Controller;
use App\Models\Master\CountryMaster;
use App\Models\Master\PinCodeMaster;
use Illuminate\Support\Facades\Crypt;

class PinCodeMasterController extends Controller
{
    public function index(){
        $country_list = CountryMaster::where('status', '=', 'active')
                                    ->orderBy('country_name','ASC')
                                    ->select('id', 'country_name', 'country_code')
                                    ->get();
        return view('Admin.Master.pincode',compact('country_list'));
    }

    public function get_city_by_state_id(Request $request){
        $state_id = $request->state_id;

        $city_list = CityMaster::where('status', '=', 'active')
                                    ->where('state_id',$state_id)
                                    ->orderBy('city_name','ASC')
                                    ->select('id', 'city_name')
                                    ->get();
        $html = '<option value=""> -- Select city -- </option>';
        if(!empty($city_list)){
            foreach($city_list as $K =>$value){
                $html .= '<option value="'.$value->id.'"> '.$value->city_name.' </option>';
            }
        }
        echo $html;
        exit;
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'pin_codes' => 'required',
        ]);
        $input = $request->all();
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                PinCodeMaster::find($id)->update($input);
                return redirect('admin/pin-code-master')->with('success', 'Pincode updates Successfully!');
            
        } else {
                
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                PinCodeMaster::create($input);
                return redirect('admin/pin-code-master')->with('success', 'Pincode added successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = PinCodeMaster::where('pin_code_masters.status', '!=', 'delete')
                        ->join('country_masters', 'pin_code_masters.country_id', '=', 'country_masters.id')
                        ->join('state_masters', 'pin_code_masters.state_id', '=', 'state_masters.id')
                        ->join('city_masters', 'pin_code_masters.city_id', '=', 'city_masters.id')
                        ->orderBy('pin_code_masters.id', 'DESC')
                        ->select(
                            'pin_code_masters.id',
                            'pin_code_masters.pin_codes',
                            'country_masters.country_name',
                            'state_masters.state_name',
                            'city_masters.city_name',
                            'pin_code_masters.status'
                        )
                        ->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('country_name', function ($row) {
                    return !empty($row->country_name) ? $row->country_name : '' ;
                })
                ->addColumn('state_name', function ($row) {
                    return !empty($row->state_name) ? $row->state_name : '' ;
                })
                ->addColumn('city_name', function ($row) {
                    return !empty($row->city_name) ? $row->city_name : '' ;
                })
                ->addColumn('pin_codes', function ($row) {
                    return !empty($row->pin_codes) ? $row->pin_codes : '' ;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/pin-code-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="pin_code_masters" data-flash="Pincode deleted successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="pin_code_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="pin_code_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                            return $statusBlockBtn;
                        }
                
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:;" ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title="Active"></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:;" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title="Inactive"></></a>';
                            return $statusBlockBtn;
                        }
                    
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function edit($id){
        $edit_data = PinCodeMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        $country_list = CountryMaster::where('status', '=', 'active')
                                    ->orderBy('country_name','ASC')
                                    ->select('id', 'country_name', 'country_code')
                                    ->get();
        
        $state_list = StateMaster::where('status', '=', 'active')
                                    ->where('country_id',$edit_data->country_id)
                                    ->orderBy('state_name','ASC')
                                    ->select('id', 'state_name')
                                    ->get();
                                
        $city_list = CityMaster::where('status', '=', 'active')
                                    ->where('state_id',$edit_data->state_id)
                                    ->orderBy('city_name','ASC')
                                    ->select('id', 'city_name')
                                    ->get();
        
        return view('Admin.Master.pincode',compact('edit_data','country_list','state_list','city_list'));
    }

    public function check_city_pin_codes_exist(Request $request){
        $city_id = $request->city_id;
        $country_id = $request->country_id;
        $state_id = $request->state_id;
        $id = $request->id;
        if(!empty($id)){
            $id = Crypt::decrypt($request->id);
            $is_exists = PinCodeMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('city_id', $request->city_id)->where('country_id',$request->country_id)->where('state_id',$request->state_id)->first();
            
        }else{
            $is_exists = PinCodeMaster::where('status', '!=', 'delete')->where('city_id', $request->city_id)->where('country_id',$request->country_id)->where('state_id',$request->state_id)->first();
            
        }
        //return $is_exists;
        return !empty($is_exists)?'false':'true';
    }
}
