<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Models\Blogs;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    use MediaTrait;
    public function index(){
        return view('Admin.Blogs.blogs');
    }
    public function AddBlogs(Request $request){
        return view('Admin.Blogs.add-blogs');
    }

    public function store(Request $request){
        $id = $request->id;
        
        $rules = [
            'heading' => 'required',
            'date' => 'required',
            // 'auther' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ];

        // Only require blog_image if $id is empty (i.e., new post)
        if (empty($id)) {
            $rules['blog_image'] = 'required';
        }

        $validatedData = $request->validate($rules);


        $input = $request->all();
        
        if(!empty($input['blog_image'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'blog_image', 
                    'uploads/admin/blog_images', 
                    strtolower( str_replace(' ','-',$request->input('title')))
                );
        }
        if(!empty($file_path)){
            $input['blog_image'] = $file_path;
        }

        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Blogs::find($id)->update($input);
                return redirect('admin/blogs')->with('success', 'Blog Updated Successfully!');
            
        } else {
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Blogs::create($input);
                return redirect('admin/blogs')->with('success', 'Blog Added Successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = Blogs::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'heading', 'blog_image', 'status')->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('blog_image', function ($row) {
                    
                    $url= !empty($row->blog_image) ?url('/').Storage::url($row->blog_image) : asset('package_assets/images/default-images/default.png') ;
                    return '<img width="80px" src="'.$url.'" alt="image">';
                })
                ->addColumn('heading', function ($row) {
                    return !empty($row->heading) ? $row->heading : '' ;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/blogs/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="blogs" data-flash="Blog deleted successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="blogs" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="blogs" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->rawColumns(['blog_image','action', 'status'])
                ->make(true);
        }
    }

    public function edit($id){
        $edit_data = Blogs::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        return view('Admin.Blogs.add-blogs', compact('edit_data'));
    }

    public function check_slug_exist(Request $request){   
        $slug = $request->slug;
        $id = $request->id;
        if(!empty($id)){
        $id = Crypt::decrypt($request->id);
            
            $is_exists = Blogs::where('id', '!=', $id)->where('status', '!=', 'delete')->where('slug', $request->slug)->first();
            
        }else{
            $is_exists = Blogs::where('status', '!=', 'delete')->where('slug', $request->slug)->exists();
            
        }
        return !empty($is_exists)?'false':'true';
    }
}
