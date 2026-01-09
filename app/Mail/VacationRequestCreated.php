<?php

namespace App\Mail;

use App\Models\VacationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VacationRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public VacationRequest $vacationRequest
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Solicitud de Vacaciones',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vacation-requested',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
