<?php

namespace App\Http\Controllers\Admin\Master;

use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Master\BrandsMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BrandsMasterController extends Controller
{
    use MediaTrait;
    public function index(){
        return view('Admin.Master.brands');
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'brand_name' => 'required',
            //'brand_image' => 'required',
        ]);
        $input = $request->all();
        
        if(!empty($input['brand_image'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'brand_image', 
                    'uploads/admin/brand_images', 
                    strtolower( str_replace(' ','-',$request->input('brand_name')))
                );
        }
        if(!empty($file_path)){
            $input['brand_image'] = $file_path;
        }

        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                if(BrandsMaster::where('status','!=','delete')->where('id', '!=', $id)->where('brand_name', $request->brand_name)->exists()){
                    return redirect()->back()->with('error', 'Sorry, This brand already exists !');
                }
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                BrandsMaster::find($id)->update($input);
                return redirect('admin/brands-master')->with('success', 'Brand updated successfully!');
            
        } else {
                if(BrandsMaster::where('status','!=','delete')->where('brand_name', $request->brand_name)->exists()){
                    return redirect()->back()->with('error', 'Sorry, This brand already exists !');
                }
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                BrandsMaster::create($input);
                return redirect('admin/brands-master')->with('success', 'Brand added successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = BrandsMaster::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'brand_name', 'brand_image', 'status')->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('brand_name', function ($row) {
                    return !empty($row->brand_name) ? $row->brand_name : '' ;
                })
                ->addColumn('brand_image', function ($row) {
                    
                    $url= !empty($row->brand_image) ?url('/').Storage::url($row->brand_image) : asset('package_assets/images/default-images/default.png') ;
                    return '<img width="80px" src="'.$url.'" alt="image">';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/brands-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="brands_masters" data-flash="Brand Deleted Successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="brands_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="brands_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->rawColumns(['brand_image','action', 'status'])
                ->make(true);
        }
    }
    public function edit($id){
        $edit_data = BrandsMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        return view('Admin.Master.brands', compact('edit_data'));
    }
    public function check_brands_exist(Request $request){   
        $brand_name = $request->brand_name;
        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            
            $is_exists = BrandsMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('brand_name', $request->brand_name)->first();
            
        }else{
            $is_exists = BrandsMaster::where('status', '!=', 'delete')->where('brand_name', $request->brand_name)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }
}
