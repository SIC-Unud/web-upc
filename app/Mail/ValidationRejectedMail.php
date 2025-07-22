<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ValidationRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $competition;
    public $no_registration;
    public $reject_message;

    public function __construct($competition, $no_registration, $reject_message)
    {
        $this->competition = $competition;
        $this->no_registration = $no_registration;
        $this->reject_message = $reject_message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'UPC 2025 || Validasi Berkas Ditolak',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.validation_rejected',
            with: [
                'competition' => $this->competition,
                'no_registration' => $this->no_registration,
                'reject_message' => $this->reject_message
            ]
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
