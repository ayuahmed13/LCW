<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\OrderProducts;
use Yajra\DataTables\DataTables;
use App\Models\Front\UserRegister;
use App\Http\Controllers\Controller;
use App\Models\Master\CategoryMaster;
use App\Models\OrderStatusLogs;
use App\Models\Products;
use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller
{
    public function index(Request $request){
        $order_status = !empty($request->order_status) ? $request->order_status : 'pending';
        $page_heading = ucwords($order_status);

        if($order_status=='verified'){
            $page_heading = 'Pending';
        }else if($order_status=='not_verified' || $order_status=='payment_pending'){
            $page_heading = 'Payment Pending';
        }else if($order_status=='shipped' || $order_status=='packed'){
            $page_heading = 'Inprocess';
        }
        return view('Admin.Orders.orders',compact('order_status','page_heading'));
    }

    public function data_table(Request $request)
    {
        $order_status = !empty($request->order_status) ? $request->order_status : 'pending';
        $from_date = $request->from_date;
        $to_date = !empty($request->to_date)?$request->to_date:date('Y-m-d');
        
        if($order_status=='inprocess'){
            $order_status_arr = ['shipped','packed','inprocess'];
        }else if($order_status=='payment_pending'){
            $order_status_arr = ['payment_pending','not_verified'];
        }else{
            $order_status_arr = [$order_status];
        }
        $query = Orders::where('orders.status', '!=', 'delete')
//            ->where('orders.order_status', $order_status)
            ->whereIn('orders.order_status', $order_status_arr)
            ->join('user_registers', 'orders.user_id', '=', 'user_registers.id')
            ->select(
                'orders.id',
                'orders.order_id',
                'orders.total_amount',
                'orders.created_at',
                'orders.order_status',
                'user_registers.full_name',
                'user_registers.customer_id',
                'user_registers.phone_no'
            );  

        // ✅ Apply date range filter if both dates are provided
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereDate('orders.created_at', '>=', $from_date)
                ->whereDate('orders.created_at', '<=', $to_date);
        }

        $table_data = $query->orderBy('orders.id', 'DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($table_data)
                ->addIndexColumn()
                ->addColumn('order_id', function ($row) {
                    return !empty($row->order_id) ? $row->order_id : '';
                })
                ->addColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? date('d-m-Y h:i A', strtotime($row->created_at)) : '';
                })
                ->addColumn('full_name', function ($row) {
                    return !empty($row->full_name) ? $row->full_name : '';
                })
                ->addColumn('phone_no', function ($row) {
                    return !empty($row->phone_no) ? $row->phone_no : '';
                })
                ->addColumn('total_amount', function ($row) {
                    return !empty($row->total_amount) ? number_format($row->total_amount, 2) : '';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/orders/view/' . Crypt::encrypt($row->id)) . '?order_status='.$row->order_status.'"> 
                                    <button type="button" data-id="' . $row->id . '" class="btn btn btn-table-view btn-sm view_button" title="view">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function view(Request $request){
        $id = Crypt::decrypt($request->id);
        $order_status = $request->order_status;

        $order_data = Orders::where('status','active')
                                ->where('id',$id)
                                ->where('order_status',$order_status)
                                ->select(
                                    'id',
                                    'user_id',
                                    'order_id',
                                    'total_amount',
                                    'order_date_time',
                                    'order_status',
                                    'sub_total',
                                    'total_amount',
                                    'tax_per',
                                    'tax_amount',
                                    'total_products',
                                    'payment_method',
                                      'invoice_pdf',
                                    'invoice_no',
                                    'billing_address_type',
                                    'billing_address_first_name',
                                    'billing_address_last_name',
                                    'billing_address_email',
                                    'billing_address_phone',
                                    'billing_address_country_region',
                                    'billing_address_town_city',
                                    'billing_address_street',
                                    'billing_address_state',
                                    'billing_address_postal_code',
                                    'billing_address_note',

                                    'shipping_same_as_billing',

                                    'shipping_address_type',
                                    'shipping_address_first_name',
                                    'shipping_address_last_name',
                                    'shipping_address_email',
                                    'shipping_address_phone',
                                    'shipping_address_country_region',
                                    'shipping_address_town_city',
                                    'shipping_address_street',
                                    'shipping_address_state',
                                    'shipping_address_postal_code',
                                    'shipping_address_note',
                                    'transaction_id',
                                    'created_at',

                                    'order_placed_on',
                                    'order_confirmed_on',
                                    'order_inprocess_on',
                                    'order_packed_on',
                                    'order_shipped_on',
                                    'order_delivered_on',
                                    'order_cancelled_on',
                                    'order_verified_on',
                                    'order_not_verified_on',

                                    'tracking_no',
                                    'tracking_url',
                                    'courier_name',

                                    )
                                    ->orderBy('id','desc')
                                    ->first();
        if(empty($order_data->id)){
            return redirect('admin/orders?order_status='.$order_status)->with('error','Order details not found');
        }

        $ordered_products = OrderProducts::where('status','active')
                                ->where('order_id', $order_data->id)
                                ->select(
                                    'id', 
                                    'order_id', 
                                    'product_id', 
                                    'product_name', 
                                    'product_main_image', 
                                    'product_price', 
                                    'product_offer_price', 
                                    'product_qty', 
                                    'product_tax_per', 
                                    'product_tax_amount', 
                                    'product_total_amount', 
                                    'sub_total_without_tax', 
                                    'sub_total_with_tax'
                                    )
                                ->orderBy('id','desc')
                                ->get();
        if(!empty($ordered_products)){
            foreach($ordered_products as $k => $value){
                $prod = Products::where('id', $value->product_id)->select('category_id')->first();
                $cat_id = !empty($prod->category_id)?$prod->category_id:'0';
                $cat = CategoryMaster::where('id',$cat_id)->select('category_name')->first();
                $ordered_products[$k]['category_name'] = !empty($cat->category_name)?$cat->category_name:'NA';
            }
        }
        
        $select = array(
            'id',
            "profile_image",
            "full_name",
            "email",
            "phone_no",
            "company_name",
        );
        $data = UserRegister::where('id',$order_data->user_id)->select($select)->first();
        
        $page_heading = ucwords($order_status);

        if($order_status=='verified'){
            $page_heading = 'Pending';
        }else if($order_status=='not_verified'){
            $page_heading = 'Payment Pending';
        }else if($order_status=='shipped' || $order_status=='packed'){
            $page_heading = 'Inprocess';
        }

        return view('Admin.Orders.View.pending-view',compact('data','order_data','ordered_products','page_heading'));
    }

    public function ChangeOrderStatus(Request $request){
        $id = Crypt::decrypt($request->id);
        $order_status = $request->order_status;
        $set_data = [
            'order_status' => $order_status,
            'order_'.$order_status.'_on' => date('Y-m-d H:i:s'),
        ];
        if($order_status=='shipped'){
            $set_data['courier_name'] = $request->courier_name;
            $set_data['tracking_no'] = $request->tracking_no;
            $set_data['tracking_url'] = $request->tracking_url;
            
            $other_data = json_encode(['courier_name' =>$request->courier_name,'tracking_no' =>$request->tracking_no,'tracking_url' =>$request->tracking_url]);
        }
        if($order_status=='cancelled'){
            $set_data['pending_form_remark'] = !empty($request->pending_form_remark)?$request->pending_form_remark:'';
            $set_data['confirmed_form_remark'] = !empty($request->confirmed_form_remark)?$request->confirmed_form_remark:'';
            $set_data['inprocess_form_remark'] = !empty($request->inprocess_form_remark)?$request->inprocess_form_remark:'';
        }
        if($order_status=='verified'){
            $set_data['order_status'] = 'pending';
        }
        $set_data['modified_by'] = auth()->guard('master_admins')->user()->id;
        $set_data['modified_ip_address'] = $request->ip();
        Orders::where('status','active')
                ->where('id',$id)
                ->update($set_data);

        $cancelled_remark = !empty($set_data['pending_form_remark'])?$set_data['pending_form_remark']:'';
        if(empty($cancelled_remark)){
            $cancelled_remark = !empty($set_data['confirmed_form_remark'])?$set_data['confirmed_form_remark']:'';
            if(empty($cancelled_remark)){
                $cancelled_remark = !empty($set_data['inprocess_form_remark'])?$set_data['inprocess_form_remark']:'';
            }
        }
        if(!empty($cancelled_remark)){
        $other_data = json_encode(['cancel_reason'=>$cancelled_remark]);
        }
        $log_data =[
            'order_id' => $id,
            'order_status' => $order_status,
            'other_data' => !empty($other_data)?$other_data:''
        ];
        $log_data['created_by'] = auth()->guard('master_admins')->user()->id;
        $log_data['created_ip_address'] = $request->ip();
        OrderStatusLogs::create($log_data);
        
        $redirect_status = $order_status;

        if($order_status=='verified'){
            $redirect_status = 'pending';
        }else if($order_status=='not_verified'){
            $redirect_status = 'payment_pending';
        }else if($order_status=='shipped' || $order_status=='packed'){
            $redirect_status = 'inprocess';
        }

        return redirect('admin/orders?order_status='.$redirect_status)->with('success','Order status updated successfully');
    }
}
