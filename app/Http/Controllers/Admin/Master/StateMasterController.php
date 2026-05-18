<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Master\StateMaster;
use App\Http\Controllers\Controller;
use App\Models\Master\CountryMaster;
use Illuminate\Support\Facades\Crypt;

class StateMasterController extends Controller
{
    public function index(){
        $country_list = CountryMaster::where('status', '=', 'active')
                                    ->orderBy('country_name','ASC')
                                    ->select('id', 'country_name', 'country_code')
                                    ->get();
        return view('Admin.Master.state',compact('country_list'));
    }
    
    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'country_id' => 'required',
            'state_name' => 'required',
        ]);
        $input = $request->all();
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                if(StateMaster::where('status','!=','delete')->where('id', '!=', $id)->where('state_name', $request->country_name)->exists()){
                    return redirect()->back()->with('error', 'Sorry, This state already exists !');
                }
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                StateMaster::find($id)->update($input);
                return redirect('admin/state-master')->with('success', 'State updated successfully!');
            
        } else {
                if(StateMaster::where('status','!=','delete')->where('state_name', $request->country_name)->exists()){
                    return redirect()->back()->with('error', 'Sorry, This state already exists !');
                }
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                StateMaster::create($input);
                return redirect('admin/state-master')->with('success', 'State added successfully!');
        }
        
    }

    public function data_table(Request $request){
        $table_data = StateMaster::where('state_masters.status', '!=', 'delete')
                        ->join('country_masters', 'state_masters.country_id', '=', 'country_masters.id')
                        ->orderBy('state_masters.id', 'DESC')
                        ->select(
                            'state_masters.id',
                            'country_masters.country_name',
                            'state_masters.state_name',
                            'state_masters.status'
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
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/state-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="state_masters" data-flash="Data Deleted Successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="state_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="state_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
        $edit_data = StateMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        $country_list = CountryMaster::where('status', '=', 'active')
                                    ->orderBy('country_name','ASC')
                                    ->select('id', 'country_name', 'country_code')
                                    ->get();
        return view('Admin.Master.state', compact('edit_data','country_list'));
    }

    public function check_state_exist(Request $request){
        $state_name = $request->state_name;
        $country_id = $request->country_id;
        $id = $request->id;
        if(!empty($id)){
            $id = Crypt::decrypt($request->id);
            $is_exists = StateMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('state_name', $request->state_name)->where('country_id',$request->country_id)->first();
            
        }else{
            $is_exists = StateMaster::where('status', '!=', 'delete')->where('state_name', $request->state_name)->where('country_id',$request->country_id)->first();
            
        }
        //return $is_exists;
        return !empty($is_exists)?'false':'true';
    }

}
