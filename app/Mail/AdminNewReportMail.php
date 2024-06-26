<?php

namespace App\Mail;

use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNewReportMail extends Mailable
{
    use Queueable, SerializesModels;
    public $ticketid;
    public $report;
    public $file;
    public $filename;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->ticketid = $details['ticketid'];
        $ticket = Ticket::where('id',$this->ticketid)->first();
        $this->report = $ticket->report;
        $data = [
            'report'=>$ticket->report,
        ];
        $pdf = Pdf::loadView('pdf.ic_report', $data);
        $this->file = $pdf->output();

        $this->filename = 'report_'.$ticket->report->report_number.'.pdf';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Report Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin.new_report',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->file, $this->filename)
                ->withMime('application/pdf'),
        ];
    }
}
