<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Master\ProductParameterMaster;
use App\Models\Master\ProductParameterValueMaster;

class ProductParameterValueMasterController extends Controller
{
    public function index(){
        $product_parameter_list = ProductParameterMaster::where('status', '=', 'active')->orderBy('product_parameter_name','asc')->select('id', 'product_parameter_name', 'status')->get();
        return view('Admin.Master.product-parameter-value',compact('product_parameter_list'));
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'product_parameter_id' => 'required',
            'product_parameter_value' => 'required',
        ]);
        $input = $request->all();
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                ProductParameterValueMaster::find($id)->update($input);
                return redirect('admin/product-parameter-value-master')->with('success', 'Product parameter updated successfully!');
            
        } else {
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                ProductParameterValueMaster::create($input);
                return redirect('admin/product-parameter-value-master')->with('success', 'Product parameter added Suscessfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = ProductParameterValueMaster::where('product_parameter_value_masters.status', '!=', 'delete')
                            ->join('product_parameter_masters', 'product_parameter_value_masters.product_parameter_id', '=', 'product_parameter_masters.id')
                            ->orderBy('product_parameter_value_masters.id','DESC')
                            ->select(
                                'product_parameter_value_masters.id', 
                                'product_parameter_masters.product_parameter_name',
                                'product_parameter_value_masters.product_parameter_value', 
                                'product_parameter_value_masters.status')

                            ->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('product_parameter_name', function ($row) {
                    return !empty($row->product_parameter_name) ? $row->product_parameter_name : '' ;
                })
                ->addColumn('product_parameter_value', function ($row) {
                    return !empty($row->product_parameter_value) ? $row->product_parameter_value : '' ;
                })
                
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/product-parameter-value-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="product_parameter_value_masters" data-flash="Product Parameter deleted successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="product_parameter_value_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="product_parameter_value_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
        $product_parameter_list = ProductParameterMaster::where('status', '=', 'active')->orderBy('product_parameter_name','asc')->select('id', 'product_parameter_name', 'status')->get();
        $edit_data = ProductParameterValueMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        return view('Admin.Master.product-parameter-value', compact('edit_data','product_parameter_list'));
    }

    public function check_product_parameter_value_exist(Request $request){   
        $product_parameter_id = $request->country_code;
        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            
            $is_exists = ProductParameterValueMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('product_parameter_value', $request->product_parameter_value)->where('product_parameter_id', $request->product_parameter_id)->first();
            
        }else{
            $is_exists = ProductParameterValueMaster::where('status', '!=', 'delete')->where('product_parameter_value', $request->product_parameter_value)->where('product_parameter_id', $request->product_parameter_id)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }
}
