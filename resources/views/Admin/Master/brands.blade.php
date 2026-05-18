@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">{{ !empty($edit_data) ? 'Edit' : 'Add' }} Brand</h4>
                    </div>
                </div>


                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">

                            <form id="brandForm" name="brandForm" action="{{url('admin/brands-master/store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{!empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : ''}}">

                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">Brand Name</label>
                                        <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Brands Name" value="{{!empty($edit_data->brand_name) ? $edit_data->brand_name : ''}}">
                                    </div>
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">Brand Image</label>
                                        <p class="text-gray mb-1">Note: Image Size-W(216px)*H(287px)</p>
                                        <input type="file" data-plugins="dropify" name="brand_image" size="40" accept="image/*" 
                                            data-default-file="{{ !empty($edit_data->brand_image) && Storage::exists($edit_data->brand_image) ? url('/').Storage::url($edit_data->brand_image) : '' }}"
                                            alt="{{ !empty($edit_data->brand_image) ? $edit_data->brand_image : '' }}" />
                                        <input type="hidden" id="old_image" value="{{ !empty($edit_data->brand_image) && Storage::exists($edit_data->brand_image) ? url('/').Storage::url($edit_data->brand_image) : '' }}" >
                                    </div>
                                    <label id="brand_image-error" class="text-danger" for="brand_image"></label>
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
                                        <th>Brand Name</th>
                                        <th width="20%">Brand Image</th>
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
        $(".brands").addClass("menuitem-active");
        $(".brands a").addClass("active");
    </script>
    <script src="{{ asset('controller_js/cn_brands_master.js') }}"></script>
    @endsection