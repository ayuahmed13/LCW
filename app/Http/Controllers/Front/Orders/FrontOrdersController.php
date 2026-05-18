<?php

namespace App\Http\Controllers\Front\Orders;

use PDF;
use Mpdf\Mpdf;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Models\OrderProducts;
use App\Mail\MailOrderToAdmin;
use App\Models\Master\GstMaster;
use App\Mail\MailOrderToCustomer;
use App\Models\Front\UserRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\Master\General_setting;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Settings\GeneralSettings;

class FrontOrdersController extends Controller
{
    public function PlaceOrder(Request $request){
        
        $user_id = Auth::guard('master_users')->id();
        if(empty($request->payment_method)){
            return redirect()->back()->with('error','No payment method found');
        }else if($request->payment_method!="bank_transfer"){
            return redirect()->back()->with('error','Invalid payment method');
        }
        $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
        $cart_id = !empty($cart->id)?$cart->id:'';

        if(empty($cart_id)){
            return redirect('my-account')->with('error', 'Cart is empty or not found.');
        }
        $product_ids = array();

        $cart_products = CartProduct::select(
                                                'cart_products.id as key_id',
                                                'cart_products.product_qty as quantity',
                                                'products.id', 
                                                'products.product_name as name', 
                                                'products.slug_url',
                                                'products.product_main_image',
                                                'products.offer_price as price',
                                                'products.price as product_main_price',
                                                'products.is_gst',
                                                'products.gst_id',
                                             ) // add needed fields
                    ->join('products', 'cart_products.product_id', '=', 'products.id')
                    ->where('cart_products.cart_id', $cart_id)
                    ->where('products.status', 'active')
                    ->where('cart_products.status', 'active')
                    ->get()->toArray();
        if(empty( $cart_products)){
            return redirect('my-account')->with('error', 'No products in cart.');
        }
        $sub_total_without_tax = 0;
        
        foreach($cart_products as $key => $value){
            $cart_products[$key]['qty'] = $value['quantity'];
            array_push($product_ids,$value['id']);
            if(!empty($value['price'])){
                $sub_total_without_tax += $value['price']*$value['quantity'];
            }
        }
         $gst_data = GstMaster::where('status','active')
                                    ->select('id','gst_value')
                                    ->orderBy('id','desc')
                                    ->first();
        $gst_per = !empty($gst_data->gst_value)?$gst_data->gst_value:18;
        $gst_val = $sub_total_without_tax*$gst_per/100;
        $sub_total_with_tax =  $sub_total_without_tax + ($sub_total_without_tax*$gst_per/100);
                    
        $form_data = $request->all();
        $form_data['total_products'] = count($cart_products);
        $form_data['sub_total']=$sub_total_without_tax;
        $form_data['tax_per']=$gst_per;
        $form_data['tax_amount']=$gst_val;
        $form_data['total_amount']= $sub_total_with_tax;

        $form_data['sub_total_without_tax']=$sub_total_without_tax;
        $form_data['sub_total_with_tax']= $sub_total_with_tax;

        if(!empty($form_data['shipping_same_as_billing']) && $form_data['shipping_same_as_billing']=='yes'){
            $form_data["shipping_address_type"] = $form_data["billing_address_type"];
            $form_data["shipping_address_first_name"] = $form_data["billing_address_first_name"];
            $form_data["shipping_address_last_name"] = $form_data["billing_address_last_name"];
            $form_data["shipping_address_email"] = $form_data["billing_address_email"];
            $form_data["shipping_address_phone"] = $form_data["billing_address_phone"];
            $form_data["shipping_address_country_region"] = $form_data["billing_address_country_region"];
            $form_data["shipping_address_town_city"] = $form_data["billing_address_town_city"];
            $form_data["shipping_address_street"] = $form_data["billing_address_street"];
            $form_data["shipping_address_state"] = $form_data["billing_address_state"];
            $form_data["shipping_address_postal_code"] = $form_data["billing_address_postal_code"];
            $form_data["shipping_address_note"] = $form_data["billing_address_note"];
        }
        
        $order_data  = [
            'user_id' =>$user_id,
            'order_date_time' =>date('Y-m-d H:i:s'),
            'sub_total' =>$form_data['sub_total'],
            'tax_per' =>$form_data['tax_per'],
            'tax_amount' =>$form_data['tax_amount'],
            'shipping_charges' =>!empty($form_data['shipping_charges'])?$form_data['shipping_charges']:'',
            'is_couponcode' =>!empty($form_data['is_couponcode'])?$form_data['is_couponcode']:'no',
            'couponcode' =>!empty($form_data['couponcode'])?$form_data['couponcode']:'no',
            'couponcode_amount' =>!empty($form_data['couponcode_amount'])?$form_data['couponcode_amount']:'no',
            'couponcode_per' =>!empty($form_data['couponcode_per'])?$form_data['couponcode_per']:'no',
            'total_amount' =>$form_data['total_amount'],
            'total_products' =>$form_data['total_products'],
            'order_status' =>'pending',

            'billing_address_type' => $form_data['billing_address_type'],
            'billing_address_first_name' => $form_data['billing_address_first_name'],
            'billing_address_last_name' => $form_data['billing_address_last_name'],
            'billing_address_email' => $form_data['billing_address_email'],
            'billing_address_phone' => $form_data['billing_address_phone'],
            'billing_address_country_region' => $form_data['billing_address_country_region'],
            'billing_address_town_city' => $form_data['billing_address_town_city'],
            'billing_address_street' => $form_data['billing_address_street'],
            'billing_address_state' => $form_data['billing_address_state'],
            'billing_address_postal_code' => $form_data['billing_address_postal_code'],
            'billing_address_note' => $form_data['billing_address_note'],

            'shipping_same_as_billing' =>!empty($form_data['shipping_same_as_billing'])?$form_data['shipping_same_as_billing']:'',

            'shipping_address_type' => $form_data['shipping_address_type'],
            'shipping_address_first_name' => $form_data['shipping_address_first_name'],
            'shipping_address_last_name' => $form_data['shipping_address_last_name'],
            'shipping_address_email' => $form_data['shipping_address_email'],
            'shipping_address_phone' => $form_data['shipping_address_phone'],
            'shipping_address_country_region' => $form_data['shipping_address_country_region'],
            'shipping_address_town_city' => $form_data['shipping_address_town_city'],
            'shipping_address_street' => $form_data['shipping_address_street'],
            'shipping_address_state' => $form_data['shipping_address_state'],
            'shipping_address_postal_code' => $form_data['shipping_address_postal_code'],
            'shipping_address_note' => $form_data['shipping_address_note'],

            'payment_method' =>!empty($form_data['payment_method'])?$form_data['payment_method']:'',
            'payment_status' =>!empty($form_data['payment_status'])?$form_data['payment_status']:'pending',
            'tracking_no' =>!empty($form_data['tracking_no'])?$form_data['tracking_no']:'',
            'transaction_id' =>!empty($form_data['transaction_id'])?$form_data['transaction_id']:'',
            'order_placed_on' => date('Y-m-d H:i:s'),
            'payment_gayeway_response' =>!empty($form_data['payment_gayeway_response'])?json_encode($form_data['payment_gayeway_response']):'',
            'created_by' => $user_id,
            'created_ip_address' => $request->ip(),
        ];

        if( $order_data['payment_method']=='bank_transfer'){
            $order_data['order_status'] = 'payment_pending';
        }
        $order_data['transaction_id'] = 'TRN'.time().date('Y').rand('10000','99999');
        // Insert Order Data
        $insert_order = Orders::create($order_data);
        
        if(empty($insert_order->id)){
            return redirect('my-account')->with('error', 'Something went wrong with order.');
        }
        $order_id ='ORD' . str_pad($insert_order->id, 9, '0', STR_PAD_LEFT);
        Orders::where('id',$insert_order->id)->update(['order_id'=>$order_id]);
        $sub_total_without_tax = 0;
        $ordered_products = array();
        $cart_products;
        foreach($cart_products as $key => $value){
            $cart_products[$key]['qty'] = $value['quantity'];
            array_push($product_ids,$value['id']);
           
            if(!empty($value['price'])){
                $sub_total_without_tax = $value['price']*$value['quantity'];
                $sub_total_with_tax = $sub_total_without_tax;
                $value['sub_total_without_tax'] = $sub_total_without_tax;

                // if(!empty($value['is_gst']) && $value['is_gst']=='yes'){
                    // $gst_data = GstMaster::where('id',$value['gst_id'])
                    //                 ->where('status','active')
                    //                 ->select('id','gst_value')
                    //                 ->first();
                     $gst_data = GstMaster::where('status','active')
                                    ->select('id','gst_value')
                                    ->orderBy('id','desc')
                                    ->first();
                    $gst_per = !empty($gst_data->gst_value)?$gst_data->gst_value:18;
                    
                    $gst_val = $sub_total_without_tax*$gst_per/100;
                    $sub_total_with_tax =  $sub_total_without_tax + ($sub_total_without_tax*$gst_per/100);
                    
                    $value['tax_per'] = $gst_per;
                    $value['tax_amount'] = $gst_val;
                // }
                $value['sub_total_with_tax'] = $sub_total_with_tax;
            }

        $product_row = [
                'order_id' => $insert_order->id,
                'product_id' => !empty($value['id'])?$value['id']:'',
                'product_name' => !empty($value['name'])?$value['name']:'',
                'product_main_image' => !empty($value['product_main_image'])?$value['product_main_image']:'',
                'product_price' => !empty($value['product_main_price'])?$value['product_main_price']:'',
                'product_offer_price' => !empty($value['price'])?$value['price']:'',
                'product_qty' => !empty($value['quantity'])?$value['quantity']:'',
                'product_tax_per' => !empty($value['tax_per'])?$value['tax_per']:'',
                'product_tax_amount' => !empty($value['tax_amount'])?$value['tax_amount']:'',
                
                'sub_total_without_tax' => !empty($value['sub_total_without_tax'])?$value['sub_total_without_tax']:'',
                'sub_total_with_tax' => !empty($value['sub_total_with_tax'])?$value['sub_total_with_tax']:'',
                
                'product_total_amount' => !empty($value['sub_total_with_tax'])?$value['sub_total_with_tax']:'',
                'created_by' => $user_id,
                'created_ip_address' => $request->ip(),
            ];

            array_push($ordered_products,$product_row);
        }
        if(!empty($ordered_products)){
           $are_products_inserted = OrderProducts::insert($ordered_products);
           //empty cart after order placed
            Cart::where('id',$cart_id)->delete();
            CartProduct::where('cart_id',$cart_id)->delete();
            session()->put('cart_count', 0);


            // Send order mail to admin

            $billing_address = [
                'billing_address_type' => $form_data['billing_address_type'],
                'billing_address_first_name' => $form_data['billing_address_first_name'],
                'billing_address_last_name' => $form_data['billing_address_last_name'],
                'billing_address_email' => $form_data['billing_address_email'],
                'billing_address_phone' => $form_data['billing_address_phone'],
                'billing_address_country_region' => $form_data['billing_address_country_region'],
                'billing_address_town_city' => $form_data['billing_address_town_city'],
                'billing_address_street' => $form_data['billing_address_street'],
                'billing_address_state' => $form_data['billing_address_state'],
                'billing_address_postal_code' => $form_data['billing_address_postal_code'],
                'billing_address_note' => $form_data['billing_address_note'],
                ];
            $shipping_address = [
                'shipping_address_type' => $form_data['shipping_address_type'],
                'shipping_address_first_name' => $form_data['shipping_address_first_name'],
                'shipping_address_last_name' => $form_data['shipping_address_last_name'],
                'shipping_address_email' => $form_data['shipping_address_email'],
                'shipping_address_phone' => $form_data['shipping_address_phone'],
                'shipping_address_country_region' => $form_data['shipping_address_country_region'],
                'shipping_address_town_city' => $form_data['shipping_address_town_city'],
                'shipping_address_street' => $form_data['shipping_address_street'],
                'shipping_address_state' => $form_data['shipping_address_state'],
                'shipping_address_postal_code' => $form_data['shipping_address_postal_code'],
                'shipping_address_note' => $form_data['shipping_address_note'],
            
            ];
            
            if(!empty($form_data['shipping_same_as_billing']) && $form_data['shipping_same_as_billing']=='yes'){
                $shipping_address = $billing_address;
            }
            //$general = GeneralSettings::where('status','active')->first();
            
             $bank_data = General_setting::where('status','active')
                        ->select([
                                'account_name',
                                'bsb',
                                'account_number',
                                'bank_name',
                                'swift_code',
                                'update_log',
                                'last_updated_date',
                        ])
                        ->first();
            $bank_data = General_setting::where('status','active')
                        ->select([
                                'account_name',
                                'bsb',
                                'account_number',
                                'bank_name',
                                'swift_code',
                                
                        ])
                        ->first();
            $data = [
                'total_order_price_excluded_gst' => !empty($order_data['sub_total'])?$order_data['sub_total']:'',
                'delivery_charge' => !empty($order_data['shipping_charges'])?$order_data['shipping_charges']:'',
                'total_payable' => !empty($order_data['total_amount'])?$order_data['total_amount']:'',
                'net_paid' => !empty($order_data['total_amount'])?$order_data['total_amount']:'',
                'billing_address' => $billing_address,
                'shipping_address' => $shipping_address,
                'ordered_products' => $ordered_products,
                'shipping_same_as_billing' => !empty($form_data['shipping_same_as_billing'])?$form_data['shipping_same_as_billing']:'no',
                'tax_per' =>$form_data['tax_per'],
                'tax_amount' =>$form_data['tax_amount'],
                
                'payment_method' =>!empty($form_data['payment_method'])?$form_data['payment_method']:'no',
                'client_name' =>config('constant.client_name'),
                'client_email' =>config('constant.client_email'),
                'client_mobile' =>config('constant.client_mobile'),
                'client_address' =>config('constant.client_address'),
                'client_helpline' =>config('constant.client_helpline'),

                // 'beneficiary' =>config('constant.beneficiary'),
                // 'bank_name' =>config('constant.bank_name'),
                // 'bsb' =>config('constant.bsb'),
                // 'bank_account_number' =>config('constant.bank_account_number'),

                'beneficiary' =>!empty($bank_data->account_name)?$bank_data->account_name:'',
                'bank_name' =>!empty($bank_data->bank_name)?$bank_data->bank_name:'',
                'bsb' =>!empty($bank_data->bsb)?$bank_data->bsb:'',
                'bank_account_number' =>!empty($bank_data->account_number)?$bank_data->account_number:'',
                
                'order_id' => $order_id,
                'order_date' => date('d M Y'),
                'order_status' => 'pending'
            ];
            
            $data['data'] = $data;

            $htmlContent = view('mail/order-invoice-mail-pdf', $data)->render();

            // Load the PDF view with A4 paper size
            $pdf = PDF::loadView('mail.order-invoice-mail-pdf', $data)
                    ->setPaper('a4', 'portrait');

            // Define file name and paths
            $orderId = $data['order_id'];
            $fileName = strtolower($orderId) . '-order-' . date('YmdHis') . '-' . time() . '.pdf';

            // Relative path within the disk
            $relativePath = 'uploads/order-pdf/' . $fileName;

            // Store PDF file using Laravel Storage
            Storage::disk('public')->put($relativePath, $pdf->output());

            // Save relative path in DB (without full URL)
            Orders::where('id', $insert_order->id)->update([
                'invoice_pdf' => $relativePath,
                'invoice_no'  => 'INV' . $orderId
            ]);

            Mail::to('mplussoftesting@gmail.com')->send(new MailOrderToAdmin($data));
            
            if(!empty($form_data['billing_address_email'])){
                Mail::to($form_data['billing_address_email'])->send(new MailOrderToCustomer($data));
            }
            if(!empty($form_data['shipping_same_as_billing']) && $form_data['shipping_same_as_billing']=='yes'){
               
            }else{
                 if(!empty($form_data['shipping_address_email'])){
                    Mail::to($form_data['shipping_address_email'])->send(new MailOrderToCustomer($data));
                }
            }
            
            Mail::to(Auth::guard('master_users')->user()->email)->send(new MailOrderToCustomer($data));

            return redirect('my-account-orders')->with('success', 'Order placed successfully.');

        }else{
            Orders::where('id',$insert_order->id)->delete();
            return redirect('my-account-orders')->with('error', 'Unable to place order.');

        }

        return array($order_data,$ordered_products);
    }

    public function MyAccountOrders(Request $request){
        $user_id = Auth::guard('master_users')->id();
        $select = array(
            'id',
            "profile_image",
            "full_name",
            "email",
            "phone_no",
            "company_name",
        );
        $data = UserRegister::where('id',$user_id)->select($select)->first();

        $order_data = Orders::where('user_id',$user_id)
                                ->where('status','active')
                                ->select(
                                    'id',
                                    'order_id',
                                    'total_amount',
                                    'order_date_time',
                                    'order_status',
                                    'sub_total',
                                    'total_amount',
                                    'total_products',
                                    'invoice_pdf',
                                    'invoice_no'
                                    )
                                    ->orderBy('id','desc')
                                    ->get();
        
        return view('Front.my-account-orders',compact('order_data','data'));

    }

    public function MyAccountOrdersDetails($id){
        $user_id = Auth::guard('master_users')->id();
        $select = array(
            'id',
            "profile_image",
            "full_name",
            "email",
            "phone_no",
            "company_name",
        );
        $data = UserRegister::where('id',$user_id)->select($select)->first();
        $id = Crypt::decrypt($id);
        $order_data = Orders::where('user_id',$user_id)
                                ->where('status','active')
                                ->where('id',$id)
                                ->select(
                                    'id',
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
                                    'courier_name','tracking_no','tracking_url',
                                    'created_at',
                                    'order_placed_on', 
                                    'order_confirmed_on', 
                                    'order_inprocess_on', 
                                    'order_packed_on', 
                                    'order_shipped_on', 
                                    'order_delivered_on', 
                                    'order_cancelled_on'
                                    )
                                    ->orderBy('id','desc')
                                    ->first();
        if(empty($order_data->id)){
            return redirect('my-account-orders')->with('error','Order details not found');
        }
        // $ordered_products = OrderProducts::where('status','active')
        //                         ->where('order_id', $order_data->id)
        //                         ->select(
        //                             'id', 
        //                             'order_id', 
        //                             'product_id', 
        //                             'product_name', 
        //                             'product_main_image', 
        //                             'product_price', 
        //                             'product_offer_price', 
        //                             'product_qty', 
        //                             'product_tax_per', 
        //                             'product_tax_amount', 
        //                             'product_total_amount', 
        //                             'sub_total_without_tax', 
        //                             'sub_total_with_tax'
        //                             )
        //                         ->orderBy('id','desc')
        //                         ->get();

        $ordered_products = OrderProducts::where('order_products.status', 'active')
                            ->where('order_products.order_id', $order_data->id)
                            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
                            ->select(
                                'order_products.id', 
                                'order_products.order_id', 
                                'order_products.product_id', 
                                'order_products.product_name', 
                                'order_products.product_main_image', 
                                'order_products.product_price', 
                                'order_products.product_offer_price', 
                                'order_products.product_qty', 
                                'order_products.product_tax_per', 
                                'order_products.product_tax_amount', 
                                'order_products.product_total_amount', 
                                'order_products.sub_total_without_tax', 
                                'order_products.sub_total_with_tax',

                                // Optional: Add fields from products table
                                'products.slug_url',
                            )
                            ->orderBy('order_products.id', 'desc')
                            ->get();

        return view('Front.my-account-orders-details',compact('order_data','data','ordered_products'));
    }

    public function generatePdf()
    {
        // HTML content
        $html = '<h1>Hello, this is a PDF generated by mPDF in Laravel!</h1>';

        // Initialize mPDF
        $mpdf = new Mpdf();

        // Write HTML to the PDF
        $mpdf->WriteHTML($html);

        // Output the PDF directly to browser
        return response($mpdf->Output('', 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="sample.pdf"');

            $data = [
              'order_id' => rand(11111,99999),
                'order_date' => date('d M Y'),
                'order_status' => 'pending'
        ];
        $pdf = PDF::loadView('mail/mail-order-to-customer', $data);
        
                // Generate file name and save location
                $fileName = strtolower($data['order_id']) . '-prescription-' . date('YmdHis') . '-' . time() . '.pdf';
                $filePath = storage_path('app/public/order-pdf/' . $fileName);

                // Ensure directory exists
                $directory = dirname($filePath);
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                // Save the PDF to the given path
                $pdf->save($filePath);
            die;
    }
}
