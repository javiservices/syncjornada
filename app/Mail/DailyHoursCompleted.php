<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyHoursCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public float $hoursWorked,
        public float $expectedHours
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Jornada Completa - SyncJornada',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.daily-hours-completed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
