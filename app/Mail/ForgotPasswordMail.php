<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $getOtp)
    {
        $this->user = $user;
        $this->getotp = $getOtp;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $getOtpFromController = $this->getotp;
        return $this->subject('Mail from SparkOut Tech Solutions')->view('forgot-mail',compact('getOtpFromController'));
        
    }
}
