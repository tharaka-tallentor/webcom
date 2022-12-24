<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignupEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($data)
    {
        $this->email_data = $data;
    }

    public function build()
    {
        return $this->from(env('MAIL_USERNAME'), 'WebCom')->subject("Welcome to Webcom")->view('mail.signup-mail', ['email_data' => $this->email_data]);
    }


    public function attachments()
    {
        return [];
    }
}
