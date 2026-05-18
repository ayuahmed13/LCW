@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">{{ !empty($edit_data) ? 'Edit' : 'Add' }} Sub Sub Category</h4>
                    </div>
                </div>


                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">

                            <form id="subsubcategoryForm" name="subcategoryForm" action="{{url('admin/sub-sub-category-master/store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{!empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : ''}}">

                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">Category</label>
                                        <select name="category_id" id="category_id" class="form-select" aria-label="Default select example">
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
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">Sub Category</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-select" aria-label="Default select example">
                                            <option value="">Select Sub Category</option>
                                            @if(!empty($sub_category_list))
                                            @foreach($sub_category_list as $key => $value)

                                            @php 
                                            $selected = '';
                                            if(!empty($edit_data->sub_category_id) && $edit_data->sub_category_id == $value->id){
                                                $selected = 'selected';
                                            }
                                            @endphp

                                            <option {{ $selected }} value="{{$value->id}}">{{$value->sub_category_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">Sub Sub Category Name</label>
                                        <input type="text" class="form-control" name="sub_sub_category_name" id="sub_sub_category_name" placeholder="Enter Sub Sub Category Name" value="{{ !empty($edit_data->sub_sub_category_name) ? $edit_data->sub_sub_category_name : ''}}">

                                    </div>
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">Sub Category Image</label>
                                        <p class="text-gray mb-1">Note: Image Size-W(216px)*H(287px)</p>
                                        <input type="file" data-plugins="dropify" name="sub_sub_category_image" size="40" accept="image/*"
                                            data-default-file="{{ !empty($edit_data->sub_sub_category_image) && Storage::exists($edit_data->sub_sub_category_image) ? url('/').Storage::url($edit_data->sub_sub_category_image) : '' }}"
                                            alt="{{ !empty($edit_data->sub_sub_category_image) ? $edit_data->sub_sub_category_image : '' }}" />
                                            <input type="hidden" id="old_image" value="{{ !empty($edit_data->sub_sub_category_image) && Storage::exists($edit_data->sub_sub_category_image) ? url('/').Storage::url($edit_data->sub_category_image) : '' }}" >
                                            
                                        </div>
                                    <label id="sub_sub_category_image-error" class="text-danger" for="sub_sub_category_image"></label>

                                </div>



                                <button type="submit" name="contact_settings" id="btn-submit" class="btn btn-success"> {{ !empty($edit_data) ? 'Update' : 'Submit' }} </button>
                                @if(empty($edit_data)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <!-- <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="mt-0 header-title">System User</h4>
                        <a href="{{ url('admin/system-user/add') }}" class="btn btn-success waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-plus "></i></span>Add</a>
                    </div> -->
                    <div class="card">
                        <div class="card-body table-responsive department-card">
                            <table id="data-table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                                <thead class="table-light">
                                    <tr role="row">
                                        <th width="10%">Sr No</th>
                                        <th>Category </th>
                                        <th>Sub Category </th>
                                        <th>Sub Sub Category Name</th>
                                        <th>Sub Sub Category Image</th>
                                        <th width="10%">Status</th>
                                        <th width="13%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div> <!-- container-fluid -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
     $(".master").addClass("menuitem-active");
        $("#master").addClass("show");
        $(".sub-sub-category").addClass("menuitem-active");
        $(".sub-sub-category a").addClass("active");
</script>
<script src="{{ asset('controller_js/cn_sub_sub_category_master.js') }}"></script>
@endsection