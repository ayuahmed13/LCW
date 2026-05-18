@section('meta_title')
    FAQ | LCW
@endsection
@extends('Admin.Layouts.layout')
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="header-title ">Page Content</h4>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="card department-card">
                            <div class="card-body">

                                <form name="pageContentForm" id="pageContentForm" action="{{ url('admin/pages-content/store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="mb-2 col-12">
                                                    <label class="required-field">Pages</label>
                                                    <select class="form-select" id="page_name" name="page_name" required>
                                                        <option value="">Select</option>
                                                        <option value="Privacy Policy">Privacy Policy</option>
                                                        <option value="Terms and Conditions">Terms and Conditions</option>
                                                        <option value="Grossary">Grossary</option>
                                                        <option value="Product Brand Information">Product / Brand Information</option>
                                                    </select>
                                                    <input type="hidden" name="id" id="id" >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-2 col-12">
                                                    <label for="heading" class="form-label">Description</label>
                                                    <textarea type="text" rows="5" class="form-control summernote" id="content" name="content" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-success" type="submit" id="btn-submit">
                                        {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                    @if (empty($system_user))
                                        <button type="reset" class="btn btn-danger"> Cancel </button>
                                    @endif
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
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300 // set height in pixels
            });
        });
    </script>
    <script>

    $('#page_name').change(function (e) { 
        var page_name = $('#page_name').val();
        if(page_name!=''){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: "post",
                url: base_url + "/admin/pages-content/get-pages-content",
                data: {page_name:page_name},
                dataType: "json",
                beforeSend: function () {
                    $('#content-loader').html('<i class="fa fa-spin fa-spinner"></i>Please Wait...');
                },
                success: function (response) {
                    if(response.status==200){
                        $('#id').val(response.data.id);
                        $('.summernote').summernote('code', response.data.content);
                    }else{
                        $('#id').val('');
                        $('.summernote').summernote('code','');
                    }
                    
                }
            });
        }
    });
    </script>
@endsection
