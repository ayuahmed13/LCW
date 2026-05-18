<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Master\CountryMaster;
use Illuminate\Support\Facades\Crypt;

class CountryMasterController extends Controller
{
    public function index(){
        return view('Admin.Master.country');
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'country_name' => 'required',
            'country_code' => 'required',
        ]);
        $input = $request->all();
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                if(CountryMaster::where('status','!=','delete')->where('id', '!=', $id)->where('country_name', $request->country_name)->exists()){
                    return redirect()->back()->with('error', 'Sorry, This Country already exists !');
                }
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CountryMaster::find($id)->update($input);
                return redirect('admin/country-master')->with('success', 'Country updated successfully!');
            
        } else {
                if(CountryMaster::where('status','!=','delete')->where('country_name', $request->country_name)->exists()){
                    return redirect()->back()->with('error', 'Sorry, This Country already exists !');
                }
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                CountryMaster::create($input);
                return redirect('admin/country-master')->with('success', 'Country added successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = CountryMaster::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'country_name', 'country_code', 'status')->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('country_name', function ($row) {
                    return !empty($row->country_name) ? $row->country_name : '' ;
                })
                ->addColumn('country_code', function ($row) {
                    return !empty($row->country_code) ? $row->country_code : '' ;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/country-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="country_masters" data-flash="Data Deleted Successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="country_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="country_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
        $edit_data = CountryMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        return view('Admin.Master.country', compact('edit_data'));
    }
    public function check_country_exist(Request $request){
        $country_name = $request->country_name;
        $id = $request->id;
        if(!empty($id)){
            $id = Crypt::decrypt($request->id);
            $is_exists = CountryMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('country_name', $request->country_name)->first();
            
        }else{
            $is_exists = CountryMaster::where('status', '!=', 'delete')->where('country_name', $request->country_name)->first();
            
        }
        //return $is_exists;
        return !empty($is_exists)?'false':'true';
    }

    public function check_country_code_exist(Request $request){   
        $country_code = $request->country_code;
        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            
            $is_exists = CountryMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('country_code', $request->country_code)->first();
            
        }else{
            $is_exists = CountryMaster::where('status', '!=', 'delete')->where('country_code', $request->country_code)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }
}
