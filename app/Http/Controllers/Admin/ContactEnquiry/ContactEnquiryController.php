<?php

namespace App\Http\Controllers\Admin\ContactEnquiry;

use Illuminate\Http\Request;
use App\Models\ContactUsEnquiry;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ContactEnquiryController extends Controller
{
    public function index(){
        return view('Admin.Contact.contact');
    }

    public function data_table(Request $request){
        
        $table_data = ContactUsEnquiry::where('status', '!=', 'delete')
                        ->when($request->from_date, function ($query, $from_date) {
                            return $query->whereDate('created_at','>=', $from_date);
                        })
                        ->when($request->to_date, function ($query, $to_date) {
                            return $query->whereDate('created_at','<=', $to_date);
                        })
                        ->orderBy('id', 'DESC')
                        ->select(
                            'id',
                            'name', 
                            'email',
                            'mobile',
                            'subject',
                            'message',
                            'created_at',
                        )
                        ->get();


        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? date('d-m-Y h:i A',strtotime($row->created_at)) : '' ;
                })
                ->addColumn('name', function ($row) {
                    return !empty($row->name) ? $row->name : '' ;
                })
                ->addColumn('email', function ($row) {
                    return !empty($row->email) ? $row->email : '' ;
                })
                ->addColumn('mobile', function ($row) {
                    return !empty($row->mobile) ? $row->mobile : '' ;
                })
                ->addColumn('subject', function ($row) {
                    return !empty($row->subject) ? $row->subject : '' ;
                })
                ->addColumn('message', function ($row) {
                    return !empty($row->message) ? $row->message : '' ;
                })
                
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="contact_us_enquiries" data-flash="Data Deleted Successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
