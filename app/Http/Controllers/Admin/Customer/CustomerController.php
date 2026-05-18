<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Models\Orders;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Front\UserRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(){
        return view('Admin.Customers.customers');
    }

    public function data_table(Request $request){
        
        $table_data = UserRegister::where('user_registers.status', '!=', 'delete')
                            ->orderBy('user_registers.id', 'DESC')
                            ->select(
                                'user_registers.id',
                                'user_registers.customer_id',
                                'user_registers.first_name',
                                'user_registers.last_name',
                                'user_registers.full_name',
                                'user_registers.email',
                                'user_registers.profile_image',
                                'user_registers.phone_no',
                                'user_registers.status',
                                'user_registers.created_at'
                            )
                            ->addSelect([
                                'total_orders' => Orders::selectRaw('COUNT(*)')
                                    ->whereColumn('orders.user_id', 'user_registers.id')
                                    ->where('orders.status', 'active')
                            ])
                            ->get();
    
        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? $row->created_at : '' ;
                })
                ->addColumn('customer_id', function ($row) {
                    return !empty($row->customer_id) ? $row->customer_id : '' ;
                })
                ->addColumn('full_name', function ($row) {
                    return !empty($row->full_name) ? $row->full_name : '' ;
                })
                ->addColumn('email', function ($row) {
                    return !empty($row->email) ? $row->email : '' ;
                })
                ->addColumn('phone_no', function ($row) {
                    return !empty($row->phone_no) ? $row->phone_no : '' ;
                })
                ->addColumn('country_name', function ($row) {
                    return !empty($row->country_name) ? $row->country_name : 'NA' ;
                })
                
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="user_registers" data-flash="Customer Deleted Successfully!" class="btn btn-danger btn-sm delete" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    $created_date = date('d-m-Y',strtotime($row->created_at));
                    $profile_image =  !empty($row->profile_image) ?url('/').Storage::url($row->profile_image) : asset('package_assets/images/default-images/default.png') ;

                    $actionBtn .=  ' <a href="javascript:void" data-order-count="'.$row->total_orders.'" data-id="' . $row->id . '" data-name="' . $row->full_name . '" data-email="' . $row->email . '" data-phone="' . $row->phone_no . '" data-created-at="' . $created_date . '" data-customer-id="' . $row->customer_id . '" data-profile-image = "'.$profile_image.'" class="btn btn-info btn-sm btn-view-customer" >
                                            <i class="mdi mdi-eye"></i>
                                        </a>';
                    
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="user_registers" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="user_registers" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
                ->rawColumns(['brand_image','action', 'status'])
                ->make(true);
        }
    }

    public function ViewUserDetails(Request $request){}
}
