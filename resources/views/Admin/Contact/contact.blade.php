@section('meta_title') Contact | LCW @endsection
@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="mt-0 header-title">Contact Enquiry</h4>
                    </div>
                    <div class="card filter-card-main mb-2">
                        <div class="card-body table-responsive filter-card">
                            <div class="row align-items-end">
                                      
                                <div class="col-4 mb-2 no-pad-right">
                                    <label for="validationCustom01" class="form-label fw-normal">From</label>
                                    <input class="form-control" id="from_date" type="date" name="from_date" max="{{date('Y-m-d')}}">
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
                            <table id="data-table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                                <thead class="table-light">
                                    <tr role="row">
                                        <th >Sr No</th>
                                        <th>Date & Time</th>
                                        <th > Name</th>
                                        <th>Email</th>
                                        <th >Mobile No</th>
                                        <th >Subject</th>
                                        <th >Message</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div> 
</div>
@endsection

@section('script')
<script src="{{ asset('controller_js/cn_contactus.js') }}"></script>

@endsection