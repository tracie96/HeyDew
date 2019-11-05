<?php

namespace App\Jobs;

use App\Mail\UserJoinedMail;
use App\OTP;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserJoinedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user=$user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $otp=new OTP([
            'code'=>rand(1000,9999),
            'email'=>$this->user->email,
            'user_id'=>$this->user->id,
            'key_1'=>Hash::make($this->user->email),
            'key_2'=>Hash::make($this->user->id)
        ]);
        $otp->save();

        Mail::to($this->user->email)->send(new UserJoinedMail($this->user,$otp));

    }
}
