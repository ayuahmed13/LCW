@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ('Front.includes.header')

<style>
    .tf-btn.btn-reset:hover {
        background-color: #064953 !important;
    }

    .tf-btn:not(.btn-reset):hover {
        color: #fff;
        background-color: #064953;
    }

    .tf-btn:not(.btn-reset):hover::after,
    .tf-btn:not(.btn-reset):after {
        display: none;
    }
</style>

<!-- page-title -->
<div class="page-title" style="background-image: url(images/section/page-title.jpg); background-color:#f4f3ee">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">Create An Account</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ url('') }}">Home</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>
                        Register
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- login -->
<section class="flat-spacing">
    <div class="container">
        <div class="login-wrap">
            <div class="left">
                <div class="heading">
                    <h4>Register</h4>
                </div>
                <form name="regForm" id="regForm" method="post" action="{{url('register-action')}}" class="form-login form-has-password">
                    @csrf
                    <input type="hidden" id="redirect_to" name="redirect_to" value="{{!empty($_GET['red'])?$_GET['red']:''}}">
                    <div class="wrap">
                        <fieldset><input type="text" placeholder="Name*" name="name" ></fieldset>
                        <fieldset><input type="email" placeholder="Email Address*" name="email" id="email"  ></fieldset>
                        <fieldset class="position-relative password-item">
                            <input class="input-password" type="password" placeholder="Password*" name="password"
                                >
                            <span class="toggle-password unshow"><i class="icon-eye-hide-line"></i></span>
                        </fieldset>
                        <fieldset class="position-relative password-item">
                            <input class="input-password" type="password" placeholder="Confirm Password*"
                                name="confirm_password" >
                            <span class="toggle-password unshow"><i class="icon-eye-hide-line"></i></span>
                        </fieldset>

                        <div class="d-flex align-items-start flex-column">
                            <div class="tf-cart-checkbox">
                                <div class="tf-checkbox-wrapp">
                                    <input type="checkbox" id="login-form_agree" name="agree_checkbox">
                                    <div><i class="icon-check"></i></div>
                                </div>
                                
                                
                                <p style="color: black !important" for="login-form_agree">I agree to the&nbsp;<a class="fw-bold" href="{{ url('terms-conditions') }}">Terms & Condition</a> and <a class="fw-bold" href="{{ url('privacy-policy') }}">Privacy Policy</a></p>
                            </div>
                            </div>
                        
                    </div>
                    <div class="button-submit">
                        <button class="tf-btn btn-fill" type="submit" id="btn-submit">
                            <span class="text text-button" id="btn-submit-span">Register</span>
                        </button>
                    </div>
                </form>

                <!-- OTP Modal -->
                <div id="otpModal"
                    style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background-color:rgba(0,0,0,0.7); justify-content:center; align-items:center; z-index:9999;">
                    <div
                        style="background:#fff; padding:30px; border-radius:10px; text-align:center; max-width:450px; width:100%;">
                        <form name="otpForm" id="otpForm" method="post">    
                        @csrf
                        <input type="hidden" name="uid" id="uid" value="">
                        <h5>Enter OTP</h5>
                        <p class="text-center">A verification code has been sent to your register 
Email Address, Please check and enter it here.</p>
                        <div class="otp-inputs d-flex gap-2 justify-content-center my-3">
                            <input name="otp[]" type="text" maxlength="1" class="otp-box" id="otp1"
                                oninput="moveToNext(this, 'otp2')" required>
                            <input name="otp[]" type="text" maxlength="1" class="otp-box" id="otp2"
                                oninput="moveToNext(this, 'otp3')" required>
                            <input name="otp[]" type="text" maxlength="1" class="otp-box" id="otp3"
                                oninput="moveToNext(this, 'otp4')" required>
                            <input name="otp[]" type="text" maxlength="1" class="otp-box" id="otp4"
                                oninput="moveToNext(this, 'otp5')" required>
                            <input name="otp[]" type="text" maxlength="1" class="otp-box" id="otp5"
                                oninput="moveToNext(this, 'otp6')" required>
                            <input name="otp[]" type="text" maxlength="1" class="otp-box" id="otp6" required>
                        </div>
                        <div class="button-submit">
                            <button class="tf-btn btn-fill py-2" type="button" id="verify-otp-btn">
                                <span class="text text-button">Verify OTP</span>
                            </button>
                        </div>
                        <p class="mt-2 fw-bold text-center" id="otp-timer" style="cursor: pointer">00:45</p>
                        <p class="mt-2 fw-bold hide" id="resend-otp" style="cursor: pointer;display:none!important">Resend OTP</p>
                        </form>
                    </div>
                </div>

            </div>
            <div class="right">
                <h4 class="mb_8">Already have an account?</h4>
                <p class="text-secondary">Welcome back. Sign in to access your personalized experience, saved
                    preferences, and more. We're thrilled to have you with us again!</p>
                <a href="{{ url('login') }}" class="tf-btn btn-fill"><span class="text text-button">Login</span></a>
            </div>
        </div>
    </div>
</section>
<!-- /login -->

@include ('Front.includes.footer')
<script>
    function openOtpModal(event) {
        event.preventDefault();
        document.getElementById('otpModal').style.display = 'flex';
        return false;
    }

    function closeOtpModal() {
        document.getElementById('otpModal').style.display = 'none';
    }

    function moveToNext(current, nextFieldID) {
        if (current.value.length >= 1) {
            document.getElementById(nextFieldID)?.focus();
        }
    }
    // Handle backspace navigation
    document.querySelectorAll('.otp-box').forEach((input, index, inputs) => {
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && input.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });

        // Optional: restrict to numeric input only
        input.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
</script>
<script>
var base_url = $('#base_url').val();
$(document).ready(function () {
      $.validator.addMethod("customEmail", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
            }, "Please enter a valid email address.");

    $("#regForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                customEmail: true
            },
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                equalTo: "[name='password']"
            },
            agree_checkbox: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 2 characters"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
                remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'post',
                            url: base_url + '/check-user-email-exists',
                            data: {
                                email: function() {
                                    return $("#email").val(); // Get the value of country_name field
                                },
                                id: function () {
                                    return $('#id').val()
                                }
                            },
                            dataType: 'json'
                        }
            },
            password: {
                required: "Please enter a password",
                minlength: "Password must be at least 6 characters"
            },
            confirm_password: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            },
            agree_checkbox: {
                required: "You must agree to the terms"
            }
        },
        errorElement: "div",
        errorClass: "text-danger",
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function(error, element) {
            if (element.attr("type") == "checkbox") {
                error.insertAfter(element.closest('.tf-cart-checkbox'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form, event) {
            var formData = $(form).serialize(); // Serialize form data

            $.ajax({
                url: $(form).attr('action'), // Your form's action URL
                type: $(form).attr('method') || 'POST', // Use method defined on form or default to POST
                data: formData,
                beforeSend:function(){
                    $('#btn-submit').attr('disabled',true);
                    $('#btn-submit-span').html('Please wait');
                },
                success: function (response) {
                    if(response.status==true){
                        toastr.success(response.message);
                        $('#uid').val(response.uid);
                        document.getElementById('otpModal').style.display = 'flex';
                        let timeLeft = 45;
                        const timerInterval = setInterval(function() {
                        timeLeft--;
                        $('#otp-timer').text('00:'+timeLeft);
                        
                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            $('#otp-timer').text("00:00");
                            $('#resend-otp').show();
                        }
                        }, 1000);
                        
                    }else{
                        toastr.error(response.message);
                        $('#btn-submit').attr('disabled',false);
                        $('#btn-submit-span').html('Register');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    toastr.error(error);
                    $('#btn-submit').attr('disabled',false);
                    $('#btn-submit-span').html('Register');
                }
            });
        }
    });
});
</script>

<script>
    $('#verify-otp-btn').click(function (e) { 
        let otp = '';
        for (let i = 1; i <= 6; i++) {
            otp += $('#otp' + i).val();
        }
        if (otp.length === 6) {
            var uid = $('#uid').val();
            var email = $('#email').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#otpForm input[name="_token"]').val()
                },
                type: "post",
                url: base_url + "/verify-otp",
                data: {uid:uid,otp:otp,email:email},
                dataType: "json",
                beforeSend:function(){
                    $('#verify-otp-btn').html('Verifying please wait...').attr('disabled',true)
                },
                success: function (response) {
                    if(response.status==true){
                        toastr.success(response.message);
                        setTimeout(function() {
                        let redirect_to = $('#redirect_to').val();
                        if(redirect_to!=''){
                            window.location.href = "{{url('/');}}"+"/"+redirect_to;
                        }else{
                            window.location.href = "login";
                        }
                        }, 4000); // 4000 milliseconds = 4 seconds
                    }else{
                        toastr.error(response.message);

                        $('#verify-otp-btn').html('Verify').attr('disabled',false)
                    }
                }
            });
        } else {
            console.log('Invalid OTP. It must be exactly 6 digits.');
            toastr.error('Invalid OTP. It must be exactly 6 digits.');      }
    });
</script>
<script>
  $('#resend-otp').click(function (e) { 
    var email = $('#email').val();
    if(email!=''){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#otpForm input[name="_token"]').val()
            },
            type: "post",
            url: base_url +"/resend-otp",
            data: {email:email},
            dataType: "json",
            beforeSend:function(){
                $('#resend-otp').html('Sending OTP please wait...').attr('disabled',true);
            },
            success: function (response, textStatus, jqXHR) {
                toastr.success('OTP sent successfully.');
                $('#resend-otp').hide();
                let timeLeft = 45;
                        const timerInterval = setInterval(function() {
                        timeLeft--;
                        $('#otp-timer').text('00:'+timeLeft);
                        
                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            $('#otp-timer').text("00:00");
                            $('#resend-otp').html('Resend OTP').show();
                        }
                        }, 1000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.table(jqXHR)
                $('#resend-otp').html('Resend OTP').attr('disabled',false);
                toastr.error('Something went wrong.');
            }
        });
    }
    
  });
</script>
