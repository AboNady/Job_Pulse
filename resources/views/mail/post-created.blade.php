<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Post is Live</title>
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

        /* Job Card "Glass" Look */
        .job-card {
            background-color: #1a1a1a; 
            border: 1px solid #333; 
            border-radius: 12px; 
            padding: 0; 
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .job-row {
            padding: 15px 20px;
            border-bottom: 1px solid #333;
        }
        .job-row:last-child { border-bottom: none; }

        .label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 4px;
            display: block;
        }
        
        .value {
            font-size: 15px;
            color: #fff;
            font-weight: 500;
        }
        
        .value-highlight { color: #60a5fa; } /* Blue-400 */

        /* Button */
        .btn { display: inline-block; background-color: #2563eb; color: #ffffff !important; padding: 14px 32px; border-radius: 12px; font-weight: 600; font-size: 16px; transition: background 0.3s; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3); }
        .btn:hover { background-color: #1d4ed8; }

        /* Status Badge */
        .badge {
            display: inline-block;
            background-color: rgba(16, 185, 129, 0.1); 
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 20px;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <br><br>
        <div class="content">
            
            {{-- Header / Logo Area --}}
            <div class="header">
                 <span style="font-size: 20px; font-weight: 800; tracking: -1px; color: white;">
                    <span style="display:inline-block; width:10px; height:10px; background-color:#3b82f6; margin-right:5px;"></span>
                    PIXEL POSITIONS
                 </span>
            </div>

            {{-- Main Content --}}
            <div class="body">
                
                <div style="text-align: center;">
                    <span class="badge">● Active & Public</span>
                    <h1>Your Post is Live!</h1>
                    <p style="margin-bottom: 30px;">
                        Great news, {{ $user->name }}. Your listing has been published and is now visible to thousands of developers.
                    </p>
                </div>

                {{-- Job Summary Table --}}
                <div class="job-card">
                    {{-- Title --}}
                    <div class="job-row">
                        <span class="label">Position Title</span>
                        <div class="value">{{ $job->title }}</div>
                    </div>

                    {{-- Company --}}
                    <div class="job-row">
                        <span class="label">Company</span>
                        <div class="value">{{ $job->employer->name }}</div>
                    </div>

                    {{-- Location & Type --}}
                    <div class="job-row">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="50%">
                                    <span class="label">Location</span>
                                    <div class="value">{{ $job->location }}</div>
                                </td>
                                <td width="50%">
                                    <span class="label">Type</span>
                                    <div class="value">{{ $job->type }}</div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    {{-- Salary --}}
                    <div class="job-row">
                        <span class="label">Salary Range</span>
                        <div class="value value-highlight">{{ $job->salary }}</div>
                    </div>
                    
                    {{-- Posted Date --}}
                    <div class="job-row">
                        <span class="label">Posted On</span>
                        <div class="value">{{ $job->created_at->format('M d, Y') }}</div>
                    </div>
                </div>

                <p style="text-align: center; font-size: 14px; color: #888;">
                    You can edit or archive this listing at any time from your dashboard.
                </p>

                {{-- Call to Action --}}
                <div style="text-align: center; margin-top: 30px;">
                    <a href="{{ route('dashboard') }}" class="btn">
                        View Your Listing
                    </a>
                </div>
            </div>

            {{-- Footer --}}
            <div class="footer">
                <p style="margin-bottom: 10px;">© {{ date('Y') }} Pixel Positions.</p>
                <p style="margin: 0;">If you didn't create this post, please contact support immediately.</p>
            </div>

        </div>
    </div>

</body>
</html>