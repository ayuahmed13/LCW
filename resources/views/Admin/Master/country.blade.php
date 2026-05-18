@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">{{ !empty($edit_data) ? 'Edit' : 'Add' }} Country</h4>
                    </div>
                </div>


                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">

                            <form id="countryForm" name="countryForm" action="{{url('admin/country-master/store')}}" method="post"  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{!empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : ''}}">

                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">Country</label>
                                        <input type="text" class="form-control" name="country_name" id="country_name" placeholder="Enter Country Name" value="{{!empty($edit_data->country_name) ? $edit_data->country_name : ''}}" onkeypress="return /[A-Z a-z]/i.test(event.key)">

                                    </div>
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">Country Code</label>
                                        <input type="text" class="form-control" name="country_code" id="country_code" placeholder="Enter Country Code" value="{{!empty($edit_data->country_code) ? $edit_data->country_code : ''}}" onkeypress="return /[+ 0-9]/i.test(event.key)">

                                    </div>
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
                                        <th>Country</th>
                                        <th width="10%">Country Code</th>
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
<script src="{{ asset('controller_js/cn_country_master.js') }}"></script>
<script>
    $(".master").addClass("menuitem-active");
        $("#master").addClass("show");
        $(".country").addClass("menuitem-active");
        $(".country a").addClass("active");
</script>

@endsection