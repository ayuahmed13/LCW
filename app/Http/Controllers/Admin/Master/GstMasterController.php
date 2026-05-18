<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Models\Master\GstMaster;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class GstMasterController extends Controller
{
    public function index(){
        return view('Admin.Master.GST');
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'gst_value' => 'required',
        ]);
        $input = $request->all();
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                GstMaster::find($id)->update($input);
                return redirect('admin/gst-master')->with('success', 'GST updated successfully!');
            
        } else {
                
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                GstMaster::create($input);
                return redirect('admin/gst-master')->with('success', 'GST added successfully!');
        }
    }
    
    public function data_table(Request $request){
        $table_data = GstMaster::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'gst_value', 'status')->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('gst_value', function ($row) {
                    return !empty($row->gst_value) ? $row->gst_value : '' ;
                })
                
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/gst-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="gst_masters" data-flash="GST deleted successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="gst_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="gst_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
        $edit_data = GstMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        return view('Admin.Master.GST', compact('edit_data'));
    }

    public function check_gst_exist(Request $request){   
        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            
            $is_exists = GstMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('gst_value', $request->gst_value)->first();
            
        }else{
            $is_exists = GstMaster::where('status', '!=', 'delete')->where('gst_value', $request->gst_value)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }
}
