<?php

namespace App\Http\Controllers\Admin\Master;

use App\Traits\MediaTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AllCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class MasterCategoryController extends Controller
{
    use MediaTrait;
    public function Category(){
        return view('Admin.Master.category');
    }

    public function SubCategory(){
       // $category_list = CategoryMaster::where('status', '=', 'active')->orderBy('category_name','asc')->select('id', 'category_name')->get();
        return view('Admin.Master.sub-category',compact('category_list'));
    }

    public function SubSubCategory(){
       // $category_list = CategoryMaster::where('status', '=', 'active')->orderBy('category_name','asc')->select('id', 'category_name')->get();
        return view('Admin.Master.sub-sub-category',compact('category_list'));
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
        if(!empty($input['category_id'])){
            $input['parent_category_id'] = $input['category_id'];
        }
        if(!empty($input['sub_category_id'])){
            $input['parent_category_id'] = $input['sub_category_id'];
        }
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
               
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AllCategories::find($id)->update($input);
                return redirect('admin/category-master')->with('success', 'Data Updated Successfully!');
            
        } else {
               
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AllCategories::create($input);
                return redirect('admin/category-master')->with('success', 'Data Added Successfully!');
        }
    }
}
