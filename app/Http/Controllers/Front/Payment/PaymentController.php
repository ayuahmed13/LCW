<?php

namespace App\Http\Controllers\Front\Payment;

use Stripe\Stripe;
use App\Models\Cart;

use App\Models\Orders;
use App\Models\TmpForm;
use Stripe\PaymentIntent;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\OrderProducts;
use App\Mail\MailOrderToAdmin;
use App\Models\Master\GstMaster;
use App\Mail\MailOrderToCustomer;
use App\Http\Controllers\Controller;
use App\Models\Master\General_setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;
class PaymentController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user_id = Auth::guard('master_users')->id();

        if(!empty($user_id)){

            $cart = Cart::where('user_id', $user_id)
                        ->where('status', 'active')
                        ->first();
            $product_ids = array();

            if(!empty($cart)){
                $cart_id = $cart->id;
                $cart_products = CartProduct::select(
                                                'cart_products.id as key_id',
                                                'cart_products.product_qty as quantity',
                                                'products.id', 
                                                'products.product_name as name', 
                                                'products.slug_url',
                                                'products.product_main_image',
                                                'products.offer_price as price',
                                                'products.status as product_status',
                                                'products.is_available',
                                                'products.current_stock',
                                                 
                                                 ) // add needed fields
                    ->join('products', 'cart_products.product_id', '=', 'products.id')
                    ->where('cart_products.cart_id', $cart_id)
                    ->where('products.status','!=', 'delete')
                    ->where('cart_products.status', 'active')
                    ->get()->toArray();
                    if(empty($cart_products)){
                        return redirect('shopping-cart')->with('error', 'Unable to checkout, your cart is empty..');
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
                }else{
                    echo 'Empty Cart';
                    exit();
                }
                
                // save tmp form data

                $tmpFormData = TmpForm::create([
                    'user_id' => $user_id,
                    'form_data' => json_encode($request->all()),
                ]);

                $tmpFormId = $tmpFormData->id;
                $fname = !empty($request->billing_address_first_name)?$request->billing_address_first_name:'';
                $lname = !empty($request->billing_address_last_name)?$request->billing_address_last_name:'';
                $session = Session::create([
                                'payment_method_types' => ['card'],
                                'customer_email' => !empty($request->billing_address_email)?$request->billing_address_email:'',
                                'line_items' => [[
                                    'price_data' => [
                                        'currency' => 'aud',
                                        'product_data' => [
                                            'name' => 'LCW Checkout',
                                        ],
                                        'unit_amount' =>  $sub_total_with_tax*100, // Amount in cents ($20)
                                    ],
                                    'quantity' => 1,
                                ]],
                                'mode' => 'payment',
                                'metadata' => [
                                    'cart_id' => $cart_id,
                                    'cart_products_count' =>  count($cart_products),
                                    'user_id' =>$user_id,
                                    'form_id' => $tmpFormId,
                                    'customer_name' => $fname.' '.$lname,
        							'customer_mobile' => !empty($request->billing_address_phone)?$request->billing_address_phone:''
                                ],
                                //'form_data' => json_encode($request->all()),
                                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',  // <--- IMPORTANT
                                'cancel_url' => route('cancel'),
                            ]);
            }else{
                echo 'You must login first';
                exit;
            }
        
        
        return redirect($session->url);
    }   
    
    public function success(Request $request)
    {
        $session_id = $request->get('session_id');

        if (!$session_id) {
            return redirect('/')->with('error', 'Payment failed , Session ID missing');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::retrieve($session_id);
        $cart_id = $session->metadata->cart_id ?? null;
        //$user_id = $session->metadata->user_id ?? null;
        $user_id = Auth::guard('master_users')->id();


        $paymentIntent = PaymentIntent::retrieve($session->payment_intent);

        $paymentDetails = [
                'transaction_id' => $paymentIntent->id,
                'currency' => $paymentIntent->currency,
                'paid_amount' => $paymentIntent->amount / 100,
                'payment_status' => $paymentIntent->status,
                'payment_gayeway_response' => json_encode($paymentIntent)
            ];

            // Place Order if online payment
           $tmpFormData = TmpForm::where('id',$session->metadata->form_id)->first();
           $form_data_obj = !empty($tmpFormData->form_data)?json_decode($tmpFormData->form_data):'';
            $form_data = (array)$form_data_obj;
            if(!empty($user_id)){

                $cart = Cart::where('user_id', $user_id)
                            ->where('status', 'active')
                            ->first();
                $product_ids = array();

                if(!empty($cart)){
                $cart_id = $cart->id;
                $cart_products = CartProduct::select(
                                                'cart_products.id as key_id',
                                                'cart_products.product_qty as quantity',
                                                'products.id', 
                                                'products.product_name as name', 
                                                'products.slug_url',
                                                'products.product_main_image',
                                                'products.offer_price as price',
                                                'products.price as product_main_price',
                                                'products.status as product_status',
                                                'products.is_available',
                                                'products.current_stock',
                                                 
                                                 ) // add needed fields
                    ->join('products', 'cart_products.product_id', '=', 'products.id')
                    ->where('cart_products.cart_id', $cart_id)
                    ->where('products.status','!=', 'delete')
                    ->where('cart_products.status', 'active')
                    ->get()->toArray();
                    if(empty($cart_products)){
                        return redirect('shopping-cart')->with('error', 'Unable to checkout, your cart is empty..');
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
                    
                    // insert order code

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
                    Orders::where('id',$insert_order->id)->update([
                        'order_id'=>$order_id,
                        'transaction_id' => $paymentDetails['transaction_id'],
                        'currency' => $paymentDetails['currency'],
                        'paid_amount' => $paymentDetails['paid_amount'],
                        'api_payment_status' => $paymentDetails['payment_status'],
                        'payment_gayeway_response' => json_encode($paymentDetails)
                    ]);

                    // Insert order products

                    $sub_total_without_tax = 0;
                    $ordered_products = array();
                    
                    foreach($cart_products as $key => $value){
                        $cart_products[$key]['qty'] = $value['quantity'];
                        array_push($product_ids,$value['id']);
                    
                        if(!empty($value['price'])){
                            $sub_total_without_tax = $value['price']*$value['quantity'];
                            $sub_total_with_tax = $sub_total_without_tax;
                            $value['sub_total_without_tax'] = $sub_total_without_tax;

                            //if(!empty($value['is_gst']) && $value['is_gst']=='yes'){
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
                            //}
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

                    // Add order products and send mail

                    if(!empty($ordered_products)){
                        $are_products_inserted = OrderProducts::insert($ordered_products);
                        //empty cart after order placed
                            Cart::where('id',$cart_id)->delete();
                            CartProduct::where('cart_id',$cart_id)->delete();
                            session()->put('cart_count', 0);

                            // Delete tmp form data

                            TmpForm::where('id',$session->metadata->form_id)->delete();

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

                            // Relative path to be stored in DB
                            $relativePath = 'public/uploads/order-pdf/' . $fileName;

                            // Public path where file will be saved
                            $publicPath = public_path('uploads/order-pdf/' . $fileName);

                            // Ensure the directory exists
                            $directory = dirname($publicPath);
                            if (!file_exists($directory)) {
                                mkdir($directory, 0777, true);
                            }

                            // Save the PDF file to public folder
                            $pdf->save($publicPath);

                            // Save relative path in DB (not full URL)
                            Orders::where('id', $insert_order->id)->update([
                                'invoice_pdf' => 'public/uploads/order-pdf/' . $fileName,
                                'invoice_no'  => 'INV' . $orderId
                            ]);


                            //Mail::to('mplussoftesting@gmail.com')->send(new MailOrderToAdmin($data));
                            
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



                }else{
                    echo 'Empty Cart';
                    exit();
                }
            }

        // // Mark cart as completed
        // if ($cart_id && $user_id) {
        //     $cart = Cart::where('id', $cart_id)
        //                 ->where('user_id', $user_id)
        //                 ->where('status', 'active')
        //                 ->first();

        //     if ($cart) {
        //         $cart->status = 'completed';
        //         $cart->payment_status = 'paid';
        //         $cart->stripe_session_id = $session_id;
        //         $cart->save();

        //         // Optionally deactivate products in cart
        //         CartProduct::where('cart_id', $cart_id)->update(['status' => 'completed']);
        //     }
        // }

        return view('success');
    }


    public function cancel()
    {
        return redirect('checkout')->with('error','Payment was cancelled.');
    }
}
