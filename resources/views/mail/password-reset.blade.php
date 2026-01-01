<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* Responsive adjustments */
        @media only screen and (max-width: 600px) {
            .email-container { width: 100% !important; }
            .button { width: 100% !important; text-align: center; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <table role="presentation" class="email-container" width="570" cellspacing="0" cellpadding="0" border="0" style="margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    
                    <tr>
                        <td style="padding: 30px 40px; background-color: #111827; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: 700; letter-spacing: 1px;">
                                <span style="color: #3b82f6;">PIXEL</span> POSITIONS
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #1f2937; font-size: 20px; margin-top: 0; margin-bottom: 20px;">
                                Reset Your Password
                            </h2>
                            
                            <p style="color: #4b5563; font-size: 16px; line-height: 24px; margin-bottom: 20px;">
                                Hello! We received a request to reset the password for your <strong>Pixel Positions</strong> account.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $url }}" target="_blank" style="background-color: #111827; color: #ffffff; padding: 14px 28px; font-size: 16px; font-weight: bold; text-decoration: none; border-radius: 6px; display: inline-block; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #4b5563; font-size: 14px; line-height: 24px; margin-bottom: 0;">
                                This password reset link will expire in <strong>{{ $count }} minutes</strong>.
                            </p>
                            
                            <p style="color: #6b7280; font-size: 14px; line-height: 24px; margin-top: 10px;">
                                If you did not request a password reset, no further action is required.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px 40px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="color: #9ca3af; font-size: 12px; margin: 0;">
                                &copy; {{ date('Y') }} Pixel Positions. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>

                <table role="presentation" width="570" cellspacing="0" cellpadding="0" border="0" style="margin: 20px auto;">
                    <tr>
                        <td style="text-align: center; color: #9ca3af; font-size: 12px; padding: 0 20px;">
                            <p style="margin: 0;">
                                If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
                            </p>
                            <a href="{{ $url }}" style="color: #3b82f6; text-decoration: none; word-break: break-all; display: block; margin-top: 10px;">
                                {{ $url }}
                            </a>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>