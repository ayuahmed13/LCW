@section('meta_title') Blogs | LCW @endsection
@extends('Admin.Layouts.layout')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <input type="hidden" id="base_url" value="{{ url('/') }}">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="mt-0 header-title">Customers List</h4>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive department-card">
                            <table id="data-table" class="table table-bordered dt-responsive w-100">
                                <thead class="table-light">
                                    <tr role="row">
                                        <th>Sr No</th>
                                        <th>Registration Date</th>
                                        <th>Customer ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Country</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody> <!-- Data will load via DataTables -->
                            </table>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="editPopup" tabindex="-1" aria-labelledby="editPopupLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPopupLabel">Customer Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="fw-bold">Registration Date : <span id="modalRegDate">12-05-2025</span></p>
                                        <p class="fw-bold">Customer ID: <span id="modalCustomerId">452136</span></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <img id="modalImage" src="{{ URL::asset('front/images/products/new-images/Male.png') }}"
                                                style="width: 100%; height: 100px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 2px;">
                                        </div>
                                        <div class="col-9">
                                            <table class="usertable" style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <th class="pb-1" width="20%">Name <span class="float-right">:</span></th>
                                                        <td class="pb-1" id="modalName" width="80%" style="padding-left: 10px;text-align:left !important;"></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pb-1">Mobile <span class="float-right">:</span></th>
                                                        <td class="pb-1" id="modalMobile" style="padding-left: 10px;text-align:left !important;"></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pb-1">Email <span class="float-right">:</span></th>
                                                        <td class="pb-1" id="modalEmail" style="padding-left: 10px;text-align:left !important;"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="card-body p-2" style="width: 160px;">
                                                <h5 class="card-title mb-1">Total Orders</h5>
                                                <p class="card-text m-0 fw-bold fs-5" id="totalOrders">0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /Modal -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('controller_js/cn_customer.js') }}"></script>
<script>
   
</script>
@endsection
