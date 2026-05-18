@section('meta_title') About | LCW @endsection
@extends('Admin.Layouts.layout')
@section('content')

<style>
    .table>:not(caption)>*>*
    {
        white-space: normal !important;
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Section 1 - About Us</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form name="aboutForm" id="aboutForm" action="{{ url('admin/about/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="heading" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="heading" name="heading" value="{{ !empty($edit_data->heading) ? $edit_data->heading : '' }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">About LCW</label>
                                                <textarea type="text" rows="3" class="form-control " id="about_lcw" name="about_lcw" value="">{{ !empty($edit_data->about_lcw) ? $edit_data->about_lcw : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Our Vision</label>
                                                <textarea type="text" rows="3" class="form-control " id="our_vision" name="our_vision" value="">{{ !empty($edit_data->our_vision) ? $edit_data->our_vision : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label required-field">Our Mission</label>
                                                <textarea type="text" rows="3" class="form-control " id="our_mission" name="our_mission" value="">{{ !empty($edit_data->our_mission) ? $edit_data->our_mission : '' }}</textarea>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <div class="col-4 add-ticket-image-upload">
                                        <div class="row">
                                            
                                            <div class="col-12 mb-2">
                                                <label for="" class="form-label required-field">Image</label><p class="text-gray mb-1">Note: Image Size-W(620px)*H(620px)</p>
                                                <input accept=".jpg, .jpeg, .png" type="file" data-plugins="dropify" name="image" size="40" accept="image/*" data-default-file="{{ !empty($edit_data->image) && Storage::exists($edit_data->image) ? url('/').Storage::url($edit_data->image) : '' }}" />
                                                <input type="hidden" id="old_image" value="{{ !empty($edit_data->image) && Storage::exists($edit_data->image) ? url('/').Storage::url($edit_data->image) : '' }}" >
                                            
                                            </div>
        
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit" id="btn-submit"> {{ !empty($edit_data) ? 'Update' : 'Submit' }} </button>
                                @if(empty($edit_data)) <a href="{{ url('admin/about') }}" class="btn btn-danger"> Cancel </a> @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12" id="tform-1">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Section 2 - Testimonials</h4>
                    </div>
                </div>

                <div class="col-4" id="tform">
                    <div class="card department-card">
                        <div class="card-body">

                            <form  name="testimonialsForm" id="testimonialsForm" action="{{ url('admin/about/testimonial-store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data1->id) ? Crypt::encrypt($edit_data1->id) : '' }}">
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="name" class="form-label required-field">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ !empty($edit_data1->name) ? $edit_data1->name : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="heading" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="heading" name="heading" value="{{ !empty($edit_data1->heading) ? $edit_data1->heading : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="rating" class="form-label required-field">Star Rating (Out of 5)</label>
                                                <input type="text" class="form-control" id="star_rating" onpaste="return false" name="star_rating" onkeypress="return /[1-5]/.test(event.key)" maxlength="1" value="{{ !empty($edit_data1->star_rating) ? $edit_data1->star_rating : '' }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="heading" class="form-label required-field">Description</label>
                                                <textarea type="text" rows="5" class="form-control summernote" id="description" name="description">{{ !empty($edit_data1->description) ? $edit_data1->description : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <button class="btn btn-success" type="submit" id="btn-submit-1"> {{ !empty($edit_data1) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <a href="{{ url('admin/about') }}" class="btn btn-danger"> Cancel </a>  @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body table-responsive department-card">

                            <table id="data-table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                                <thead class="table-light">
                                    <tr role="row">
                                        <th width="5%">Sr No</th>
                                        <th width="10%">Name</th>
                                        <th width="5%">Heading</th>
                                        <th width="60%">Description</th>
                                        <th width="5%">Status</th>
                                        <th width="15%">Action</th>
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
<script>

        $(".cms").addClass("menuitem-active");
        $("#cms").addClass("show");
        $(".about").addClass("menuitem-active");
        $(".about a").addClass("active");

    $(document).ready(function() {
        $('.summernote').summernote({
            height: 160 // set height in pixels
        });
    });
</script>
@if(!empty($scroll_to))
<script>
 $('html, body').animate({
    scrollTop: $('#testimonialsForm').offset().top
  }, 300);
</script>
@endif
<script src="{{ asset('controller_js/cn_about.js') }}"></script>
@endsection