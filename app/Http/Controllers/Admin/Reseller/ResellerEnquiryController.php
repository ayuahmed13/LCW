<?php

namespace App\Http\Controllers\Admin\Reseller;

use Illuminate\Http\Request;
use App\Models\ResellerEnquiry;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ResellerEnquiryController extends Controller
{
    public function index(Request $request){
        return view('Admin.Reseller.reseller');
    }

    public function data_table(Request $request){
        
        $table_data = ResellerEnquiry::where('status', '!=', 'delete')
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
                            'abn',
                            'company_trade_name',
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
                ->addColumn('abn', function ($row) {
                    return !empty($row->abn) ? $row->abn : '' ;
                })
                ->addColumn('company_trade_name', function ($row) {
                    return !empty($row->company_trade_name) ? $row->company_trade_name : '' ;
                })
                ->addColumn('message', function ($row) {
                    return !empty($row->message) ? $row->message : '' ;
                })
                
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="reseller_enquiries" data-flash="Data Deleted Successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
