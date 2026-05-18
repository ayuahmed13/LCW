@section('meta_title') Orders | LCW  @endsection
@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="mt-0 header-title">Cancelled Order List</h4>
                        <div>
							<a href="{{ url('/admin/pending-payment') }}" class="btn btn-outline-info waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-clock"></i></span> Payment Pending</a>
                            <a href="{{ url('/admin/orders') }}" class="btn btn-outline-warning waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-clock"></i></span>Pending</a>
                            <a href="{{ url('/admin/confirmed') }}" class="btn btn-outline-success waves-effect waves-light add-btn"><span class="btn-label"> <i class="mdi mdi-check-decagram"></i></span>Confirmed</a>
                            <a href="{{ url('/admin/inprocess') }}" class="btn btn-outline-info  waves-effect waves-light add-btn"><span class="btn-label"> <i class="mdi mdi-progress-clock"></i></span>Inprocess</a>
                            <a href="{{ url('/admin/delievered') }}" class="btn btn-outline-success waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-check-circle"></i></span>Delievered</a>
                            <a href="{{ url('/admin/cancelled') }}" class="btn btn-danger waves-effect waves-light add-btn"><span class="btn-label"> <i class="mdi mdi-close-circle"></i></span>Cancelled</a>
                        </div>
                    </div>

                    <div class="card filter-card-main mb-2">
                        <div class="card-body table-responsive filter-card">
                            <div class="row align-items-end">
                                      
                                <div class="col-4 mb-2 no-pad-right">
                                    <label for="validationCustom01" class="form-label fw-normal">From</label>
                                    <input class="form-control" id="from_date" type="date" name="from_date">
                                </div>
                                <div class="col-4 mb-2 no-pad-right">
                                    <label for="validationCustom01" class="form-label fw-normal">To</label>
                                    <input class="form-control" id="to_date" type="date" name="to_date">
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
                            <table id="example" class="table table-bordered table-bordered dt-responsiv ">
                                <thead class="table-light">
                                    <tr>
                                        <th width="1%">Sr No.</th>
                                        <th width="10%">Order ID</th>
                                        <th width="10%">Date & Time</th>
                                        <th width="10%">Name</th>
                                        <th width="10%">Mobile No</th>
                                        <th width="10%">Location</th>
                                        <th width="10%">Total Cost</th>
                                        <th width="3%">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>PA0191339</td>
                                        <td>18-12-2024 02:44 PM</td>
                                        <td>John Doe</td>
                                        <td>1234567890</td>
                                        <td>Pune</td>
                                        <td>$600</td>
                                        <td><a href="{{ url('/admin/cancelled-view') }}" class="btn btn-table-view"><svg class="svg-inline--fa fa-eye" aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"></path></svg><!-- <i class="fa-regular fa-eye"></i> Font Awesome fontawesome.com --></a>
                                        </td>
                                    </tr>
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
<script>
    $(".orders").addClass("menuitem-active");
    $(".orders a").addClass("active");
</script>
@endsection