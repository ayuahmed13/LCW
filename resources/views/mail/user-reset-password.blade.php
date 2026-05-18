<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Your Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f7fa; margin: 0; padding: 0;">

  <div style="max-width: 600px; margin: 40px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
    
    <h2 style="color: #333333; margin-top: 0;">Password Reset Request</h2>

    <p style="color: #555555; line-height: 1.6;">Hello,</p>

    <p style="color: #555555; line-height: 1.6;">
      You recently requested to reset your password for your account. Click the button below to reset it:
    </p>

    <a href="{{ url('reset-password-form/'.$mailData['token']) }}"
       style="display: inline-block; margin-top: 20px; padding: 12px 20px; background-color: #007BFF; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
      Reset Password
    </a>

    <p style="color: #555555; line-height: 1.6; margin-top: 20px;">
      If you did not request a password reset, please ignore this email or contact support if you have questions.
    </p>

    <p style="font-size: 12px; color: #999999; margin-top: 30px; line-height: 1.4;">
      This link will expire in 24 hours.<br>
      If you're having trouble clicking the button, copy and paste the URL into your browser:<br>
      <span style="word-break: break-all;">
        {{ url('reset-password-form/'.$mailData['token']) }}
      </span>
    </p>

  </div>

</body>
</html>
