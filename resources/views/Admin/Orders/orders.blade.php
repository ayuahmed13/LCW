@section('meta_title') Orders | LCW  @endsection
@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="mt-0 header-title">{{$page_heading}} Order List</h4>
                        <div>
							<a href="{{ url('/admin/orders?order_status=payment_pending') }}" class="btn {{(!empty($order_status) && $order_status=='payment_pending')?'btn-secondary':'btn-outline-secondary'}} waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-clock"></i></span> Payment Pending</a>
                            <a href="{{ url('/admin/orders?order_status=pending') }}" class="btn {{(!empty($order_status) && $order_status=='pending')?'btn-warning':'btn-outline-warning'}} waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-clock"></i></span>Pending</a>
                            <a href="{{ url('/admin/orders?order_status=confirmed') }}" class="btn {{(!empty($order_status) && $order_status=='confirmed')?'btn-primary':'btn-outline-primary'}}  waves-effect waves-light add-btn"><span class="btn-label"> <i class="mdi mdi-check-decagram"></i></span>Confirmed</a>
                            <a href="{{ url('/admin/orders?order_status=inprocess') }}" class="btn {{(!empty($order_status) && $order_status=='inprocess')?'btn-info':'btn-outline-info'}}   waves-effect waves-light add-btn"><span class="btn-label"> <i class="mdi mdi-progress-clock"></i></span>Inprocess</a>
                            <a href="{{ url('/admin/orders?order_status=delivered') }}" class="btn {{(!empty($order_status) && $order_status=='delivered')?'btn-success':'btn-outline-success'}}  waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-check-circle"></i></span>Delievered</a>
                            <a href="{{ url('/admin/orders?order_status=cancelled') }}" class="btn {{(!empty($order_status) && $order_status=='cancelled')?'btn-danger':'btn-outline-danger'}}  waves-effect waves-light add-btn"><span class="btn-label"> <i class="mdi mdi-close-circle"></i></span>Cancelled</a>
                        </div>
                    </div>
                    <div class="card filter-card-main mb-2">
                        <div class="card-body table-responsive filter-card">
                            <div class="row align-items-end"> 
                                <div class="col-4 mb-2 no-pad-right">
                                    <label for="validationCustom01" class="form-label fw-normal">From</label>
                                    <input class="form-control" id="from_date" type="date" name="from_date" max="{{date('Y-m-d')}}" >
                                </div>
                                <div class="col-4 mb-2 no-pad-right">
                                    <label for="validationCustom01" class="form-label fw-normal">To</label>
                                    <input class="form-control" id="to_date" type="date" name="to_date" max="{{date('Y-m-d')}}">
                                </div>
                                <div class="col-4 mb-2 no-pad-right">
                                   
                                        <button type="submit" class="btn btn-primary waves-effect waves-light "
                                            id="filterButton"><i class=" fas fa-filter"></i> Filter</button>
                                   
                                    <a href=""
                                        class="btn btn-danger waves-effect waves-light mx-1 ">Clear</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body table-responsive department-card">
                            <table id="data-table" class="table table-bordered table-bordered dt-responsiv ">
                                <thead class="table-light">
                                    <tr>
                                                <th width="1%">Sr No.</th>
                                                <th width="10%">Order ID</th>
                                                <th width="10%">Date & Time</th>
                                                <th width="10%">Name</th>
                                                <th width="10%">Mobile No</th>
                                                <!-- <th width="10%">Location</th> -->
                                                <th width="10%" class="text-right">Total Cost</th>
                                                <th width="3%">Action</th>
                                    </tr>
                                        
                                </thead>
                                <tbody>
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('controller_js/cn_orders.js') }}"></script>

@endsection