<?php

namespace App\Mail;

use App\Models\VacationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VacationRequestReviewed extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public VacationRequest $vacationRequest
    ) {}

    public function envelope(): Envelope
    {
        $status = $this->vacationRequest->status === 'approved' ? 'Aprobada' : 'Rechazada';
        
        return new Envelope(
            subject: "Solicitud de Vacaciones {$status}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vacation-reviewed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
