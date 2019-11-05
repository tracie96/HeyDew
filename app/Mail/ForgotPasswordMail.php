<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    private $reset_url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reset_url)
    {
        //
        $this->reset_url=$reset_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
            ->view('emails.forgotpassword',['reset_url'=>$this->reset_url]);
    }


}
