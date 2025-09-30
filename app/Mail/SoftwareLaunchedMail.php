<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Software_Request; 

class SoftwareLaunchedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $requestData; 

    public function __construct(Software_Request $softwareRequest)
    {
        //
         // Controller ကနေပို့လိုက်တဲ့ $request object ကို $this->requestData မှာ ထည့်လိုက်သည်
       $this->requestData = $softwareRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Software Launched Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.job_launched_notification',
            with: [
                // Blade ထဲမှာ 'request' ဆိုတဲ့ နာမည်နဲ့ $requestData အားလုံးကို ပို့လိုက်သည်
                'request' => $this->requestData, 
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
