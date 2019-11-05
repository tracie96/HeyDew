<?php

namespace App\Jobs;

use App\Mail\SampleEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $email_object;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$email_object)
    {
        //
        $this->user=$user;
        $this->email_object=$email_object;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->user)
//            ->cc($moreUsers)
//            ->bcc($evenMoreUsers)
            ->send($this->email_object);

    }

}
