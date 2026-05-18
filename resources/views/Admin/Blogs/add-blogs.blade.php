@section('meta_title') Add Blogs | LCW @endsection
@extends('Admin.Layouts.layout')
@section('content')

<style>
    #blog_image-error
    {
            position: absolute;
    bottom: -27px;
    left: 0;
    }
    .dropify-wrapper {
     position: unset;
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">{{ !empty($edit_data) ? 'Edit' : 'Add' }} Blog</h4>
                        <a href="{{ url('admin/blogs')}}" class="btn btn-secondary waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-long-arrow-alt-left"></i></span>Back</a>
                    </div>
                    <div class="card department-card">
                        <div class="card-body">
                            <form name="blogForm" id="blogForm" action="{{ url('admin/blogs/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-8">
                                        <!-- <div class="row">
                                            <div class="mb-2 col-6">
                                                <label for="category" class="form-label"> Category </label>
                                                <select class="form-select" id="category" name="category">
                                                    <option value="">Select Category</option>
                                                    <option value="">Design</option>
                                                    <option value="">Web Solution</option>
                                                    <option value="">AI Solution</option>
                                                </select>
                                            </div>

                                        </div> -->
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="heading" class="form-label required-field">Heading</label>
                                                <input type="text" class="form-control" id="heading" name="heading" value="{{ !empty($edit_data->heading) ? $edit_data->heading : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="mb-2 col-6">
                                                <label for="date" class="form-label required-field">Date</label>
                                                <input type="date" class="form-control" id="date" name="date" value="{{ !empty($edit_data->date) ? $edit_data->date : '' }}">
                                            </div>
                                            <div class="mb-2 col-6">
                                                <label for="auther" class="form-label required-field">Author</label>
                                                <input type="text" class="form-control" id="auther" name="auther" value="{{ !empty($edit_data->auther) ? $edit_data->auther : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="slug" class="form-label required-field">Slug URL</label>
                                                <input type="text" class="form-control" id="slug" name="slug" value="{{ !empty($edit_data->slug) ? $edit_data->slug : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-12">
                                                <label for="" class="form-label">Description</label>
                                                <textarea type="text" rows="5" class="form-control summernote" id="description" name="description" value="">{{ !empty($edit_data->description) ? $edit_data->description : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label no-required-field">Meta Title</label>
                                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ !empty($edit_data->meta_title) ? $edit_data->meta_title : '' }}">
                                            </div>
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label no-required-field">Meta Keywords </label>
                                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ !empty($edit_data->meta_keywords) ? $edit_data->meta_keywords : '' }}">
                                            </div>
                                            <div class="mb-2 col-12">
                                                <label for="" class="form-label no-required-field">Description</label>
                                                <textarea rows="3" name="meta_description" id="meta_description" class="form-control">{{ !empty($edit_data->meta_description) ? $edit_data->meta_description : '' }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-4 add-ticket-image-upload">
                                        <div class="mt-3 position-relative">
                                            <p class="text-gray mb-1">Note: Image Size-W(1010px)*H(775px)</p>
                                            <input type="file" data-plugins="dropify" name="blog_image" size="40" accept=".jpg, .jpeg, .png" data-default-file="{{ !empty($edit_data->blog_image) && Storage::exists($edit_data->blog_image) ? url('/').Storage::url($edit_data->blog_image) : '' }}" />
                                            <p class="text-center mt-2 mb-0 required-field"> Blog Image</p>
                                            <input type="hidden" id="old_image" value="{{ !empty($edit_data->blog_image) && Storage::exists($edit_data->blog_image) ? url('/').Storage::url($edit_data->blog_image) : '' }}" >
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit"> {{ !empty($edit_data) ? 'Update' : 'Submit' }} </button>
                                @if(empty($edit_data)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
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
    $(".blogs").addClass("menuitem-active");
    $(".blogs a").addClass("active");
    $(document).ready(function() {
    $('.summernote').summernote({
      height: 150,   
    });
  });
</script>

<script>
var base_url = $('#base_url').val();

function generateSlug(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')       // Replace spaces with -
        .replace(/[^\w\-]+/g, '')   // Remove all non-word chars
        .replace(/\-\-+/g, '-');    // Replace multiple - with single -
}

$('#heading').on('change keyup paste', function() {
        let title = $(this).val();
        let slug = generateSlug(title);
        $('#slug').val(slug);
    });

</script>
<script>
$(document).ready(function () {
    $('#blogForm').validate({
        rules: {
            heading: {
                required: true,
                minlength: 5
            },
            date: {
                required: true,
                date: true
            },
            auther: {
                required: false,
                minlength: 3
            },
            slug: {
                required: true,
                minlength: 5,
                remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'get',
                            url: base_url + '/admin/blogs/check-slug-exist',
                            data: {
                                brand_name: function() {
                                    return $("#slug").val(); // Get the value of country_name field
                                },
                                id: function () {
                                    return $('#id').val()
                                }
                            },
                            dataType: 'json'
                        }
            },
            description: {
                required: true,
                minlength: 20
            },
            /*
            meta_title: {
                required: true
            },
            meta_keywords: {
                required: true
            },
            meta_description: {
                required: true
            },
            */
            blog_image: {
                required: function () {
                    return $('#old_image').val() === '';
                },
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            heading: {
                required: "Please enter heading",
                minlength: "Heading must be at least 5 characters"
            },
            date: {
                required: "Please select a date"
            },
            auther: {
                required: "Please enter author name"
            },
            slug: {
                required: "Please enter slug URL",
                remote:'Slug url already exists.'
            },
            description: {
                required: "Please enter description"
            },
            meta_title: {
                required: "Please enter meta title"
            },
            meta_keywords: {
                required: "Please enter meta keywords"
            },
            meta_description: {
                required: "Please enter meta description"
            },
            blog_image: {
                required: "Please upload an image",
                extension: "Only image files are allowed"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
});
</script>

@endsection