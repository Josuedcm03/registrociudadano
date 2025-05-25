<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CitizensReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $groupedCitizens;

    /**
     * Create a new message instance.
     */
    public function __construct($groupedCitizens)
    {
        $this->groupedCitizens = $groupedCitizens;
    }

    public function build()
    {
        return $this->subject('Reporte de Ciudadanos por Ciudad')
            ->view('emails.citizens_report');
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Citizens Report Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
{
    return new Content(
        view: 'emails.citizens_report',
    );
}

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
