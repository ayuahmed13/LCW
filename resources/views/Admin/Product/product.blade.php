@section('meta_title') Product | LCW Website @endsection
@extends('Admin.Layouts.layout')
@section('content')
<style>
    .btn-group-sm > .btn, .btn-sm {
    align-content: center;
}
</style>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="mt-0 header-title">Product</h4>
                        <a href="{{ url('admin/add-product') }}" class="btn btn-success waves-effect waves-light add-btn" ><span class="btn-label"> <i class="fas fa-plus "></i></span>Add</a>
                    </div>
                    <div class="card filter-card-main mb-2">
                        <div class="card-body table-responsive filter-card">
                            <div class="row align-items-end">

                                <div class="col-md-3 ">
                                    <label class="mb-1">Category </label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value="">Select</option>
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
                                        <option value="2">Track Spotlights</option>
                                        <option value="2">Track Accessories</option>
                                        <option value="3">Track Linear Spotlights </option>
                                    </select>
                                </div>
                                <div class="col-md-3 ">
                                    <label class="mb-1">Sub Sub Category </label>
                                    <select class="form-select" id="sub_sub_category_id" name="sub_sub_category_id">
                                        <option value="">Select</option>
                                        <option value="2">LED Track Linear Spotlight CCT 10W</option>
                                        <option value="3">LED Track Linear Spotlight CCT 20W </option>
                                    </select>
                                </div>
                                <div class="col-3 ">

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
                                        <th >Category Name</th>
                                        <th >Product ID</th>
                                        <th >Product Name</th>
                                        <th >Price ($)</th>
                                        <th >Brand</th>
                                        <th >SKU</th>
                                        <th >Status</th>
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
<script src="{{ asset('controller_js/cn_product.js') }}"></script>
@endsection