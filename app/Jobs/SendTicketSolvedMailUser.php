<?php

namespace App\Jobs;

use App\Mail\UserTicketSolvedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTicketSolvedMailUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     */
    public function __construct($userDetails)
    {
        $this->details = $userDetails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new UserTicketSolvedMail();
        Mail::to($this->details['email'])->send($email);
    }
}
