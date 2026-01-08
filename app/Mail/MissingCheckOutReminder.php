<?php

namespace App\Mail;

use App\Models\User;
use App\Models\TimeEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MissingCheckOutReminder extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public TimeEntry $timeEntry
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recordatorio: Falta registrar salida',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.missing-checkout-reminder',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
