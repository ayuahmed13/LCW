@section('meta-header')
@section('title', !empty($metadata->meta_title) ? $metadata->meta_title : 'LCW Lighting')
@section('meta_description', !empty($metadata->meta_description) ? $metadata->meta_description : '')
@section('meta_keywords', !empty($metadata->meta_keyword) ? $metadata->meta_keyword : '')
@include ("Front.includes.header")

        <!-- page-title -->
        <div class="page-title" style="background-image: url(images/section/page-title.jpg); background-color:#f4f3ee">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Login</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li>
                                <a class="link" href="{{ url('') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Login
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
                            <h4>Login</h4>
                        </div>
                        <form id="login-form" action="{{url('user-login-action')}}" method="post" class="form-login form-has-password">
                            @csrf
                            <div class="wrap">
                                <fieldset class="">
                                    <input class="" type="email" placeholder="Email Address*" name="email" tabindex="2" aria-required="true" >
                                </fieldset>
                                <fieldset class="position-relative password-item">
                                    <input class="input-password" type="password" placeholder="Password*" name="password" tabindex="2" aria-required="true" >
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide-line"></i>
                                    </span>
                                </fieldset>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="tf-cart-checkbox">
                                        <div class="tf-checkbox-wrapp">
                                            <input class="" type="checkbox" id="login-form_agree" name="agree_checkbox">
                                            <div>
                                                <i class="icon-check"></i>
                                            </div>
                                        </div>
                                        <label for="login-form_agree" class="text-black fw-medium">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="{{ url('reset-password') }}" class="font-2 text-button forget-password link">Forgot Your Password?</a>
                                </div>
                            </div>
                            <div class="button-submit">
                                <button class="tf-btn btn-fill" type="submit">
                                    <span class="text text-button">Login</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="right">
                        <h4 class="mb_8">New Customer</h4>
                        <p class="text-secondary">Be part of our growing family of new customers! Join us today and unlock a world of exclusive benefits, offers, and personalized experiences.</p>
                        <a href="{{ url('register') }}" class="tf-btn btn-fill"><span class="text text-button">Register</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /login -->

<script>
  $(document).ready(function() {
    // Initialize form validation
    
    // Optional: Toggle password visibility
    $('.toggle-password').click(function() {
      var passwordField = $(this).prev('input');
      var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
      passwordField.attr('type', type);
      $(this).find('i').toggleClass('icon-eye-show-line icon-eye-hide-line');
    });
  });
</script>

        @include ("Front.includes.footer")

<script>
$(document).ready(function () {
     $.validator.addMethod("customEmail", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
            }, "Please enter a valid email address.");

    $("#login-form").validate({
        rules: {
            email: {
                required: true,
                customEmail: true
            },
            password: {
                required: true,
                //minlength: 6
            }
        },
        messages: {
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please enter your password",
                minlength: "Password must be at least 6 characters long"
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
            
        },
        errorClass: "text-danger", // Adding a class to the error messages
        submitHandler: function(form) {
            $("#btn-submit").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
            form.submit(); // Proceed with form submission
        }
    });
});
</script>