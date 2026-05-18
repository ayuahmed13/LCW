<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\PageContentCmsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PageCoontentCmsController extends Controller
{
    public function index(){
        return view('Admin.CMS.pages-content');
    }

    public function get_pages_content(Request $request){
        $page_name = $request->page_name;

        $data = PageContentCmsData::where('status', '=', 'active')
                                    ->where('page',$page_name)
                                    ->select('id', 'content')
                                    ->first();
                                    
        $html = !empty($data)?$data:'';
        if(empty($html)){
            return response()->json([
                'status' => 404,
                'data' => $html,
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'data' => $html,
            ]);
        }
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'page_name' => 'required',
            'content' => 'required',
        ]);

        $input = $request->all();
        $input['page'] = $input['page_name'];
        if (!empty($id)) {
                //$id = Crypt::decrypt($id);
                
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                PageContentCmsData::find($id)->update($input);
                return redirect('admin/pages-content')->with('success', 'Data Updated Successfully!');
            
        } else {
                
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                PageContentCmsData::create($input);
                return redirect('admin/pages-content')->with('success', 'Data Added Successfully!');
        }
    }

}
