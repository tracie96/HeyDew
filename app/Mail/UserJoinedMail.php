<?php

namespace App\Mail;

use App\OTP;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserJoinedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,OTP $otp)
    {
        //
        $this->user=$user;
        $this->otp=$otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->from('example@example.com')
            ->view('emails.welcome',['user'=>$this->user,'otp'=>$this->otp->code]);
    }
}
