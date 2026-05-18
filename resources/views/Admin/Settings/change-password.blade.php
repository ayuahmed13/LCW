@extends('Admin.Layouts.layout')
@section('css')
<style>
    .pass-show {
        position: absolute;
        top: 4px;
        font-size: 16px;
        right: 15px;
        cursor: pointer;
    }

    .input-box {
        position: relative;
    }
</style>
@endsection
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Change Password</h4>
                    </div>
                    <div class="card department-card">
                        <div class="card-body">

                            <form action="{{ url('/admin/change-password') }}" method="post" id="changePasswordForm">
                                @csrf
                                <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="email" class="form-label">Old Password</label>
                                        <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter Old Address">
                                        @if($errors->has('old_password'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('old_password')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="mobile" class="form-label">New Password</label>
                                        <div class="input-box">
                                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password">
                                            <div class="pass-show" data-control="new_password"><i class="fa fa-eye"></i></div>
                                        </div>
                                        @if($errors->has('new_password'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('new_password')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <label for="address" class="form-label">Confirm Password</label>
                                        <div class="input-box">
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" />
                                            <div class="pass-show" data-control="confirm_password"><i class="fa fa-eye"></i></div>
                                        </div>
                                        @if($errors->has('confirm_password'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('confirm_password')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" name="contact_settings" id="submit_btn" class="btn btn-success"> Submit </button>
                                <button type="reset" class="btn btn-danger"> Cancel </button>

                            </form>
                        </div>
                    </div> <!-- end card-body -->
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
@endsection

@section('script')
<script>
    $(".setting").addClass("menuitem-active");
    $(".change-password").addClass("menuitem-active");
</script>

<script>
    $(".pass-show").on('click', function() {
        var passwordId = $(this).attr('data-control');

        if (passwordId.attr("type") === "password") {
            passwordId.attr("type", "text");
            $(this).find("i").removeClass("fa-eye")
            $(this).find("i").addClass("fa-eye-slash")
        } else {
            passwordId.attr("type", "password");
            $(this).find("i").addClass("fa-eye")
            $(this).find("i").removeClass("fa-eye-slash")
        }
    })
</script>
@endsection