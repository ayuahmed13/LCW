@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">{{ !empty($edit_data) ? 'Edit' : 'Add' }} GST</h4>
                    </div>
                </div>


                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">

                            <form id="gstForm" name="gstForm" action="{{url('admin/gst-master/store')}}" method="post"  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{!empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : ''}}">

                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">GST % (In Percentage)</label>
                                        <input type="text" class="form-control" name="gst_value" id="gst_value" placeholder="Enter GST in Percentage" value="{{!empty($edit_data->gst_value) ? $edit_data->gst_value : ''}}" onkeypress="return /[0-9]/i.test(event.key)">

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
                                        <th>GST (%)</th>
                                        <th width="10%">Status</th>
                                        <th width="13%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="12" data-table="benefits_cards" data-flash="Status Changed Successfully!" class="change-status fs-3"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>
                                        </td>
                                        <td>
                                            <a href="javascript:void;"> <button type="button" data-id="1" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>
                                            <a href="javascript:void;" data-id="12" data-table="benefits_cards" data-flash="Data Deleted Successfully!" class="btn btn-danger btn-xs delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                        </td>
                                    </tr>
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
        $(".gst").addClass("menuitem-active");
        $(".gst a").addClass("active");
</script>
<script src="{{ asset('controller_js/cn_gst_master.js') }}"></script>
@endsection