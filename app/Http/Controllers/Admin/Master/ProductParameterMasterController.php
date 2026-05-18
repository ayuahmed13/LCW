<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Master\ProductParameterMaster;

class ProductParameterMasterController extends Controller
{
    public function index(){
        return view('Admin.Master.product-parameter');
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'product_parameter_name' => 'required',
        ]);
        $input = $request->all();
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                if(ProductParameterMaster::where('status','!=','delete')->where('id', '!=', $id)->where('product_parameter_name', $request->product_parameter_name)->exists()){
                    return redirect()->back()->with('error', 'Sorry, This  already exists !');
                }
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                ProductParameterMaster::find($id)->update($input);
                return redirect('admin/product-parameter-master')->with('success', 'Product parameter updated Successfully!');
            
        } else {
                if(ProductParameterMaster::where('status','!=','delete')->where('product_parameter_name', $request->product_parameter_name)->exists()){
                    return redirect()->back()->with('error', 'Sorry, This  already exists !');
                }
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                ProductParameterMaster::create($input);
                return redirect('admin/product-parameter-master')->with('success', 'Product parameter added Successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = ProductParameterMaster::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'product_parameter_name', 'status')->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('product_parameter_name', function ($row) {
                    return !empty($row->product_parameter_name) ? $row->product_parameter_name : '' ;
                })
                
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/product-parameter-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="product_parameter_masters" data-flash="Product parameter deleted successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="product_parameter_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="product_parameter_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
        $edit_data = ProductParameterMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        return view('Admin.Master.product-parameter', compact('edit_data'));
    }

    public function check_product_parameter_exist(Request $request){   
        $country_code = $request->country_code;
        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            
            $is_exists = ProductParameterMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('product_parameter_name', $request->product_parameter_name)->first();
            
        }else{
            $is_exists = ProductParameterMaster::where('status', '!=', 'delete')->where('product_parameter_name', $request->product_parameter_name)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }
}
