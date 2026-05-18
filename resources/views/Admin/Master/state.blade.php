@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">{{ !empty($edit_data) ? 'Edit' : 'Add' }} State</h4>
                    </div>
                </div>


                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">

                            <form id="stateForm" name="stateForm" action="{{url('admin/state-master/store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{!empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : ''}}">

                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">Country</label>
                                        <select name="country_id" id="country_id" class="form-select" aria-label="Default select example">
                                            <option value="">Select Country</option>
                                            @if(!empty($country_list))
                                            @foreach($country_list as $key => $value)

                                            @php 
                                            $selected = '';
                                            if(!empty($edit_data->country_id) && $edit_data->country_id == $value->id){
                                                $selected = 'selected';
                                            }
                                            @endphp

                                            <option {{ $selected }} value="{{$value->id}}">{{$value->country_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-2 col-12">
                                        <label for="" class="form-label required-field">State</label>
                                        <input type="text" class="form-control" name="state_name" id="state_name" placeholder="Enter State" value="{{!empty($edit_data->state_name) ? $edit_data->state_name : ''}}">
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
                                        <th>Country </th>
                                        <th>State</th>
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
        $(".state").addClass("menuitem-active");
        $(".state a").addClass("active");
    </script>
    <script src="{{ asset('controller_js/cn_state_master.js') }}"></script>
    @endsection