<?php

namespace App\Jobs;

use App\Mail\AdminNewReportMail;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewReportMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public $ticketid;

    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
        $this->ticketid = $details['ticketid'];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $details = [
            'ticketid' => $this->ticketid
        ];

        // Create email instance with all necessary details
        $email = new AdminNewReportMail($details);

        // Send email
        Mail::to($this->details['email'])->send($email);
    }
}
