@section('meta_title')
    Stock Management | LCW Website
@endsection
@extends('Admin.Layouts.layout')
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="mt-0 header-title">Stock Management</h4>
                        </div>

                        <div class="card filter-card-main mb-2">
                            <div class="card-body table-responsive filter-card">
                                <div class="row align-items-end">

                                    <div class="col-md-3 ">
                                        <label class="mb-1">Category </label>
                                        <select class="form-select" id="category_id" name="category_id">
                                        <option value="">Select Category</option>
                                                    @if(!empty($category_list))
                                                    @foreach($category_list as $key => $value)

                                                    @php 
                                                    $selected = '';
                                                    if(!empty($edit_data->category_id) && $edit_data->category_id == $value->id){
                                                        $selected = 'selected';
                                                    }
                                                    @endphp

                                                    <option {{ $selected }} value="{{$value->id}}">{{$value->category_name}}</option>
                                                    @endforeach
                                                    @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label class="mb-1">Sub Category </label>
                                        <select class="form-select" id="sub_category_id" name="sub_category_id">
                                            <option value="">Select</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label class="mb-1">Sub Sub Category </label>
                                        <select class="form-select" id="sub_sub_category_id" name="sub_sub_category_id">
                                            <option value="">Select</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-3 ">

                                        <button type="submit" class="btn btn-primary waves-effect waves-light "
                                            id="filterButton"><i class=" fas fa-filter"></i> Filter</button>

                                        <a href="{{url('admin/stock')}}" class="btn btn-danger waves-effect waves-light mx-1 ">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card department-card">
                            <div class="card-body table-responsive ">
                                <table id="data-table" class="table table-bordered table-bordered dt-responsiv ">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 2%;">Sr No.</th>
                                            <th style="width: 10%;">Product ID</th>
                                            <th style="width: 10%;">Category</th>
                                            <th style="width: 10%;">Sub Category</th>
                                            <th style="width: 10%;">Sub Sub Category</th>
                                            <th style="width: 10%;">Product Name</th>
                                            <th style="width: 10%;">Price ($)</th>
                                            <th style="width: 10%;">Offer Price ($)</th>
                                            <th style="width: 10%;">Current Stock</th>
                                            <th style="width: 5%;">Remark</th>
                                            <th style="width: 5%;">Status</th>
                                            <th style="width: 5%;">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PA0191339</td>
                                            <td>LED Track lights</td>
                                            <td>Track Spotlight</td>
                                            <td>LED Track Spotlight CCT 6W</td>
                                            <td>LED Track Spotlight CCT 6W</td>
                                            <td>128</td>
                                            <td>100</td>
                                            <td>25</td>
                                            <td>NA</td>
                                            <td>Available</td>
                                            <td><a> <button type="button" data-id="9" class="btn btn-warning btn-xs"
                                                        title="Edit" data-bs-toggle="modal" data-bs-target="#editPopup"><i
                                                            class="mdi mdi-pencil"></i></button></a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PA0191339</td>
                                            <td>LED Track lights</td>
                                            <td>Track Linear Spotlight</td>
                                            <td>LED Track Linear Spotlight CCT 10W</td>
                                            <td>LED Track Linear Spotlight CCT 10W</td>
                                            <td>128</td>
                                            <td>100</td>
                                            <td>25</td>
                                            <td>NA</td>
                                            <td>Not Available</td>
                                            <td><a> <button type="button" data-id="9" class="btn btn-warning btn-xs"
                                                        title="Edit" data-bs-toggle="modal" data-bs-target="#editPopup"><i
                                                            class="mdi mdi-pencil"></i></button></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Edit Popup Modal -->
                        <div class="modal fade" id="editPopup" tabindex="-1" aria-labelledby="editPopupLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPopupLabel">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="stocktForm" name="stocktForm" action="{{url('admin/stock/store')}}" method="post">
                                        @csrf
                                    <div class="modal-body">
                                        
                                        <div class="d-flex">
                                            <img class="me-2" id="product_image"
                                                src="{{URL::asset('front/images/default-img.jpg') }}"
                                                style="width: 100px; height:70px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 2px;">
                                            <div class="d-flex justify-content-between w-100">
                                                <div>
                                                    <input type="hidden" name="id" id="id" >
                                                    <p class="mb-0 fw-bold" id="product_name">LED Track Spotlight CCT 6W</p>
                                                    <p class="mb-0 fw-medium" id="category_name">LED Track lights</p>
                                                    <p class="mb-0 fw-medium" id="sub_category_name">Track Spotlight</p>
                                                </div>
                                                <div>
                                                    <p class="mb-0 fw-bold" id="product_id">PA65652652</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="mb-1 mt-2">
                                        <div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <label class="required-field">Status</label>
                                                    <select class="form-select" id="is_available" name="is_available">
                                                        <option value="">Select</option>
                                                        <option value="available">Available</option>
                                                        <option value="not_available">Not Available</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <label class="required-field">Stock</label>
                                                    <input type="text" class="form-control" id="current_stock" name="current_stock">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-1">
                                                    <label class="required-field">Remark</label>
                                                    <textarea class="form-control" id="stock_remark" name="stock_remark" placeholder="Enter your remark..." rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="submit_btn" id="btn-submit"
                                            class="btn btn-success form_btn submit leftpri city_add"
                                            data-id="submit">Submit</button>
                                        <button type="reset" class="btn btn-danger form_btn"> Cancel</button>
                                    </div>
                                    </form>
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
    <script src="{{ asset('controller_js/cn_stock.js') }}"></script>
@endsection
