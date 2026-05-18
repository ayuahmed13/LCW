@section('meta_title')
Pending Orders | LCW
@endsection
@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="mb-1 p-0 justify-content-between d-flex align-items-center">
                    <h4> {{!empty($page_heading)?$page_heading:''}} Order View</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-long-arrow-alt-left"></i></span>Back</a>
                </div>
                <div class="col-md-4 ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 th-bg">
                                <div>
                                    <p class="text-left mb-0"> Customer Details
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 bg-white py-1">

                                <div class="col-md-12">
                                    <div class="i-text"><i class="fa fa-user"></i> <span>{{!empty($data->full_name)?$data->full_name:'';}}</span></div>
                                    <div class="i-text"><i class="fa fa-envelope"></i> <span>{{!empty($data->email)?$data->email:'';}}</span>
                                    </div>
                                    <div class="i-text"><i class="fa fa-phone"></i> <span>{{!empty($data->phone_no)?$data->phone_no:'';}}</span></div>

                                </div>

                            </div>
                            <div class="col-md-12 th-bg">
                                <div>
                                    <p class="text-left mb-0"> Order Details</p>
                                </div>
                            </div>
                            <div class="col-md-12 bg-white box-body no-height">
                                <table class="usertable" style="width:100%">
                                    <tbody>
                                        <tr>
                                            <th class="pb-1" width="50%">Payment Type <span
                                                    class="float-right">:</span></th>
                                            <td class="pb-1" width="50%"
                                                style="padding-left: 10px;text-align:left !important;">
                                                {{!empty($order_data->payment_method)?$order_data->payment_method:'';}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-1">Transaction ID <span class="float-right">:</span></th>
                                            <td class="pb-1" style="padding-left: 10px;text-align:left !important;">
                                                {{!empty($order_data->transaction_id)?$order_data->transaction_id:'';}}
                                            </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-1">Payment Amount <span class="float-right">:</span></th>
                                            <td class="pb-1" style="padding-left: 10px;text-align:left !important;">
                                                ${{!empty($order_data->total_amount)?$order_data->total_amount:'';}}
                                            </td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <th class="pb-1">Shipping Address<span class="float-right">:</span></th>
                                            <td class="pb-1" style="padding-left: 10px;text-align:left !important;">
                                                {{!empty($order_data->shipping_address_first_name)?$order_data->shipping_address_first_name:'';}}
                                                {{!empty($order_data->shipping_address_last_name)?$order_data->shipping_address_last_name:'';}}
                                                <br>
                                                {{!empty($order_data->shipping_address_street)?$order_data->shipping_address_street.', ':'';}}
                                                {{!empty($order_data->shipping_address_town_city)?$order_data->shipping_address_town_city.', ':'';}}
                                                {{!empty($order_data->shipping_address_postal_code)?$order_data->shipping_address_postal_code.', ':'';}}
                                                {{!empty($order_data->shipping_address_state)?$order_data->shipping_address_state.', ':'';}}
                                                {{!empty($order_data->shipping_address_country_region)?$order_data->shipping_address_country_region:'';}}

                                                <br>
                                                {{!empty($order_data->shipping_address_phone)?$order_data->shipping_address_phone:'';}}<br>
                                                {{!empty($order_data->shipping_address_email)?$order_data->shipping_address_email:'';}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-1">Note<span class="float-right">:</span></th>
                                            <td class="pb-1" style="padding-left: 10px;text-align:left !important;">
                                                {{!empty($order_data->shipping_address_note)?$order_data->shipping_address_note:'';}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-1">Billing Address<span class="float-right">:</span></th>
                                            <td class="pb-1" style="padding-left: 10px;text-align:left !important;">
                                                {{!empty($order_data->billing_address_first_name)?$order_data->billing_address_first_name:'';}}
                                                {{!empty($order_data->billing_address_last_name)?$order_data->billing_address_last_name:'';}}
                                                <br>
                                                {{!empty($order_data->billing_address_street)?$order_data->billing_address_street.', ':'';}}
                                                {{!empty($order_data->billing_address_town_city)?$order_data->billing_address_town_city.', ':'';}}
                                                {{!empty($order_data->billing_address_postal_code)?$order_data->billing_address_postal_code.', ':'';}}
                                                {{!empty($order_data->billing_address_state)?$order_data->billing_address_state.', ':'';}}
                                                {{!empty($order_data->billing_address_country_region)?$order_data->billing_address_country_region:'';}}

                                                <br>
                                                {{!empty($order_data->billing_address_phone)?$order_data->billing_address_phone:'';}}<br>
                                                {{!empty($order_data->billing_address_email)?$order_data->billing_address_email:'';}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-1">Note<span class="float-right">:</span></th>
                                            <td class="pb-1" style="padding-left: 10px;text-align:left !important;">
                                                {{!empty($order_data->billing_address_note)?$order_data->billing_address_note:'';}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 ps-3">
                    <div class="col-md-12 mb-10">
                        <div class="row">

                            <div class="col-md-12 th-bg">
                                <div class="view-hd">
                                    <p class="text-left mb-0"> Order Details <small><b>( Order Id:
                                                {{!empty($order_data->order_id)?$order_data->order_id:'';}}

                                                )</b></small>
                                        <span class="float-right">Order Date:
                                            {{!empty($order_data->created_at)?date('d M Y h:i A',strtotime($order_data->created_at)):'';}}

                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-12 bg-white box-body" style="min-height: 310px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="basic-strip c-strip pending-bg">Status -
                                        {{!empty($order_data->order_status)?ucwords(str_replace('_',' ',$order_data->order_status)):'';}}

                                    </div>
                                    @if(!empty($order_data->invoice_pdf))
                                    <div class="print-btn">
                                        <a href="{{ str_replace('','',url('/') . Storage::url($order_data->invoice_pdf)) }}" class="btn btn-success btn-print">
                                            <i class="fa fa-download"></i>
                                            Print</a>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="8%">Sr No.</th>
                                                <th width="12%">Category</th>
                                                <th width="20%">Product Name</th>
                                                <th width="15%">Price ($)</th>
                                                <th width="15%">Offer Price</th>
                                                <th width="10%">Quantity</th>
                                                <th width="20%" style="text-align: left !important;">Total Price</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($ordered_products))
                                            @foreach($ordered_products as $key => $value)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{!empty($value->category_name)?''.$value->category_name:'NA'}}</td>

                                                <td> {{!empty($value->product_name)?''.$value->product_name:''}}
                                                </td>
                                                <td>${{!empty($value->product_price)?number_format($value->product_price,2):''}}</td>
                                                <td>${{!empty($value->product_offer_price)?number_format($value->product_offer_price,2):''}}</td>
                                                <td>{{!empty($value->product_qty)?''.$value->product_qty:''}}</td>
                                                <td style="text-align: left !important;">${{!empty($value->product_total_amount)?number_format($value->product_total_amount,2):''}}</td>
                                            </tr>
                                            @endforeach
                                            @endif


                                            <input type="hidden" id="item_im_ides">
                                            <label for="item_im_ides" id="item_im_ides-error" class="error"></label>
                                            <tr>
                                                <td colspan="6" style="text-align: right !important;"><b>Sub Total
                                                    </b></td>
                                                <td style="text-align: left !important;"><b>$
                                                        {{!empty($order_data->sub_total)? number_format($order_data->sub_total,2):'';}}

                                                    </b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: right !important;"><b>Shipping Charges </b></td>
                                                <td style="text-align: left !important;"><b>$
                                                        {{!empty($order_data->shipping_charges)?number_format($order_data->shipping_charges,2):'0.00';}}

                                                    </b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: right !important;"><b>GST
                                                        ({{!empty($order_data->tax_per)? number_format($order_data->tax_per,2):'';}}%)</b></td>
                                                <td style="text-align: left !important;"><b>$
                                                        {{!empty($order_data->tax_amount)? number_format($order_data->tax_amount,2):'';}}

                                                    </b></td>
                                            </tr>

                                            <tr>
                                                <td colspan="6" style="text-align: right !important;"><b>Total
                                                        Amount</b></td>
                                                <td style="text-align: left !important;"><b>$
                                                        {{!empty($order_data->total_amount)? number_format($order_data->total_amount,2):'';}}

                                                    </b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if($order_data->order_status=='payment_pending')
                            @endif
                            @if($order_data->order_status=='pending')
                            @endif
                            @if($order_data->order_status=='confirmed' || $order_data->order_status=='inprocess' || $order_data->order_status=='packed' || $order_data->order_status=='shipped' || $order_data->order_status=='delivered')
                            <!-- Confirmed -->
                            <div class="col-md-12 th-bg mt-3">
                                <div>
                                    <p class="text-left mb-0"> Order Status</p>
                                </div>
                            </div>
                            <div class="col-md-12 bg-white py-1">
                                <div class="row">
                                    <div class="mb-2 col-md-12">
                                        <label class="mb-0 d-block">Order Confirmed</label>
                                        <p class="mb-0  form-label">
                                            {{!empty($order_data->order_confirmed_on)? date('Y-m-d H:i',strtotime($order_data->order_confirmed_on)):'-';}}

                                        </p>
                                    </div>
                                    <div class="mb-2 col-md-12">
                                        <label class="mb-0 d-block">Order Packed</label>
                                        <p class="mb-0 form-label">
                                            {{!empty($order_data->order_packed_on)? date('Y-m-d H:i',strtotime($order_data->order_packed_on)):'-';}}

                                        </p>
                                    </div>
                                    <div class="mb-2 col-md-12">
                                        <label class="mb-0 d-block">Order Shipped</label>
                                        <p class="mb-0  form-label">
                                            {{!empty($order_data->order_shipped_on)? date('Y-m-d H:i',strtotime($order_data->order_shipped_on)):'-';}}

                                        </p>
                                    </div>
                                    <div class="mb-2 col-md-12">
                                        <label class="mb-0 d-block">Order Delivered</label>
                                        <p class="mb-0  form-label">
                                            {{!empty($order_data->order_delivered_on)? date('Y-m-d H:i',strtotime($order_data->order_delivered_on)):'-';}}

                                        </p>
                                    </div>
                                    <div class="mb-2 col-md-4">
                                        <label class="mb-0 d-block">Courier Name</label>
                                        <p class="mb-0  form-label">
                                            {{!empty($order_data->courier_name)? ($order_data->courier_name):'-'}}

                                        </p>
                                    </div>
                                    <div class="mb-2 col-md-4">
                                        <label class="mb-0 d-block">Tracking ID</label>
                                        <p class="mb-0 form-label">
                                            {{!empty($order_data->tracking_no)? ($order_data->tracking_no):'-';}}
                                                
                                        </p>
                                    </div>
                                    <div class="mb-2 col-md-12">
                                        <label class="mb-0 d-block">Tracking URL</label>
                                        <p class="mb-0  form-label">
                                                @if(!empty($order_data->tracking_url))  
                                                <a href="{{$order_data->tracking_url}}" target="_blank">
                                                    {{$order_data->tracking_url}} 
                                                    <i class="fa fa-external-link-square h5 text-warning"></i>
                                                </a>
                                                @else
                                                -
                                                @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            

                        </div>
                    </div>

                </div>
                @if($order_data->order_status=='pending')
                <div class="card mt-3">
                    <form name="pending_form" id="os_formA" action="{{url('admin/orders/change-order-status')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{!empty($order_data->id)? Crypt::encrypt($order_data->id):'';}}">
                        <div class="col-md-4  my-2">
                            <label>Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="statusSelect" name="order_status" onchange="toggleRemark()">
                                <option value="">Select</option>
                                <!-- pending -->
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-2" id="remarkSection" style="display: none; margin-top: 10px;">
                            <label>Remark <span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Enter your remark..." rows="5" name="pending_form_remark"></textarea>
                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="submit" name="submit_btn" id="btn-submit"
                                class="btn btn-success form_btn submit leftpri city_add" data-id="submit">Submit</button>
                            <button type="reset" class="btn btn-danger form_btn"> Cancel</button>
                        </div>
                    </form>
                </div>
                @endif

                @if($order_data->order_status=='confirmed')
                <div class="card mt-3">
                <form name="confirmed_form" id="os_formB" action="{{url('admin/orders/change-order-status')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{!empty($order_data->id)? Crypt::encrypt($order_data->id):'';}}">

                    
                        <div class="col-md-4 my-2">
                            <label>Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="statusSelect" name="order_status" onchange="toggleRemark()">
                                <option value="">Select</option>
                                <option value="inprocess">Inprocess</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-2" id="remarkSection" name="confirmed_remark" style="display: none; margin-top: 10px;">
                            <label>Remark <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="confirmed_form_remark" placeholder="Enter your remark..." rows="5"></textarea>
                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="submit" name="submit_btn" id="submit_btn"
                                class="btn btn-success form_btn submit leftpri city_add" data-id="submit">Submit</button>
                            <button type="reset" class="btn btn-danger form_btn"> Cancel</button>
                        </div>
                    
                </form>
                </div>
                @endif

                @if($order_data->order_status=='inprocess' || $order_data->order_status=='packed' || $order_data->order_status=='shipped')
                <div class="card mt-3">
                <form name="inprocess_form" id="os_formC" action="{{url('admin/orders/change-order-status')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{!empty($order_data->id)? Crypt::encrypt($order_data->id):'';}}">

                    
                        <div class="col-md-4  my-2">
                            <label>Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="statusSelect" name="order_status" onchange="toggleRemark1()">
                                <option value="">Select</option>
                                <option value="shipped" {{$order_data->order_status=='shipped'?'disabled':''}}> Shipped</option>
                                <option value="packed" {{$order_data->order_status=='packed'?'disabled':''}}> Packed</option>
                                <option value="delivered" {{$order_data->order_status=='delivered'?'disabled':''}}> Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2" id="shippedSection" style="display: none; margin-top: 10px;">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Courier Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="courier_name">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Tracking ID <span class="text-danger">*</span></label>
                                    <input class="form-control" name="tracking_no">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <label>Tracking URL <span class="text-danger">*</span></label>
                                    <input class="form-control" name="tracking_url">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 mb-2" id="remarkSection" style="display: none; margin-top: 10px;">
                            <label>Remark <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="inprocess_form_remark" placeholder="Enter your remark..." rows="5"></textarea>
                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="submit" name="submit_btn" id="submit_btn"
                                class="btn btn-success form_btn submit leftpri city_add" data-id="submit">Submit</button>
                            <button type="reset" class="btn btn-danger form_btn"> Cancel</button>
                        </div>
                    
                </form>
                </div>
                @endif

                @if($order_data->order_status=='payment_pending')
                <div class="card mt-3">
                <form name="payment_pending_form" id="os_formD" action="{{url('admin/orders/change-order-status')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{!empty($order_data->id)? Crypt::encrypt($order_data->id):'';}}">

                    
                        <div class="col-md-4  my-2">
                            <label>Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="statusSelect" name="order_status">
                                <option value="">Select</option>
                                <option value="verified">Verified</option>
                                <option value="not_verified">Not Verified</option>
                            </select>


                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="submit" name="submit_btn" id="submit_btn"
                                class="btn btn-success form_btn submit leftpri city_add" data-id="submit">Submit</button>
                            <button type="reset" class="btn btn-danger form_btn"> Cancel</button>
                        </div>
                    
                </form>
                </div>
                @endif
            </div>
        </div>


    </div>
</div>
@endsection

@section('script')
<script>
    $(".orders").addClass("menuitem-active");
    $(".orders a").addClass("active");
</script>
<script>
    function toggleRemark() {
        const status = document.getElementById("statusSelect").value;
        const remarkSection = document.getElementById("remarkSection");

        if (status === "cancelled") {
            remarkSection.style.display = "block";
        } else {
            0
            remarkSection.style.display = "none";
        }
    }
</script>

<script>
    function toggleRemark1() {
        const status = document.getElementById("statusSelect").value;
        const remarkSection = document.getElementById("remarkSection");
        const shippedSection = document.getElementById("shippedSection");

        if (status === "cancelled") {
            remarkSection.style.display = "block";
        } else {
            0
            remarkSection.style.display = "none";
        }

        if (status === "shipped") {
            shippedSection.style.display = "block";
        } else {
            0
            shippedSection.style.display = "none";
        }
    }
</script>

<script>
    $(document).ready(function() {

        // === Pending Order Validation ===
        $('#os_formA').validate({
            rules: {
                order_status: {
                    required: true
                },
                pending_form_remark: {
                    required: function() {
                        return $('#os_formA select[name="order_status"]').val() === 'cancelled';
                    }
                }
            },
            errorClass: 'text-danger',
            errorElement: 'div'
        });

        // === Confirmed Order Validation ===
        $('#os_formB').validate({
            rules: {
                order_status: {
                    required: true
                },
                confirmed_form_remark: {
                    required: function() {
                        return $('#os_formB select[name="order_status"]').val() === 'cancelled';
                    }
                }
            },
            errorClass: 'text-danger',
            errorElement: 'div'
        });

        // === Inprocess Order Validation ===
        $('#os_formC').validate({
            rules: {
                order_status: {
                    required: true
                },
                courier_name: {
                    required: function() {
                        return $('#os_formC select[name="order_status"]').val() === 'shipped';
                    }
                },
                tracking_no: {
                    required: function() {
                        return $('#os_formC select[name="order_status"]').val() === 'shipped';
                    }
                },
                tracking_url: {
                    required: function() {
                        return $('#os_formC select[name="order_status"]').val() === 'shipped';
                    },
                    url: true
                },
                inprocess_form_remark: {
                    required: function() {
                        return $('#os_formC select[name="order_status"]').val() === 'cancelled';
                    }
                }
            },
            errorClass: 'text-danger',
            errorElement: 'div'
        });

        // === Payment Pending Order Validation ===
        $('#os_formD').validate({
            rules: {
                order_status: {
                    required: true
                }
            },
            errorClass: 'text-danger',
            errorElement: 'div'
        });

        // === Dynamic UI Control ===

        // Pending & Confirmed
        window.toggleRemark = function() {
            const form = $(event.target).closest('form');
            const selected = $(event.target).val();
            form.find('#remarkSection').toggle(selected === 'cancelled');
        }

        // Inprocess
        window.toggleRemark1 = function() {
            const form = $(event.target).closest('form');
            const selected = $(event.target).val();
            form.find('#remarkSection').toggle(selected === 'cancelled');
            form.find('#shippedSection').toggle(selected === 'shipped');
        }

    });
</script>

@endsection