<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    // 1. Define a public property for the user
    public User $user;
    public Job $job;

    // 2. Accept the user in the constructor
    public function __construct(User $user, Job $job)
    {
        $this->user = $user;
        $this->job = $job;

    }

    // 3. Define the subject line
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your post is now live!',
        );
    }

    // 4. Point to the view (we will create this in the next step)
    public function content(): Content
    {
        return new Content(
            view: 'mail.post-created',
        );
    }
}