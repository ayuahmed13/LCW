<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Models\AboutUsCms;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\AboutUsTestimonials;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AboutUsCmsController extends Controller
{
    use MediaTrait;
    public function index(){
        $edit_data = AboutUsCms::where('id',1)->first();
        // get images data
        return view('Admin.CMS.about',compact('edit_data'));
    }
 
    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'heading' => 'required',
            'about_lcw' => 'required',
            'our_mission' => 'required',
            'our_vision' => 'required',
            //'image' => 'required',
        ]);
        $input = $request->all();
        
        if(!empty($input['image'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'image', 
                    'uploads/admin/about/images', 
                    strtolower( str_replace(' ','-','about-us'))
                );
        }
        if(!empty($file_path)){
            $input['image'] = $file_path;
        }

        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AboutUsCms::find($id)->update($input);
                return redirect('admin/about')->with('success', 'Data Updated Successfully!');
            
        } else {
                
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AboutUsCms::create($input);
                return redirect('admin/about')->with('success', 'Data Added Successfully!');
        }
    } 

    public function TestimonialStore(Request $request){
        $id = $request->id;
        $request->validate([
            'heading' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        $input = $request->all();
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AboutUsTestimonials::find($id)->update($input);
                return redirect('admin/about#tform')->with('success', 'Data Updated Successfully!');
            
        } else {
                
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AboutUsTestimonials::create($input);
                return redirect('admin/about#tform')->with('success', 'Data Added Successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = AboutUsTestimonials::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'name', 'heading','description', 'status')->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return !empty($row->name) ? $row->name : '' ;
                })
                ->addColumn('heading', function ($row) {
                    return !empty($row->heading) ? $row->heading : '' ;
                })
                ->addColumn('description', function ($row) {
                    return !empty($row->description) ? $row->description : '' ;
                })
                
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/about/edit-testimonial/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="about_us_testimonials" data-flash="Data Deleted Successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="about_us_testimonials" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="about_us_testimonials" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->rawColumns(['description','action', 'status'])
                ->make(true);
        }
    }
    public function EditTestimonial($id){
        $edit_data = AboutUsCms::where('id',1)->first();
        $edit_data1 = AboutUsTestimonials::where('status', '!=', 'delete')->where('id',Crypt::decrypt($id))->first();
        $scroll_to = 'tform';
        return view('Admin.CMS.about',compact('edit_data1','edit_data','scroll_to'));
    }

}
