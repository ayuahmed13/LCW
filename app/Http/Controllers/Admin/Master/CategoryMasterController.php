<?php

namespace App\Http\Controllers\Admin\Master;

use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Master\CategoryMaster;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryMasterController extends Controller
{
    use MediaTrait;
    public function index(){
        return view('Admin.Master.category');
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'category_name' => 'required',
            //'category_image' => 'required',
        ]);
        $input = $request->all();
        
        $slug = Str::slug($request->input('category_name'));
        if (!empty($id) && $this->slugExists($slug, Crypt::decrypt($id))) {
            $slug = $this->generateUniqueSlug($slug, $id);
            $input['slug'] = $slug;
        }else{
            $input['slug'] = $slug;
        }
        
        if(!empty($input['category_image'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'category_image', 
                    'uploads/admin/category_images', 
                    strtolower( str_replace(' ','-',$request->input('category_name')))
                );
        }
        if(!empty($file_path)){
            $input['category_image'] = $file_path;
        }
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
               
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CategoryMaster::find($id)->update($input);
                return redirect('admin/category-master')->with('success', 'Category updated successfully!');
            
        } else {
               
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                CategoryMaster::create($input);
                return redirect('admin/category-master')->with('success', 'Category added successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = CategoryMaster::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'category_name', 'category_image', 'status')->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    return !empty($row->category_name) ? $row->category_name : '' ;
                })
                ->addColumn('category_image', function ($row) {
                    
                    $url= !empty($row->category_image) ?url('/').Storage::url($row->category_image) : asset('package_assets/images/default-images/default.png') ;
                    return '<img width="80px" src="'.$url.'" alt="image">';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/category-master/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="category_masters" data-flash="category deleted successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="category_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="category_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->rawColumns(['category_image','action', 'status'])
                ->make(true);
        }
    }

    public function edit($id){
        $edit_data = CategoryMaster::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        return view('Admin.Master.category', compact('edit_data'));
    }

    public function check_category_exist(Request $request){   
        $category_name = $request->category_name;
        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            
            $is_exists = CategoryMaster::where('id', '!=', $id)->where('status', '!=', 'delete')->where('category_name', $request->category_name)->first();
            
        }else{
            $is_exists = CategoryMaster::where('status', '!=', 'delete')->where('category_name', $request->category_name)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }

    // Helper function to check if slug already exists
    private function slugExists($slug, $id = null)
    {
        $query = CategoryMaster::where('slug', $slug);

        // If an ID is provided, we exclude it from the uniqueness check
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
