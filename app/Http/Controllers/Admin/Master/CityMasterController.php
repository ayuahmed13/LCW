<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Master\CityMaster;
use App\Models\Master\StateMaster;
use App\Http\Controllers\Controller;
use App\Models\Master\CountryMaster;
use Illuminate\Support\Facades\Crypt;

class CityMasterController extends Controller
{
    public function index(){
        $country_list = CountryMaster::where('status', '=', 'active')
                                    ->orderBy('country_name','ASC')
                                    ->select('id', 'country_name', 'country_code')
                                    ->get();
        // $state_list = StateMaster::where('status', '=', 'active')
        //                             ->orderBy('state_name','ASC')
        //                             ->select('id', 'state_name', 'country_id')
        //                             ->get();
        return view('Admin.Master.city',compact('country_list'));
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
                $html .= '<option value="'.$value->id.'"> '.$value->state_name.' </option>';
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
            'city_name' => 'required',
        ]);
        $input = $request->all();
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CityMaster::find($id)->update($input);
                return redirect('admin/city-master')->with('success', 'City updated successfully!');
            
        } else {
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                CityMaster::create($input);
                return redirect('admin/city-master')->with('success', 'City added successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = CityMaster::where('city_masters.status', '!=', 'delete')
                        ->join('country_masters', 'city_masters.country_id', '=', 'country_masters.id')
                        ->join('state_masters', 'city_masters.state_id', '=', 'state_masters.id')
                        ->orderBy('city_masters.id', 'DESC')
                        ->select(
                            'city_masters.id',
                            'country_masters.country_name',
                            'state_masters.state_name',
                            'city_masters.city_name',
                            'city_masters.status'
                        )
                        ->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('country_name', function ($row) {
                    return !empty($row->country_name) ? ucwords($row->country_name) : '' ;
                })
                ->addColumn('state_name', function ($row) {
                    return !empty($row->state_name) ? ucwords($row->state_name) : '' ;
                })
                ->addColumn('city_name', function ($row) {
                    return !empty($row->city_name) ? ucwords($row->city_name) : '' ;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/city-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="city_masters" data-flash="City deleted successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="city_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="city_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
        $edit_data = CityMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        $country_list = CountryMaster::where('status', '=', 'active')
                                    ->orderBy('country_name','ASC')
                                    ->select('id', 'country_name', 'country_code')
                                    ->get();
        
        $state_list = StateMaster::where('status', '=', 'active')
                                    ->where('country_id',$edit_data->country_id)
                                    ->orderBy('state_name','ASC')
                                    ->select('id', 'state_name', 'country_id')
                                    ->get();
        
        return view('Admin.Master.city',compact('edit_data','country_list','state_list'));
    }

    public function check_city_exist(Request $request){
        $city_name = $request->city_name;
        $country_id = $request->country_id;
        $state_id = $request->state_id;
        $id = $request->id;
        if(!empty($id)){
            $id = Crypt::decrypt($request->id);
            $is_exists = CityMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('city_name', $request->city_name)->where('country_id',$request->country_id)->where('state_id',$request->state_id)->first();
            
        }else{
            $is_exists = CityMaster::where('status', '!=', 'delete')->where('city_name', $request->city_name)->where('country_id',$request->country_id)->where('state_id',$request->state_id)->first();
            
        }
        //return $is_exists;
        return !empty($is_exists)?'false':'true';
    }
}
