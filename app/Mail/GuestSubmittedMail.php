<?php

namespace App\Mail;

use App\Models\Card;
use App\Models\CardSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuestSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Card $card, public CardSubmission $submission)
    {
        $this->submission->load('values.field');
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'New Response — ' . $this->card->title);
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.guest-submitted');
    }

    public function attachments(): array { return []; }
}
