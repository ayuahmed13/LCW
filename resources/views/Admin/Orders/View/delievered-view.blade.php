@section('meta_title')
    Delieverd Orders | LCW
@endsection
@extends('Admin.Layouts.layout')
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid mb-3">
                <div class="row">
                    <div class="mb-1 p-0 justify-content-between d-flex align-items-center">
                        <h4 > Delieverd Order List</h4>
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
                                        <div class="i-text"><i class="fa fa-user"></i> <span>Dayanand Wagh</span></div>
                                        <div class="i-text"><i class="fa fa-envelope"></i> <span>Daya.w@mplussoft.in</span>
                                        </div>
                                        <div class="i-text"><i class="fa fa-phone"></i> <span>8421456373</span></div>

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
                                                    Direct Bank </td>
                                            </tr>
                                            <tr>
                                                <th class="pb-1">Transaction ID <span class="float-right">:</span></th>
                                                <td class="pb-1" style="padding-left: 10px;text-align:left !important;">
                                                    654565151</td>
                                            </tr>
                                            <tr>
                                                <th class="pb-1">Payment Amount <span class="float-right">:</span></th>
                                                <td class="pb-1" style="padding-left: 10px;text-align:left !important;">
                                                    $158</td>
                                            </tr>
                                            </tr>
                                            <tr>
                                                <th class="pb-1">Shipping Address<span class="float-right">:</span></th>
                                                <td class="pb-1" style="padding-left: 10px;text-align:left !important;"> 
                                                    john Doe <br>
                                                    b - a, c, d, Vimannagar, Pune, Maharashtra - 411014 <br>
                                                    8605127520
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="pb-1">Billing Address<span class="float-right">:</span></th>
                                                <td class="pb-1" style="padding-left: 10px;text-align:left !important;"> 
                                                    john Doe <br>
                                                    b - a, c, d, Vimannagar, Pune, Maharashtra - 411014 <br>
                                                    8605127520
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="pb-1">Note<span class="float-right">:</span></th>
                                                <td class="pb-1" style="padding-left: 10px;text-align:left !important;"> Lorem ipsum </td>
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
                                        <p class="text-left mb-0"> Order Details <small><b>( Order Id: PA0191338
                                                    )</b></small>
                                            <span class="float-right">Order Date: 18 Dec 2024 01:53 PM</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12 bg-white box-body" style="min-height: 310px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="basic-strip c-strip delievered-bg">Status -
                                            Delievered
                                        </div>
                                        <div class="print-btn">
                                            <a href="#" class="btn btn-success btn-print">
                                                <i class="fa fa-download"></i>
                                                Print</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table id="example" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="10%">Sr No.</th>
                                                    <th width="10%">Category</th>
                                                    <th width="20%">Product Name</th>
                                                    <th width="15%">Price ($)</th>
                                                    <th width="15%">Offer Price</th>
                                                    <th width="15%">Quantity</th>
                                                    <th width="20%" style="text-align: left !important;">Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>LED</td>

                                                    <td> LED Spotlight
                                                    </td>
                                                    <td>$120</td>
                                                    <td>$100</td>
                                                    <td>1</td>
                                                    <td style="text-align: left !important;">$100</td>
                                                </tr>

                                                <input type="hidden" id="item_im_ides">
                                                <label for="item_im_ides" id="item_im_ides-error" class="error"></label>
                                                <tr>
                                                    <td colspan="6" style="text-align: right !important;"><b>Sub Total
                                                            </b></td>
                                                    <td style="text-align: left !important;"><b>$100</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align: right !important;"><b>Delivery
                                                            Charges </b></td>
                                                    <td style="text-align: left !important;"><b>$40</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align: right !important;"><b>GST
                                                            (18%)</b></td>
                                                    <td style="text-align: left !important;"><b>$18 </b></td>
                                                </tr>
            
                                                <tr>
                                                    <td colspan="6" style="text-align: right !important;"><b>Total
                                                            Amount</b></td>
                                                    <td style="text-align: left !important;"><b>$158</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12 th-bg mt-3" >
                                    <div>
                                        <p class="text-left mb-0"> Order Status</p>
                                    </div>
                                </div>
                                <div class="col-md-12 bg-white py-1">
                                    <div class="row">
                                        <div class="mb-2 col-md-12">
                                            <label class="mb-0 d-block">Order Delievered</label>
                                            <p class="mb-0  form-label">2025-05-10 , 14:30</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
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
@endsection
