@section('meta_title') FAQ | LCW @endsection
@extends('Admin.Layouts.layout')
@section('content')

<style>
    .table>:not(caption)>*>* {
        white-space:unset;
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">FAQ's</h4>
                    </div>
                </div>


                <div class="col-4">
                    <div class="card department-card">
                        <div class="card-body">

                            <form name="faqForm" id="faqForm" action="{{ url('admin/faq/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($edit_data->id) ? Crypt::encrypt($edit_data->id) : '' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="question" class="form-label required-field">Question</label>
                                                <input type="text" class="form-control" id="question" name="question" value="{{ !empty($edit_data->question) ? $edit_data->question : '' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-12">
                                                <label for="answer" class="form-label required-field">Answer</label>
                                                <textarea type="text" rows="5" class="form-control summernote" id="answer" name="answer" value="">{{ !empty($edit_data->answer) ? $edit_data->answer : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit" id="btn-submit"> {{ !empty($edit_data) ? 'Update' : 'Submit' }} </button>
                                @if(empty($edit_data)) <a href="{{url('admin/faq')}}" class="btn btn-danger"> Cancel </a> @endif
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
                                        <th width="25%">Question</th>
                                        <th width="50%">Answer</th>
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
        $(".faq").addClass("menuitem-active");
        $(".faq a").addClass("active");

    $(document).ready(function() {
        $('.summernote').summernote({
            height: 160 // set height in pixels
        });
    });
</script>
<script src="{{ asset('controller_js/cn_faq.js') }}"></script>

@endsection