<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Application;
use App\Mail\ApplicationCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Queueable;
    public Application $application;

    
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $manager = User::find(1);

        Mail::to($manager)->send(new ApplicationCreated($this->application));


    }
}
