<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail; // <--- Extend this
use Illuminate\Notifications\Messages\MailMessage; // Import MailMessage

// Add "implements ShouldQueue" to make it run in the background
class QueuedVerifyEmail extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    // You don't need to add anything else! 
    // It inherits all the logic (URL generation, message building) 
    // from the parent VerifyEmail class.
    public function toMail($notifiable)
    {
        // 1. Generate the signed Verification URL (using parent logic)
        $url = $this->verificationUrl($notifiable);

        // 2. Return a MailMessage pointing to your custom view
        return (new MailMessage)
            ->subject('Verify Your Email Address - Nady Positions')
            ->view('mail.verify-email', [
                'url'  => $url,
                'user' => $notifiable
            ]);
    }
}