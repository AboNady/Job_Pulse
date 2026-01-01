<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email Address</title>
    <style>
        /* Reset & Basics */
        body { margin: 0; padding: 0; min-width: 100%; font-family: 'Hanken Grotesk', Arial, sans-serif; background-color: #000000; color: #ffffff; }
        a { text-decoration: none; }

        /* Dark Theme Utilities */
        .wrapper { width: 100%; table-layout: fixed; background-color: #000000; padding-bottom: 40px; }
        .content { max-width: 600px; margin: 0 auto; background-color: #111111; border: 1px solid #333333; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.5); }
        .header { padding: 40px 40px 20px 40px; text-align: center; border-bottom: 1px solid #222; }
        .body { padding: 40px; text-align: center; } /* Centered text for verification feels better */
        .footer { padding: 20px; text-align: center; color: #666666; font-size: 12px; background-color: #0a0a0a; border-top: 1px solid #222; }

        /* Typography */
        h1 { margin: 0 0 15px 0; font-size: 24px; font-weight: bold; color: #ffffff; letter-spacing: -0.5px; }
        p { margin: 0 0 20px 0; font-size: 16px; line-height: 1.6; color: #cccccc; }
        
        /* Button */
        .btn { display: inline-block; background-color: #2563eb; color: #ffffff !important; padding: 14px 32px; border-radius: 12px; font-weight: 600; font-size: 16px; transition: background 0.3s; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3); }
        .btn:hover { background-color: #1d4ed8; }
        
        .divider { height: 1px; background-color: #333; margin: 30px 0; }
        .sub-text { font-size: 13px; color: #666; word-break: break-all; }
    </style>
</head>
<body>

    <div class="wrapper">
        <br><br>
        <div class="content">
            
            {{-- Header --}}
            <div class="header">
                 <span style="font-size: 20px; font-weight: 800; tracking: -1px; color: white;">
                    <span style="display:inline-block; width:10px; height:10px; background-color:#3b82f6; margin-right:5px;"></span>
                    PIXEL POSITIONS
                 </span>
            </div>

            {{-- Main Body --}}
            <div class="body">
                
                <h1>Verify Your Email Address</h1>
                
                <p>
                    Hello {{ $user->name }}, thanks for signing up! <br>
                    Please click the button below to verify your email address and activate your account.
                </p>

                {{-- Call to Action --}}
                <div style="margin-top: 30px; margin-bottom: 30px;">
                    <a href="{{ $url }}" class="btn">
                        Verify Email Address
                    </a>
                </div>

                <p style="font-size: 14px; color: #888;">
                    If you did not create an account, no further action is required.
                </p>

                {{-- Fallback Link --}}
                <div class="divider"></div>
                <p class="sub-text">
                    If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
                    <br><br>
                    <a href="{{ $url }}" style="color: #3b82f6;">{{ $url }}</a>
                </p>

            </div>

            {{-- Footer --}}
            <div class="footer">
                <p style="margin-bottom: 10px;">© {{ date('Y') }} Nady Positions.</p>
            </div>

        </div>
    </div>

</body>
</html>