<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyRequestReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $requestModel;

    public function __construct($requestModel)
    {
        $this->requestModel = $requestModel;
    }

    public function build()
    {
        return $this->subject('Hemos recibido su solicitud')
            ->view('emails.company-request-received');
    }
}
