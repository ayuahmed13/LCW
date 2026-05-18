<?php

namespace App\Http\Controllers\Admin\Master;

use App\Traits\MediaTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Master\CategoryMaster;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Models\Master\SubCategoryMaster;
use App\Models\Master\SubSubCategoryMaster;


class SubSubCategoryMasterController extends Controller
{
    use MediaTrait;
    public function index(){
        $category_list = CategoryMaster::where('status', '=', 'active')->orderBy('category_name','asc')->select('id', 'category_name')->get();
        //$sub_category_list = SubCategoryMaster::where('status', '=', 'active')->orderBy('category_name','asc')->select('id', 'category_name')->get();
        
        return view('Admin.Master.sub-sub-category',compact('category_list'));
    }

    public function get_sub_category_by_category_id(Request $request){
        $category_id = $request->category_id;

        $state_list = SubCategoryMaster::where('status', '=', 'active')
                                    ->where('category_id',$category_id)
                                    ->orderBy('sub_category_name','ASC')
                                    ->select('id', 'sub_category_name')
                                    ->get();
        $html = '<option value=""> -- Select Sub Category -- </option>';
        if(!empty($state_list)){
            foreach($state_list as $K =>$value){
                $html .= '<option value="'.$value->id.'"> '.$value->sub_category_name.' </option>';
            }
        }
        echo $html;
        exit;
    }

    public function get_sub_sub_category_by_sub_category_id(Request $request){
        $sub_category_id = $request->sub_category_id;

        $state_list = SubSubCategoryMaster::where('status', '=', 'active')
                                    ->where('sub_category_id',$sub_category_id)
                                    ->orderBy('sub_sub_category_name','ASC')
                                    ->select('id', 'sub_sub_category_name')
                                    ->get();
        $html = '<option value=""> -- Select Sub Sub Category -- </option>';
        if(!empty($state_list)){
            foreach($state_list as $K =>$value){
                $html .= '<option value="'.$value->id.'"> '.$value->sub_sub_category_name.' </option>';
            }
        }
        echo $html;
        exit;
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'sub_sub_category_name' => 'required',
            //'category_image' => 'required',
        ]);
        $input = $request->all();
        
        $slug = Str::slug($request->input('sub_sub_category_name'));

        // Ensure the slug is unique
        if (!empty($id) && $this->slugExists($slug, Crypt::decrypt($id))) {
            $slug = $this->generateUniqueSlug($slug, $id);
            $input['slug'] = $slug;
        }else{
            $input['slug'] = $slug;
        }
        
        if(!empty($input['sub_sub_category_image'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'sub_sub_category_image', 
                    'uploads/admin/sub_sub_category_images', 
                    strtolower( str_replace(' ','-',$request->input('sub_category_name')))
                );
        }
        if(!empty($file_path)){
            $input['sub_sub_category_image'] = $file_path;
        }

        if (!empty($id)) {
                $id = Crypt::decrypt($id);
               
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                SubSubCategoryMaster::find($id)->update($input);
                return redirect('admin/sub-sub-category-master')->with('success', 'Sub sub category Updated Successfully!');
            
        } else {
               
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                SubSubCategoryMaster::create($input);
                return redirect('admin/sub-sub-category-master')->with('success', 'Sub sub category Added Successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = SubSubCategoryMaster::where('sub_sub_category_masters.status', '!=', 'delete')
                    ->join('sub_category_masters', 'sub_sub_category_masters.sub_category_id', '=', 'sub_category_masters.id')
                    ->join('category_masters', 'sub_category_masters.category_id', '=', 'category_masters.id')
                    ->orderBy('sub_sub_category_masters.id', 'DESC')
                    ->select(
                        'sub_sub_category_masters.id', 
                        'sub_sub_category_masters.sub_sub_category_name',
                        'sub_sub_category_masters.sub_sub_category_image', 
                        'sub_sub_category_masters.status', 
                        'sub_category_masters.sub_category_name', 
                        'category_masters.category_name'
                    )
                    ->get();

        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    return !empty($row->category_name) ? $row->category_name : '' ;
                })
                ->addColumn('sub_category_name', function ($row) {
                    return !empty($row->sub_category_name) ? $row->sub_category_name : '' ;
                })
                ->addColumn('sub_sub_category_name', function ($row) {
                    return !empty($row->sub_sub_category_name) ? $row->sub_sub_category_name : '' ;
                })
                ->addColumn('sub_sub_category_image', function ($row) {
                    
                    $url= !empty($row->sub_sub_category_image) ?url('/').Storage::url($row->sub_sub_category_image) : asset('package_assets/images/default-images/default.png') ;
                    return '<img width="80px" height="80px" src="'.$url.'" alt="image">';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/sub-sub-category-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="sub_sub_category_masters" data-flash="Data Deleted Successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="sub_sub_category_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="sub_sub_category_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->rawColumns(['sub_sub_category_image','action', 'status'])
                ->make(true);
        }
    }
    
    public function edit($id){
        $edit_data = SubSubCategoryMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        $category_list = CategoryMaster::where('status', '=', 'active')
                                ->orderBy('category_name','asc')
                                ->select('id', 'category_name')
                                ->get();
        $sub_category_list = SubCategoryMaster::where('status', '=', 'active')
                                ->orderBy('sub_category_name','asc')
                                ->select('id', 'sub_category_name')
                                ->where('category_id',$edit_data->category_id)
                                ->get();

        return view('Admin.Master.sub-sub-category', compact('edit_data','category_list','sub_category_list'));
    }

    public function check_sub_sub_category_exist(Request $request){   
        $sub_sub_category_name = $request->sub_sub_category_name;
        $category_id = $request->category_id;
        $sub_category_id = $request->sub_category_id;

        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            
        $sub_sub_category_name = $request->sub_sub_category_name;
            $is_exists = SubSubCategoryMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('sub_sub_category_name', $request->sub_sub_category_name)->where('category_id', $request->category_id)->where('sub_category_id', $request->sub_category_id)->first();
            
        }else{
        $sub_sub_category_name = $request->sub_sub_category_name;
            $is_exists = SubSubCategoryMaster::where('status', '!=', 'delete')->where('sub_sub_category_name', $request->sub_sub_category_name)->where('category_id', $request->category_id)->where('sub_category_id', $request->sub_category_id)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }

    // Helper function to check if slug already exists
    private function slugExists($slug, $id = null)
    {
        $query = SubSubCategoryMaster::where('slug', $slug);

        // If an ID is provided (update scenario), exclude the current record
        if ($id) {
            $query->where('id', '!=', $id);
        }

        return $query->exists();
    }

    // Helper function to generate a unique slug
    private function generateUniqueSlug($slug, $id = null)
    {
        $count = 1;
        $newSlug = $slug;

        // Keep generating a new slug until it is unique
        while ($this->slugExists($newSlug, $id)) {
            $newSlug = $slug . '-' . $count;
            $count++;
        }

        return $newSlug;
    }
}
