<?php

namespace App\Jobs;

use App\EmailReset;
use App\Mail\ForgotPasswordMail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $emailReset;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EmailReset $emailReset)
    {
        //
        $this->emailReset=$emailReset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $reset_link=$this->emailReset->url_path.'/'.$this->emailReset->hash;
        Mail::to($this->emailReset->email)->send(new ForgotPasswordMail($reset_link));
    }
}
