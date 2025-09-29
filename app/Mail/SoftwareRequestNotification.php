<?php

namespace App\Mail;

// ❗️ 1. သင့် Model ကို use လုပ်ပါ (ပိုကောင်းတဲ့ practice ပါ)
use App\Models\Software_Request; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SoftwareRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The software request instance.
     *
     * @var \App\Models\Software_Request
     */
    // ❗️ 2. Variable name ကို ပိုပြီး συγκεκριအောင်ပေးပါ (ဥပမာ: $softwareRequest)
    public $softwareRequest;

    /**
     * Create a new message instance.
     */
    // ❗️ 3. Constructor မှာ Model ကို Type-hint လုပ်ပါ
    public function __construct(Software_Request $softwareRequest)
    {
        $this->softwareRequest = $softwareRequest;
    }

    /**
     * Get the message envelope.
     * ❗️ 4. 'build()' အစား 'envelope()' ကိုသုံးပါ
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Software Request Submitted - Ticket: ' . $this->softwareRequest->ticket_id,
        );
    }

    /**
     * Get the message content definition.
     * ❗️ 5. View အတွက် 'content()' ကိုသုံးပါ
     */
    public function content(): Content
    {
        // ဒီနေရာမှာ with() မလိုတော့ပါဘူး။ public property က data ကို အလိုအလျောက် ပို့ပေးပါတယ်
        return new Content(
            view: 'emails.software_request_notification',
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