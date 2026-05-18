@section('meta_title') Home | LCW @endsection
@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Section 1 - Banner</h4>
                    </div>
                </div>


                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">

                            <form name="homeForm1" id="homeForm1" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_heading1" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section1_heading1" name="section1_heading1" value="{{ !empty($edit_data->section1_heading1) ? $edit_data->section1_heading1 : '' }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Sub Heading</label>
                                                <textarea type="text" rows="3" class="form-control " id="section1_sub_heading1" name="section1_sub_heading1" >{{ !empty($edit_data->section1_sub_heading1) ? $edit_data->section1_sub_heading1 : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_button_name1" class="form-label required-field">Button Name</label>
                                                <input type="text" class="form-control" id="section1_button_name1" name="section1_button_name1" value="{{ !empty($edit_data->section1_button_name1) ? $edit_data->section1_button_name1 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_button_url1" class="form-label required-field"> Button URL</label>
                                                <input type="text" class="form-control" id="section1_button_url1" name="section1_button_url1" value="{{ !empty($edit_data->section1_button_url1) ? $edit_data->section1_button_url1 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Image</label>
                                                <p class="text-gray mb-1">Note: Image Size-W(1351px)*H(700px)</p>
                                                <input type="file" data-plugins="dropify" name="section1_image1" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section1_image1) && Storage::exists($edit_data->section1_image1) ? url('/').Storage::url($edit_data->section1_image1) : '' }}" />
                                            </div>
                                            <input type="hidden" id="section1_old_image1" value="{{ !empty($edit_data->section1_image1) && Storage::exists($edit_data->section1_image1) ? url('/').Storage::url($edit_data->section1_image1) : '' }}">
                                        </div>

                                        

                                    </div>

                                </div>
 
                                <button class="btn btn-success" type="submit" id="btn-submit1"> {{ !empty($edit_data) ? 'Update' : 'Submit' }} </button>
                                @if(empty($edit_dataAA)) <a href="" class="btn btn-danger"> Cancel </a> @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">

                            <form name="homeForm2" id="homeForm2" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_heading2" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section1_heading2" name="section1_heading2" value="{{ !empty($edit_data->section1_heading2) ? $edit_data->section1_heading2 : '' }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_sub_heading2" class="form-label required-field">Sub Heading</label>
                                                <textarea type="text" rows="3" class="form-control " id="section1_sub_heading2" name="section1_sub_heading2" >{{ !empty($edit_data->section1_sub_heading2) ? $edit_data->section1_sub_heading2 : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_button_name2" class="form-label required-field">Button Name</label>
                                                <input type="text" class="form-control" id="section1_button_name2" name="section1_button_name2" value="{{ !empty($edit_data->section1_button_name2) ? $edit_data->section1_button_name2 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_button_url2" class="form-label required-field"> Button URL</label>
                                                <input type="text" class="form-control" id="section1_button_url2" name="section1_button_url2" value="{{ !empty($edit_data->section1_button_url2) ? $edit_data->section1_button_url2 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Image</label>
                                                <p class="text-gray mb-1">Note: Image Size-W(1351px)*H(700px)</p>
                                                <input type="file" data-plugins="dropify" name="section1_image2" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section1_image2) && Storage::exists($edit_data->section1_image2) ? url('/').Storage::url($edit_data->section1_image2) : '' }}" />
                                            </div>
                                        </div>

                                            <input type="hidden" id="section1_old_image2" value="{{ !empty($edit_data->section1_image2) && Storage::exists($edit_data->section1_image2) ? url('/').Storage::url($edit_data->section1_image2) : '' }}">
                                        

                                    </div>

                                </div>

                                <button class="btn btn-success" type="submit" id="btn-submit2"> {{ !empty($edit_data) ? 'Update' : 'Submit' }} </button>
                                @if(empty($edit_dataAA)) <a href="" type="reset" class="btn btn-danger"> Cancel </a> @endif
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">

                            <form name="homeForm3" id="homeForm3" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_heading3" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section1_heading3" name="section1_heading3" value="{{ !empty($edit_data->section1_heading3) ? $edit_data->section1_heading3 : '' }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Sub Heading</label>
                                                <textarea type="text" rows="3" class="form-control " id="section1_sub_heading3" name="section1_sub_heading3" >{{ !empty($edit_data->section1_sub_heading3) ? $edit_data->section1_sub_heading3 : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_button_name3" class="form-label required-field">Button Name</label>
                                                <input type="text" class="form-control" id="section1_button_name3" name="section1_button_name3" value="{{ !empty($edit_data->section1_button_name3) ? $edit_data->section1_button_name3 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section1_button_url3" class="form-label required-field"> Button URL</label>
                                                <input type="text" class="form-control" id="section1_button_url3" name="section1_button_url3" value="{{ !empty($edit_data->section1_button_url3) ? $edit_data->section1_button_url3 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Image</label>
                                                <p class="text-gray mb-1">Note: Image Size-W(1351px)*H(700px)</p>
                                                <input type="file" data-plugins="dropify" name="section1_image3" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section1_image3) && Storage::exists($edit_data->section1_image3) ? url('/').Storage::url($edit_data->section1_image3) : '' }}" />
                                            </div>
                                        </div>

                                            <input type="hidden" id="section1_old_image3" value="{{ !empty($edit_data->section1_image3) && Storage::exists($edit_data->section1_image3) ? url('/').Storage::url($edit_data->section1_image3) : '' }}">
                                        

                                    </div>

                                </div>

                                <button class="btn btn-success" type="submit" id="btn-submit3"> {{ !empty($edit_data) ? 'Update' : 'Submit' }} </button>
                                @if(empty($edit_dataAA)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>

                </div>


                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Section 2 - Marquee Text</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form  name="homeForm4" id="homeForm4" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
      
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Marquee Text</label>
                                                <textarea type="text" rows="3" class="form-control " id="section2_marquee_text" name="section2_marquee_text" value="">{{ !empty($edit_data->section2_marquee_text) ? $edit_data->section2_marquee_text : '' }}</textarea>
                                            </div>
                                        </div>

                                        

                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit" id="btn-submit4"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Section 3</h4>
                    </div>
                </div>


                <div class="col-4">
                    <div class="card ">
                        <div class="card-body">

                            <form name="homeForm5" id="homeForm5" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section3_heading1" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section3_heading1" name="section3_heading1" value="{{ !empty($edit_data->section3_heading1) ? $edit_data->section3_heading1 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Image</label>
                                                <p class="text-gray mb-1">Note: Image Size-W(410px)*H(400px)</p>
                                                <input type="file" data-plugins="dropify" name="section3_image1" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section3_image1) && Storage::exists($edit_data->section3_image1) ? url('/').Storage::url($edit_data->section3_image1) : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit" id="btn-submit5"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">

                            <form name="homeForm6" id="homeForm6" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="heading" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section3_heading2" name="section3_heading2" value="{{ !empty($edit_data->section3_heading2) ? $edit_data->section3_heading2 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Image</label>
                                                <p class="text-gray mb-1">Note: Image Size-W(410px)*H(400px)</p>
                                                <input type="file" data-plugins="dropify" name="section3_image2" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section3_image2) && Storage::exists($edit_data->section3_image2) ? url('/').Storage::url($edit_data->section3_image2) : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit" id="btn-submit6"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">

                            <form name="homeForm7" id="homeForm7" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section3_heading3" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section3_heading3" name="section3_heading3" value="{{ !empty($edit_data->section3_heading3) ? $edit_data->section3_heading3 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Image</label>
                                                <p class="text-gray mb-1">Note: Image Size-W(410px)*H(400px)</p>
                                                <input type="file" data-plugins="dropify" name="section3_image3" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section3_image3) && Storage::exists($edit_data->section3_image3) ? url('/').Storage::url($edit_data->section3_image3) : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit" id="btn_submit7"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Section 4</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form name="homeForm8" id="homeForm8" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section4_heading" class="form-label">Heading</label>
                                                <input type="text" class="form-control" id="section4_heading" name="section4_heading" value="{{ !empty($edit_data->section4_heading) ? $edit_data->section4_heading : '' }}">
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="mb-2 col-12">
                                                <label for="section4_sub_heading" class="form-label">Sub Heading</label>
                                                <input type="text" class="form-control" id="section4_sub_heading" name="section4_sub_heading" value="{{ !empty($edit_data->section4_sub_heading) ? $edit_data->section4_sub_heading : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-6">
                                                <label for="section4_button_name" class="form-label ">Button Name</label>
                                                <input type="text" class="form-control" id="section4_button_name" name="section4_button_name" value="{{ !empty($edit_data->section4_button_name) ? $edit_data->section4_button_name : '' }}">
                                            </div>
                                            <div class="mb-2 col-6">
                                                <label for="section4_button_url" class="form-label ">Button URL</label>
                                                <input type="text" class="form-control" id="section4_button_url" name="section4_button_url" value="{{ !empty($edit_data->section4_button_url) ? $edit_data->section4_button_url : '' }}">
                                            </div>
                                        </div>
                                        

                                        

                                    </div>
                                    <div class="col-6 add-ticket-image-upload">
                                        <div class="row">
                                            
                                            <div class="col-6 mb-2">
                                                <label for="" class="form-label required-field">Image</label>
                                                <p class="text-gray mb-1">Note: Image Size-W(475px)*H(629px)</p>
                                                <input type="file" data-plugins="dropify" name="section4_image1" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section4_image1) && Storage::exists($edit_data->section4_image1) ? url('/').Storage::url($edit_data->section4_image1) : '' }}" />
                                            </div>
                                            <div class="col-6 mb-2">
                                                <label for="" class="form-label required-field">Image</label>
                                                <p class="text-gray mb-1">Note: Image Size-W(628px)*H(629px)</p>
                                                <input type="file" data-plugins="dropify" name="section4_image2" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section4_image2) && Storage::exists($edit_data->section4_image2) ? url('/').Storage::url($edit_data->section4_image2) : '' }}" />
                                            </div>
        
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit" id="btn-submit8"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Section 5</h4>
                    </div>
                </div>


                <div class="col-3">
                    <div class="card ">
                        <div class="card-body">

                            <form name="homeForm9" id="homeForm9" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section5_heading1" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section5_heading1" name="section5_heading1" value="{{ !empty($edit_data->section5_heading1) ? $edit_data->section5_heading1 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section5_sub_heading1" class="form-label required-field">Sub Heading</label>
                                                <input type="text" class="form-control" id="section5_sub_heading1" name="section5_sub_heading1" value="{{ !empty($edit_data->section5_sub_heading1) ? $edit_data->section5_sub_heading1 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Icon</label>
                                                <input type="file" data-plugins="dropify" name="section5_icon1" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section5_icon1) && Storage::exists($edit_data->section5_icon1) ? url('/').Storage::url($edit_data->section5_icon1) : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit" id="btn-submit9"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card ">
                        <div class="card-body">

                            <form name="homeForm10" id="homeForm10" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section5_heading2" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section5_heading2" name="section5_heading2" value="{{ !empty($edit_data->section5_heading2) ? $edit_data->section5_heading2 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section5_sub_heading2" class="form-label required-field">Sub Heading</label>
                                                <input type="text" class="form-control" id="section5_sub_heading2" name="section5_sub_heading2" value="{{ !empty($edit_data->section5_sub_heading2) ? $edit_data->section5_sub_heading2 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Icon</label>
                                                <input type="file" data-plugins="dropify" name="section5_icon2" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section5_icon2) && Storage::exists($edit_data->section5_icon2) ? url('/').Storage::url($edit_data->section5_icon2) : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit" id="btn-submit10"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card ">
                        <div class="card-body">

                            <form name="homeForm11" id="homeForm11" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section5_heading3" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section5_heading3" name="section5_heading3" value="{{ !empty($edit_data->section5_heading3) ? $edit_data->section5_heading3 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section5_sub_heading3" class="form-label required-field">Sub Heading</label>
                                                <input type="text" class="form-control" id="section5_sub_heading3" name="section5_sub_heading3" value="{{ !empty($edit_data->section5_sub_heading3) ? $edit_data->section5_sub_heading3 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Icon</label>
                                                <input type="file" data-plugins="dropify" name="section5_icon3" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section5_icon3) && Storage::exists($edit_data->section5_icon3) ? url('/').Storage::url($edit_data->section5_icon3) : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit" id="btn-submit11"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card ">
                        <div class="card-body">

                            <form name="homeForm12" id="homeForm12" action="{{ url('admin/home/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section5_heading4" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="section5_heading4" name="section5_heading4" value="{{ !empty($edit_data->section5_heading4) ? $edit_data->section5_heading4 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="section5_sub_heading4" class="form-label required-field">Sub Heading</label>
                                                <input type="text" class="form-control" id="section5_sub_heading4" name="section5_sub_heading4" value="{{ !empty($edit_data->section5_sub_heading4) ? $edit_data->section5_sub_heading4 : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Icon</label>
                                                <input type="file" data-plugins="dropify" name="section5_icon4" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->section5_icon4) && Storage::exists($edit_data->section5_icon4) ? url('/').Storage::url($edit_data->section5_icon4) : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit" id="btn-submit12"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Section 6 </h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form name="homeForm12" id="homeForm13" action="{{ url('admin/home/showcase-store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="image-uploader col-12">
                                            <div class="image-uploader col-4">
                                                <label for="" class="form-label">Upload Logo Images</label>
                                                <p class="text-gray mb-1">Note: Image Size-W(140px)*H(140px)</p>
                                                <input type="file"  id="showcase_image" name="showcase_image" accept=".jpg, .jpeg, .png">
                                            </div>
                                                <div id="preview" class="preview-container">   
                                                    {{-- <img class="preview-img" src="{{ asset('/front/images/PAR-Clinical-logo-dark.svg') }}" alt="">  --}}
                                                </div>
                                              </div>
                                        </div>
                                    </div> 

                                    
                                </div>

                                <button class="btn btn-success mb-2" type="submit"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger  mb-2"> Cancel </button> @endif
                            </form>
                            @if(!empty($showcase_data))
                            @foreach($showcase_data as $k => $value)
                            <div style="position: relative; display: inline-block; margin-right:10px">
                                <img class="preview-box" src="{{ !empty($value->showcase_image) ? url('/').Storage::url($value->showcase_image) : '' }}" alt="">
                                <a onclick="return confirm('Are you sure you want to delete this Image?');" href="{{url('admin/home/delete-showcase-image')}}/{{Crypt::encrypt($value->id)}}">
                                <i class="mdi mdi-close-circle remove-icon"></i>
                                </a>
                            </div>
                            @endforeach
                            @endif
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('controller_js/cn_homecms.js') }}"></script>

@endsection