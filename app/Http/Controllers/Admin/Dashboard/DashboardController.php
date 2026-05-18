<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\ContactUsEnquiry;
use App\Models\Front\UserRegister;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Master\CategoryMaster;
use App\Models\Master\SubCategoryMaster;
use App\Models\Master\SubSubCategoryMaster;

class DashboardController extends Controller
{
    public function index(){
        
        $count['category_count'] = CategoryMaster::select('id')
            ->where('status', 'active')
            ->count();

        $count['subcategory_count'] = SubCategoryMaster::select('id')
            ->where('status', 'active')
            ->count();
        $count['subsubcategory_count'] = SubSubCategoryMaster::select('id')
            ->where('status', 'active')
            ->count();
        
        $count['products_count'] = Products::select('id')
            ->where('status', 'active')
            ->count();

        $count['customer_count'] = UserRegister::select('id')
            ->where('status', 'active')
            ->count();

        $count['contact_enq_count'] = ContactUsEnquiry::select('id')
            ->where('status', 'active')
            ->count();

        $count['orders_count'] = Orders::select('id')
            ->where('status', 'active')
            ->count();
        
        $count['payment_pending_orders_count'] = Orders::select('id')
            //->where('order_status', 'payment_pending')
            ->whereIn('orders.order_status', ['payment_pending','not_verified'])
            ->where('status', 'active')
            ->count();
            
            $count['pending_orders_count'] = Orders::select('id')
            ->where('order_status', 'pending')
            ->where('status', 'active')
            ->count();

                $count['confirmed_orders_count'] = Orders::select('id')
            ->where('order_status', 'confirmed')
            ->where('status', 'active')
            ->count();

                    $count['inprocess_orders_count'] = Orders::select('id')
            //->where('order_status', 'inprocess')
            ->whereIn('orders.order_status', ['inprocess','shipped','packed'])
            ->where('status', 'active')
            ->count();

                    $count['delivered_orders_count'] = Orders::select('id')
            ->where('order_status', 'delivered')
            ->where('status', 'active')
            ->count();

            $count['cancelled_orders_count'] = Orders::select('id')
            ->where('order_status', 'cancelled')
            ->where('status', 'active')
            ->count();

        return view('Admin.Dashboard.index',compact('count'));
    }
}
