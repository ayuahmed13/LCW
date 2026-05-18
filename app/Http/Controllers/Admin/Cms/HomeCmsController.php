<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Models\HomeCmsData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShowcaseImages;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\Crypt;

class HomeCmsController extends Controller
{
    use MediaTrait;
    public function index(){
        //HomeCmsData
        $edit_data = HomeCmsData::where('status','active')->first();
        $showcase_data = ShowcaseImages::where('status','active')->get();
        
        return view('Admin.CMS.home',compact('edit_data','showcase_data'));
    }

    public function store(Request $request){
        $id = $request->id;
       
        $input = $request->all();
        
        if(!empty($input['section1_image1'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section1_image1', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section1_image1'] = $file_path;
        }

        if(!empty($input['section1_image2'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section1_image2', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section1_image2'] = $file_path;
        } 

        if(!empty($input['section1_image2'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section1_image2', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section1_image2'] = $file_path;
        }

        if(!empty($input['section1_image3'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section1_image3', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section1_image3'] = $file_path;
        }
       
        
        if(!empty($input['section3_image1'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section3_image1', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section3_image1'] = $file_path;
        }

        if(!empty($input['section3_image2'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section3_image2', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section3_image2'] = $file_path;
        }

        if(!empty($input['section3_image3'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section3_image3', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section3_image3'] = $file_path;
        }

        if(!empty($input['section4_image1'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section4_image1', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section4_image1'] = $file_path;
        }

        if(!empty($input['section4_image2'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section4_image2', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section4_image2'] = $file_path;
        }

        if(!empty($input['section5_icon1'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section5_icon1', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section5_icon1'] = $file_path;
        }

        if(!empty($input['section5_icon2'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section5_icon2', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section5_icon2'] = $file_path;
        }

        if(!empty($input['section5_icon2'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section5_icon2', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section5_icon2'] = $file_path;
        }

        if(!empty($input['section5_icon3'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section5_icon3', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section5_icon3'] = $file_path;
        }

        if(!empty($input['section5_icon4'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'section5_icon4', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','banner'))
                );
                $input['section5_icon4'] = $file_path;
        }

        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                HomeCmsData::find($id)->update($input);
                return redirect('admin/home')->with('success', 'Data Updated Successfully!');
            
        } else {
                
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                HomeCmsData::create($input);
                return redirect('admin/home')->with('success', 'Data Added Successfully!');
        }
    }

    public function ShowcaseStore(Request $request){
        $request->validate([
            'showcase_image' => 'required',
        ]);
        $input = $request->all();
        if(!empty($input['showcase_image'])){
            $file_path = $this->verifyAndUpload(
                    $request, 
                    'showcase_image', 
                    'uploads/homecms/images', 
                    strtolower( str_replace(' ','-','showcase-image'))
                );
                $input['showcase_image'] = $file_path;
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                ShowcaseImages::create($input);
                return redirect('admin/home')->with('success', 'Data Updated Successfully!');

            }else{
                return redirect('admin/home')->with('error', 'Something went wrong!');
            }
    }

    public function DeleteShowcaseImage($id){
        $id = Crypt::decrypt($id);

        $up_data = [
            'status' => 'delete'
        ];
        $up_data['created_by'] = auth()->guard('master_admins')->user()->id;
        //$up_data['created_ip_address'] = $request->ip();
        ShowcaseImages::where('id',$id)->update($up_data);
        return redirect('admin/home')->with('success', 'Deleted successfully!');

    }
}
