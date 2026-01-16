<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyRequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $user;
    public $password;
    public $resetUrl;

    public function __construct($company, $user, $password, $resetUrl)
    {
        $this->company = $company;
        $this->user = $user;
        $this->password = $password;
        $this->resetUrl = $resetUrl;
    }

    public function build()
    {
        return $this->subject('Su empresa ha sido aprobada')
            ->view('emails.company-request-approved');
    }
}
