@section('meta_title')
    Add Product | LCW Lighting
@endsection
@extends('Admin.Layouts.layout')
@section('content')
<style>
    td {
        white-space: normal !important
    }
</style>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">{{!empty($edit_data->price)?'Edit':'Add'}} Product</h4>
                        <a href="{{ url('admin/product') }}" class="btn btn-secondary waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-long-arrow-alt-left"></i></span>Back</a>
                    </div>
                    <div class="card department-card">
                        <div class="card-body">
                            <form id="productForm" name="productForm" action="{{url('admin/product/store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{!empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : ''}}">
                                
                                <div class="row">
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="mb-2 col-6">
                                                <label for="role" class="form-label required-field">Category</label>
                                                <select class="form-select" id="category_id" name="category_id">
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
                                            <div class="mb-2 col-6">
                                                <label for="role" class="form-label">Sub Category</label>
                                                <select class="form-select" id="sub_category_id" name="sub_category_id">
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
                                            <div class="mb-2 col-6">
                                                <label for="role" class="form-label">Sub Sub Category</label>
                                                <select class="form-select" id="sub_sub_category_id" name="sub_sub_category_id">
                                                    <option value="">Select Sub Sub Category</option>
                                                    @if(!empty($sub_sub_category_list))
                                                    @foreach($sub_sub_category_list as $key => $value)

                                                    @php 
                                                    $selected = '';
                                                    if(!empty($edit_data->sub_sub_category_id) && $edit_data->sub_sub_category_id == $value->id){
                                                        $selected = 'selected';
                                                    }
                                                    @endphp

                                                    <option {{ $selected }} value="{{$value->id}}">{{$value->sub_sub_category_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="mb-2 col-6">
                                                <label for="role" class="form-label required-field">Brand</label>
                                                <select class="form-select" id="brand_id" name="brand_id">
                                                    <option value="">Select Brand</option>
                                                    @if(!empty($brand_list))
                                                    @foreach($brand_list as $key => $value)

                                                    @php 
                                                    $selected = '';
                                                    if(!empty($edit_data->brand_id) && $edit_data->brand_id == $value->id){
                                                        $selected = 'selected';
                                                    }
                                                    @endphp

                                                    <option {{ $selected }} value="{{$value->id}}">{{$value->brand_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="name" class="form-label required-field">Product Name</label>
                                                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ !empty($edit_data->product_name) ? $edit_data->product_name : ''}}">
                                             
                                            </div>
                                            <div class="mb-2 col-12">
                                                <label for="name" class="form-label required-field">Slug URL</label>
                                                <input type="text" class="form-control" id="slug_url" name="slug_url" value="{{ !empty($edit_data->slug_url) ? $edit_data->slug_url : ''}}">
                                               
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-4">
                                                <label for="" class="form-label required-field">SKU</label>
                                                <input type="text" class="form-control" id="sku" name="sku" value="{{ !empty($edit_data->sku) ? $edit_data->sku : ''}}">
                                                <span class="text-danger d-none" id="email_existence_message"></span>
                                               
                                            </div>
                                            <div class="mb-2 col-4">
                                                <label for="" class="form-label required-field"> Price</label>
                                                <input type="text" class="form-control" id="price" name="price" onkeypress="return /[0-9.]/i.test(event.key)" value="{{ !empty($edit_data->price) ? $edit_data->price : ''}}" maxlength="10">
                                              
                                            </div>
                                            <div class="mb-2 col-4">
                                                <label for="" class="form-label required-field"> Offer Price </label>
                                                <input type="text" class="form-control" id="offer_price" name="offer_price" onkeypress="return /[0-9.]/i.test(event.key)" value="{{ !empty($edit_data->offer_price) ? $edit_data->offer_price : ''}}" maxlength="10" required>
                                            </div>
                                        </div>

                                        <div style="display: none;" class="row">
                                            <div class="mb-3 col-2">
                                                <label class="form-check-label required-field" for="gstCheckbox">
                                                    GST
                                                </label>
                                                <input class="form-check-input" type="checkbox" value="yes" id="gstCheckbox" name="is_gst" {{(!empty($edit_data->is_gst) && $edit_data->is_gst=='yes')?'checked':''}}>

                                            </div>
                                            @php
                                             $dsplay = (!empty($edit_data->is_gst) && $edit_data->is_gst=='yes')?'':'none';
                                            @endphp
                                            <div class="mb-3 col-3" id="gstSelectContainer" style="display: {{$dsplay}};" >
                                                <select class="form-select" id="role" name="gst_id">
                                                    <option value="">Select GST %</option>
                                                    @if(!empty($gst_list))
                                                    @foreach($gst_list as $key => $value)

                                                    @php 
                                                    $selected = '';
                                                    if(!empty($edit_data->gst_id) && $edit_data->gst_id == $value->id){
                                                        $selected = 'selected';
                                                    }
                                                    @endphp

                                                    <option {{ $selected }} value="{{$value->id}}">{{$value->gst_value}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="" class="form-label required-field">Short Description</label>
                                            <textarea type="text" class="form-control" rows="3" id="short_description" name="short_description" value="">{{ !empty($edit_data->short_description) ? $edit_data->short_description : ''}}</textarea>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label for="" class="form-label">Description</label>
                                            <textarea type="text" class="form-control summernote" id="description" name="description" value="">{{ !empty($edit_data->description) ? $edit_data->description : ''}}</textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="" class="form-label">Specifications</label>
                                            <textarea type="text" class="form-control summernote" id="specification" name="specification" value="">{{ !empty($edit_data->specification) ? $edit_data->specification : ''}}</textarea>
                                        </div>

                                        <div class="mb-3">
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" id="extraTab" name="extra_tab" value="yes" {{(!empty($edit_data->extra_tab) && $edit_data->extra_tab=='yes')?'checked':''}}>
                                            <label class="form-check-label" for="extraTab">
                                                Extra Tab
                                            </label>
                                        </div>
                                        
                                        <div class="mb-3 {{(!empty($edit_data->extra_tab) && $edit_data->extra_tab=='yes')?'':'d-none'}} " id="tabNameContainer">
                                        <div class="col-4 mb-2">
                                            <label for="tabName" class="form-label">Tab Name</label>
                                            <input type="text" class="form-control" id="tabName" name="tab_name" placeholder="Enter Tab Name" value="{{(!empty($edit_data->tab_name) && $edit_data->extra_tab=='yes')?$edit_data->tab_name:''}}">
                                        </div>  
                                         
                                        <div class="card filter-card-main mb-2">
                                            <div class="card-body table-responsive filter-card">
                                                <div class="row align-items-end mb-3">
                
                                                    <div class="col-md-3 ">
                                                        <label class="mb-1">Category </label>
                                                        <select class="form-select" id="category_a" name="category_a">
                                                            <option value="">Select</option>
                                                            @if(!empty($category_list))
                                                            @foreach($category_list as $key => $value)

                                                            @php 
                                                            $selected = '';
                                                            if(!empty($edit_data->category_id) && $edit_data->category_id == $value->id){
                                                                $selected = 'selected';
                                                            }
                                                            @endphp

                                                            <option  value="{{$value->id}}">{{$value->category_name}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <label class="mb-1">Sub Category </label>
                                                        <select class="form-select" id="sub_category_a" name="sub_category_a">
                                                            <option value="">Select</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <label class="mb-1">Sub Sub Category </label>
                                                        <select class="form-select" id="sub_sub_category_a" name="sub_sub_category_a">
                                                            <option value="">Select</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-3 ">
                
                                                        <label class="btn btn-primary waves-effect waves-light "
                                                            id="filterButton"><i class=" fas fa-filter"></i> Filter</label>
                
                                                    </div>
                                                </div>
                                                
                                                <input type="hidden" id="controller_product_ids" value="{{!empty($edit_data->controller_product_ids)?$edit_data->controller_product_ids:''}}">
                                                <table id="data-table1" class="table table-bordered table-bordered dt-responsiv ">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th style="width: 0%;">Sr No</th>
                                                            <th style="width: 10%;"><input type="checkbox" id="selectAll"></th>
                                                            <th style="width: 10%;">Product ID</th>
                                                            <th style="width: 10%;">Product Name</th>
                                                            <th style="width: 10%;">SKU</th>
                                                            <th style="width: 10%;">Price</th>
                                                            <th style="width: 10%;">Offer Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        @if(!empty($controller_product_list))
                                                        @foreach($controller_product_list as $key => $value)
                                                        <tr>
                                                            <td>{{($key+1)}}</td>
                                                            <td><input type="checkbox" class="row_checkbox" checked value="{{!empty($value->id)?$value->id:''}}" name="controller_products[]"></td>
                                                            <td>{{!empty($value->product_id)?$value->product_id:''}}</td>
                                                            <td>{{!empty($value->product_name)?$value->product_name:''}}</td>
                                                            <td>{{!empty($value->sku)?$value->sku:''}}</td>
                                                            <td>{{!empty($value->price)?$value->price:''}}</td>
                                                            <td>{{!empty($value->offer_price)?$value->offer_price:''}}</td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    </div>  

                                        <div class="row">
                                            @if(!empty($parameter_list))
                                            @foreach($parameter_list as $k => $value)
                                            
                                            <div class="mb-3 col-3">
                                                <div class="d-flex justify-content-between">
                                                    <label for="checkDefault" class="form-label">{{ucwords($value->product_parameter_name)}}</label>
                                                    <input class="form-check-input param-chkbx" type="checkbox" id="checkDefault1_{{$k}}" name="product_parameter_chkbx[]" value="{{($value->id)}}" {{(!empty($value->id) && !empty($edit_parameter_name_ids) && in_array($value->id,explode(',',$edit_parameter_name_ids)))?'checked':''}}>
                                                    <input class="form-check-input param-chkbx" type="hidden" name="product_parameter_chkbx_id[]" value="{{($value->id)}}" {{(!empty($value->id) && !empty($edit_parameter_name_ids) && in_array($value->id,explode(',',$edit_parameter_name_ids)))?'checked':''}}>
                                                    
                                                </div>
                                                <select class="form-select" id="ParamSelect_{{$k}}" name="product_parameter[]" {{(!empty($value->id) && !empty($edit_parameter_name_ids) && in_array($value->id,explode(',',$edit_parameter_name_ids)))?'':'disabled'}}>
                                                    <option value=""> --Select-- </option>
                                                    @if(!empty($value->param_values))
                                                    @foreach($value->param_values as $key => $value1)

                                                    @php 
                                                    $selected = '';
                                                    if(!empty($edit_parameter_value_ids) && in_array($value1->id,explode(',',$edit_parameter_value_ids))){
                                                        $selected = 'selected';
                                                    }
                                                    @endphp

                                                    <option {{ $selected }} value="{{$value1->id}}">{{$value1->product_parameter_value}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            @endforeach
                                            @endif
                                           
                                        </div>
                                    </div>
                                    <div class="col-3 add-ticket-image-upload">
                                        <div class="mt-3">
                                            <p class="text-gray mb-1">Note: Image Size-W(400px)*H(600px)</p>
                                            <input type="file" data-plugins="dropify" name="product_main_image"  size="40" accept="image/jpeg, image/jpg, image/png" data-default-file="{{ !empty($edit_data->product_main_image) && Storage::exists($edit_data->product_main_image) ? url('/').Storage::url($edit_data->product_main_image) : URL::asset('front/images/default-img.jpg') }}" />
                                            <input type="hidden" id="old_product_main_image" value="{{!empty($edit_data->product_main_image)?$edit_data->product_main_image:URL::asset('front/images/default-img.jpg');}}">
                                            <p class="text-center mt-2 mb-0 required-field"> Main Image</p>
                                            
                                        </div>
                                        <label id="product_main_image-error" class="text-danger" for="product_main_image"></label>
                                        <div class="mt-3">
                                            <label for="" class="form-label">Gallery Images</label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" accept="image/jpeg, image/jpg, image/png" name="gallery_images[]" multiple id="inputGroupFile02">
                                            </div>
                                            

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        @if(!empty($edit_gallery_images))
                                                        @foreach($edit_gallery_images as $key => $value)
                                                        <div class="col-6">
                                                            <div class="image-wrapper">
                                                                <img src="{{ !empty($value->product_gallery_image) ? url('/').Storage::url($value->product_gallery_image) : '' }}"
                                                                    style="width: 100px; height: 100px;"
                                                                    alt="">
                                                                <a onclick="return confirm('Are you sure you want to delete this?');" href="{{url('admin/delete-gallery-image/')}}/{{Crypt::encrypt($value->id)}}">    
                                                                <i class="bi bi-x remove-icon" id="del_{{$value->id}}"
                                                                    ></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    </div>

                                    <div class="col-12 add-ticket-image-upload">
                                        <div>
                                            <div
                                                class="mb-1 col-3 pe-3 d-flex justify-content-between align-items-center">
                                                <label class="form-label">Download File (PDF Format)</label>
                                                <label class="btn btn-primary  py-0" id="add_more_pdf" onclick="addUploadBlock()"><i
                                                        class="bi bi-plus-lg"></i> Add </label>
                                            </div>

                                            <div class="row" id="pdfUploadRow">
                                                <div class="col-3 d-flex flex-column">
                                                    <input name="product_pdf_file_name[]" id="product_pdf_file_name_0"  type="text" class="mb-1 form-control"
                                                        placeholder="File Name">
                                                    <div class="input-group mb-3">
                                                        <input name="product_pdf_file[]" id="product_pdf_file_0"  type="file" class="form-control" accept=".pdf">
                                                    </div>
                                                </div>
                                            </div>

                                            @if(!empty($edit_pdf_files))
                                            <div class="row" id="pdfUploadRow">
                                            @foreach($edit_pdf_files as $k => $value)
                                                <div class="col-3 d-flex flex-column">
                                                    
                                                    
                                                    
                                                    <input name="edit_product_pdf_file_name[]" id="edit_product_pdf_file_name_0"  type="text" class="mb-1 form-control"
                                                        placeholder="File Name" value="{{!empty($value->product_pdf_file_name)?$value->product_pdf_file_name:''}}">
                                                    <div class="input-group mb-3">
                                                        <input name="edit_product_pdf_file[]" id="edit_product_pdf_file_0"  type="file" class="form-control">
                                                        <input type="hidden" name="old_product_pdf_file" value="{{!empty($value->product_pdf_file)?$value->product_pdf_file:''}}" >
                                                        <input type="hidden" name="edit_product_pdf_file_ids[]" value="{{!empty($value->id)?$value->id:''}}" >
                                                        <a href="{{url('admin/product/delete-product-pdf')}}/{{Crypt::encrypt($value->id)}}" onclick="return confirm('Are you sure you want to delete this?');" class="w-100">
                                                        <div class="btn btn-danger delete-pdf w-100" id="pdf_{{!empty($value->id)?$value->id:''}}">
                                                        Delete
                                                        </div> 
                                                        </a>
                                                    </div>
                                                    
                                                </div>
                                            @endforeach
                                            </div>
                                            @endif
                                        </div>

                                        <div>
                                            <div
                                                class="mb-1 col-3 pe-3 d-flex justify-content-between align-items-center">
                                                <label class="form-label">Description Image</label>
                                                <label class="btn btn-primary py-0" id="add_more_desc" onclick="addImageUploadBlock()">
                                                    <i class="bi bi-plus-lg"></i> Add
                                                </label>
                                            </div>
                                            
                                            <div class="row" id="imageUploadRow">
                                                <div class="col-3 d-flex flex-column">
                                                    <input type="text" class="mb-1 form-control" name="product_discription_name[]"
                                                        placeholder="Image Name">
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" accept="image/jpeg, image/jpg, image/png" name="product_discription_image[]">
                                                    </div>
                                                </div>
                                            </div>

                                            @if(!empty($edit_description_images))
                                            <div class="row" id="imageUploadRow">
                                            @foreach($edit_description_images as $k => $value)
                                                
                                                <div class="col-3 d-flex flex-column">
                                                
                                                    <input type="text" class="mb-1 form-control" name="edit_product_discription_name[]"
                                                        placeholder="Image Name" value="{{!empty($value->product_discription_name)?$value->product_discription_name:''}}">
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="edit_product_discription_image[]">
                                                        <input type="hidden" name="old_product_discription_image" value="{{!empty($value->product_discription_image)?$value->product_discription_image:''}}" >
                                                        <input type="hidden" name="edit_product_description_ids[]" value="{{!empty($value->id)?$value->id:''}}" >
                                                        <a href="{{url('admin/product/delete-product-description-image')}}/{{Crypt::encrypt($value->id)}}" onclick="return confirm('Are you sure you want to delete this?');" class="w-100">
                                                        <div class="btn btn-danger delete-desc w-100" id="dsc_{{!empty($value->id)?$value->id:''}}">
                                                        Delete
                                                        </div>
                                                        </a> 
                                                    </div>
                                                </div>
                                                
                                                @endforeach
                                            </div>
                                            @endif
                                            
                                        </div>


                                    <div class="row">
                                        <div class="mb-3 col-12">
                                            <label class="form-check-label" for="">
                                                Meta Title
                                            </label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ !empty($edit_data->meta_title) ? $edit_data->meta_title : ''}}">
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label class="form-check-label" for="">
                                                Meta Keywords
                                            </label>
                                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ !empty($edit_data->meta_keywords) ? $edit_data->meta_keywords : ''}}">
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label class="form-check-label" for="">
                                                Meta Description
                                            </label>
                                            <textarea type="text" class="form-control" id="meta_description" name="meta_description" value="">{{ !empty($edit_data->meta_description) ? $edit_data->meta_description : ''}}</textarea>
                                        </div>





                                    </div>


                                </div>
                                <button class="btn btn-success" id="btn-submit" type="submit"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".product").addClass("menuitem-active");
        $(".product a").addClass("active");

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 150,
            });
        });

       
    </script>

    <script>
        const checkbox = document.getElementById('gstCheckbox');
        const selectContainer = document.getElementById('gstSelectContainer');

        checkbox.addEventListener('change', function() {
            selectContainer.style.display = this.checked ? 'block' : 'none';
        });
    </script>
 <script>
    $('#add_more_pdf').on('click', function () {
        const colDiv = $(`
            <div class="col-3 d-flex flex-column">
                <input type="text" class="mb-1 form-control" name="product_pdf_file_name[]" placeholder="File Name">
                <div class="input-group mb-3">
                    <input type="file" name="product_pdf_file[]" class="form-control">
                </div>
            </div>
        `);

        $('#pdfUploadRow').append(colDiv);
    });
</script>
<script>
    $('#add_more_desc').on('click', function () {
        const colDiv = $(`
            <div class="col-3 d-flex flex-column">
                <input type="text" class="mb-1 form-control" placeholder="Image Name" name="product_discription_name[]">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="product_discription_image[]">
                </div>
            </div>
        `);

        $('#imageUploadRow').append(colDiv);
    });
</script>
<script>
    function removeImage(icon) {
        icon.parentElement.remove(); // Removes the whole image wrapper
    }
</script>
<script>
$('.param-chkbx').click(function (e) { 
    var id = this.id.split('_')[1];
    var $select = $('#ParamSelect_' + id);
    
    if ($(this).is(':checked')) {
        $select.removeAttr('disabled');
    } else {
        $select.prop('disabled', true);
        $select.prop('selectedIndex', 0); // Selects the first option
    }
});

</script>
<script>
    const extraTabCheckbox = document.getElementById('extraTab');
    const tabNameContainer = document.getElementById('tabNameContainer');

    extraTabCheckbox.addEventListener('change', function () {
        if (this.checked) {
            tabNameContainer.classList.remove('d-none');
        } else {
            tabNameContainer.classList.add('d-none');
        }
    });
</script>
<script src="{{ asset('controller_js/cn_add_product.js') }}"></script>

@endsection
