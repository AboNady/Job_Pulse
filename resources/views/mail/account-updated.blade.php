<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Updated</title>
    <style>
        /* Reset & Basics */
        body { margin: 0; padding: 0; min-width: 100%; font-family: 'Hanken Grotesk', Arial, sans-serif; background-color: #000000; color: #ffffff; }
        a { text-decoration: none; }

        /* Dark Theme Utilities */
        .wrapper { width: 100%; table-layout: fixed; background-color: #000000; padding-bottom: 40px; }
        .content { max-width: 600px; margin: 0 auto; background-color: #111111; border: 1px solid #333333; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.5); }
        .header { padding: 40px 40px 20px 40px; text-align: center; border-bottom: 1px solid #222; }
        .body { padding: 40px; }
        .footer { padding: 20px; text-align: center; color: #666666; font-size: 12px; background-color: #0a0a0a; border-top: 1px solid #222; }

        /* Typography */
        h1 { margin: 0 0 15px 0; font-size: 24px; font-weight: bold; color: #ffffff; letter-spacing: -0.5px; }
        p { margin: 0 0 20px 0; font-size: 16px; line-height: 1.6; color: #cccccc; }
        
        /* Details Card (Glass Look) */
        .details-card {
            background-color: #1a1a1a; 
            border: 1px solid #333; 
            border-radius: 12px; 
            padding: 0; 
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .row { padding: 15px 20px; border-bottom: 1px solid #333; }
        .row:last-child { border-bottom: none; }
        
        .label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #666; display: block; margin-bottom: 4px; }
        .value { font-size: 15px; color: #fff; font-weight: 500; }

        /* Security Box (Red Accent) */
        .security-box { 
            background-color: rgba(220, 38, 38, 0.08); /* Red-600 with low opacity */
            border: 1px solid rgba(220, 38, 38, 0.2); 
            padding: 20px; 
            border-radius: 12px; 
            margin-bottom: 25px; 
            text-align: left;
        }
        .security-title { color: #f87171; font-weight: bold; font-size: 14px; margin-bottom: 5px; display: block; }
        .security-text { color: #fca5a5; font-size: 13px; margin: 0; line-height: 1.5; }

        /* Button */
        .btn { display: inline-block; background-color: #2563eb; color: #ffffff !important; padding: 14px 32px; border-radius: 12px; font-weight: 600; font-size: 16px; transition: background 0.3s; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3); }
        .btn:hover { background-color: #1d4ed8; }
        
        .link-subtle { color: #60a5fa; font-size: 13px; text-decoration: underline; }
    </style>
</head>
<body>

    <div class="wrapper">
        <br><br>
        <div class="content">
            
            {{-- Header --}}
            <div class="header">
                 <span style="font-size: 20px; font-weight: 800; tracking: -1px; color: white;">
                    <span style="display:inline-block; width:10px; height:10px; background-color:#3b82f6; margin-right:5px; border-radius: 2px;"></span>
                    PIXEL POSITIONS
                 </span>
            </div>

            {{-- Main Body --}}
            <div class="body">
                
                <div style="text-align: center;">
                    <h1>Account Updated</h1>
                    <p>
                        Hello {{ $user->name }}, we wanted to let you know that your account details were recently modified.
                    </p>
                </div>

                {{-- Structured Details Card --}}
                <div class="details-card">
                    {{-- Company Name --}}
                    <div class="row">
                        <span class="label">Organization Account</span>
                        <div class="value">{{ $user->employer->name ?? 'Personal Account' }}</div>
                    </div>

                    {{-- Timestamp --}}
                    <div class="row">
                        <span class="label">Date of Change</span>
                        <div class="value">{{ now()->format('F j, Y — g:i A') }}</div>
                    </div>
                </div>

                {{-- Security Warning --}}
                <div class="security-box">
                    <span class="security-title">⚠️ Security Notice</span>
                    <p class="security-text">
                        If you made this change, no further action is required. <br>
                        However, if you <strong>did not</strong> authorize this update, please lock your account immediately by resetting your password.
                    </p>
                </div>

                {{-- Actions --}}
                <div style="text-align: center; margin-bottom: 10px;">
                    <a href="{{ route('user.settings') }}" class="btn">
                        Review Activity
                    </a>
                </div>
                
                <div style="text-align: center; margin-top: 20px;">
                    <a href="mailto:support@pixelpositions.com" class="link-subtle">Contact Support</a>
                </div>

            </div>

            {{-- Footer --}}
            <div class="footer">
                <p style="margin-bottom: 10px;">© {{ date('Y') }} Nady Pixel Positions.</p>
                <p style="margin: 0;">Automated Security Notification.</p>
            </div>

        </div>
    </div>

</body>
</html>