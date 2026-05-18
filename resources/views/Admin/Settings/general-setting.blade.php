@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">General Settings</h4>
                    </div>
                </div>


                <div class="col-8">
                    <div class="card department-card">
                        <div class="card-body">
                            <div class="mb-3 justify-content-between d-flex align-items-center">
                                <h4 class="header-title ">Add Contact Details</h4>
                            </div>
                            <form action="{{route('geraral.settings.store')}}" method="post" id="general_settings_contact_form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="heading" class="form-label">Heading</label>
                                                <input type="text" class="form-control" id="heading" name="heading" value="{{!empty($general_settings->heading) ? $general_settings->heading : ''}}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label">Description</label>
                                                <textarea type="text" rows="3" class="form-control summernote" id="description" name="description" >{{!empty($general_settings->description) ? $general_settings->description : ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="slug_url" class="form-label">Google Map URL</label>
                                                <input type="text" class="form-control" id="map_link" name="map_link" value="{{!empty($general_settings->map_link) ? $general_settings->map_link : ''}}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="opening_hours" class="form-label">Opening Hours</label>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="text" class="form-control" name="opening_hours" id="opening_hours" value="{{!empty($general_settings->opening_hours) ? $general_settings->opening_hours : ''}}" />
                                                  
                                                </div>
                                            </div>                                            
                                        </div>
                                        

                                    </div>
                                    <div class="col-4 add-ticket-image-upload">
                                        <div class="row ">
                                            <div class="mb-2 col-12">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" value="{{!empty($general_settings->email) ? $general_settings->email : ''}}">
                                            </div>
                                            <div class="mb-2 col-12">
                                                <label for="mobile" class="form-label">Mobile No.</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" value="{{!empty($general_settings->mobile) ? $general_settings->mobile : ''}}">
                                            </div>
                                            <div class="mb-2 col-12">
                                                <label for="address" class="form-label">Addresss</label>
                                                <textarea rows="3" name="address" id="address" class="form-control">{{!empty($general_settings->address) ? $general_settings->address : ''}}</textarea>
                                            </div>
                                            <div class="mb-2 col-12">
                                                <label for="helpline_no" class="form-label">Helpline No.</label>
                                                <input type="text" class="form-control" id="helpline_no" name="helpline_no" value="{{!empty($general_settings->helpline_no) ? $general_settings->helpline_no : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" name="contact_settings" id="submit_btn" class="btn btn-success"> {{ !empty($general_settings) ? 'Update' : 'Submit' }} </button>
                                @if(empty($general_settings)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">
                            <div class="mb-3 justify-content-between d-flex align-items-center">
                                <h4 class="header-title ">Add Social Media Details</h4>
                            </div>
                            <form action="{{route('geraral.settings.store')}}" method="post" id="general_settings_contact_form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="facebook_url" class="form-label">Facebook Url</label>
                                        <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="Facebook URL" value="{{!empty($general_settings->facebook_url) ? $general_settings->facebook_url : ''}}">
                                        @if($errors->has('facebook_url'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('facebook_url')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="linkedin_url" class="form-label">LinkedIn Url</label>
                                        <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" placeholder="LinkedIn URL" value="{{!empty($general_settings->linkedin_url) ? $general_settings->linkedin_url : ''}}">
                                        @if($errors->has('linkedin_url'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('linkedin_url')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="instagram_url" class="form-label">Instagram Url</label>
                                        <input type="text" class="form-control" name="instagram_url" id="instagram_url" placeholder="Instagram URL" value="{{!empty($general_settings->instagram_url) ? $general_settings->instagram_url : ''}}">
                                        @if($errors->has('instagram_url'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('instagram_url')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" name="social_media_settings" id="submit_btn" class="btn btn-success"> {{ !empty($general_settings) ? 'Update' : 'Submit' }} </button>
                                @if(empty($general_settings)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div> <!-- end card-body -->
                </div>
            </div> <!-- container-fluid -->
        </div>
    </div>
    @endsection

    @section('script')
    <script>
        $(".setting").addClass("menuitem-active");
        $(".general-setting").addClass("menuitem-active");
    </script>
    @endsection