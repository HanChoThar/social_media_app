<?php

namespace App\Services\NotificationServices;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailNotification extends Mailable implements NotificationInterface
{
    public $toEmail;
    public $subject;
    public $message;
    public $template;

    public function __construct($to, $subject, $message, $template)
    {
        $this->toEmail = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->template = $template;
    }

    public function build()
    {
        return $this->to($this->toEmail)
        ->subject($this->subject)
        ->view($this->template) 
        ->with(['userName' => $this->message]);
    }

    public function sendNotification()
    {
        Mail::to($this->toEmail)->send($this);
    }
}