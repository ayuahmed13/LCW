<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
</head>
<body style="background-color: #f5f7fa; font-family: Arial, sans-serif; margin: 0; padding: 0;">

  <div style="max-width: 400px; margin: 60px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2 style="margin-top: 0; color: #333333;">LCW Reset Your Password</h2>

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{url('submit-user-reset-password-form')}}" method="post">
      @csrf
      <!-- Hidden token field -->
       <input type="hidden" name="token" value="{{!empty($token)?$token:''}}">

      <label for="password" style="display: block; margin-top: 20px; color: #333333;">Email</label>
      <input type="email" id="email" name="email" 
             style="width: 100%; padding: 10px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px;">

      <!-- New password -->
      <label for="password" style="display: block; margin-top: 20px; color: #333333;">New Password</label>
      <input type="password" id="password" name="password" 
             style="width: 100%; padding: 10px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px;">

      <!-- Confirm password -->
      <label for="confirm_password" style="display: block; margin-top: 20px; color: #333333;">Confirm Password</label>
      <input type="password" id="confirm_password" name="confirm_password" 
             style="width: 100%; padding: 10px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px;">

      <!-- Submit -->
      <button type="submit"
              style="width: 100%; padding: 12px; background-color: #000000; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;margin-top:20px">
        Reset Password
      </button>

    </form>

    <p style="font-size: 12px; color: #999999; margin-top: 20px;">
      If you did not request this change, please ignore this form.
    </p>
  </div>
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Validation Js -->
<script src="{{ URL::asset('package_assets/libs/validation/validate.min.js') }}"></script>

<script>
$(document).ready(function() {
  $("form").validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      },
      confirm_password: {
        required: true,
        minlength: 6,
        equalTo: "#password"
      }
    },
    messages: {
      email: {
        required: "Please enter your email",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please enter a new password",
        minlength: "Your password must be at least 6 characters long"
      },
      confirm_password: {
        required: "Please confirm your new password",
        equalTo: "Passwords do not match",
        minlength: "Your password must be at least 6 characters long"

      }
    },
    errorElement: "div",
    errorPlacement: function(error, element) {
      error.css('color', 'red');
      error.insertAfter(element);
    },
    submitHandler: function(form) {
      // Disable the submit button and change text
      var $submitBtn = $(form).find('button[type="submit"]');
      $submitBtn.prop('disabled', true);
      $submitBtn.text('Please Wait...');

      // Submit the form
      form.submit();
    }
  });
});
</script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
    }

    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif

    @if(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}");
    @endif

    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @endif
</script>

<script>
    function success_toast(title = '', message = '') {
        toastr.success(message);
    }

    function error_toast(title = '', message = '') {
        toastr.error(message);
    }
</script>
</body>
</html>
