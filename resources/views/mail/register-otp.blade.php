<!DOCTYPE html>
<html>
<head>
    <title>LCW Registration OTP Mail</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 40px;">
                    <tr>
                        <td align="center" style="padding-bottom: 30px;">
                            <h1 style="color: #333333; font-size: 28px;">Welcome to LCW</h1>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <p style="font-size: 18px; color: #555;">Use the following OTP to complete your registration:</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px; background-color: #f0f8ff; border-radius: 8px;">
                            <span style="font-size: 32px; font-weight: bold; color: #007BFF;">{{ $data['otp'] }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-top: 30px;">
                            <p style="font-size: 14px; color: #999;">This OTP is valid for a limited time only.</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-top: 20px;">
                            <p style="font-size: 16px; color: #333;">Thank you for joining LCW!</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-top: 20px; font-size: 12px; color: #bbb;">
                            <em>Do not share this OTP with anyone.</em>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
