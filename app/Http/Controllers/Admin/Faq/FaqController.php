<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Models\FaqData;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class FaqController extends Controller
{
    public function index(){
        return view('Admin.CMS.faq');
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);
        $input = $request->all();
        
        if (!empty($id)) {
                $id = Crypt::decrypt($id);
                
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                FaqData::find($id)->update($input);
                return redirect('admin/faq')->with('success', 'FAQ updated successfully!');
            
        } else {
                
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                FaqData::create($input);
                return redirect('admin/faq')->with('success', 'FAQ added successfully!');
        }
    }

    public function data_table(Request $request){
        $table_data = FaqData::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'question', 'answer','status')->get();
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('question', function ($row) {
                    return !empty($row->question) ? $row->question : '' ;
                })
                ->addColumn('answer', function ($row) {
                    return !empty($row->answer) ? $row->answer : '' ;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/faq/edit/' . Crypt::encrypt($row->id) ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-sm Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="faq_data" data-flash="FAQ deleted successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="faq_data" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="faq_data" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->rawColumns(['answer','action', 'status'])
                ->make(true);
        }
    }

    public function edit($id){
        $id = Crypt::decrypt($id);
        $edit_data = FaqData::where('id',$id)->first();
        return view('Admin.CMS.faq',compact('edit_data'));
    }
}
