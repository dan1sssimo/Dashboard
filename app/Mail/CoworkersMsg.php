<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CoworkersMsg extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $name;
    public $link;
    public $department;
    public $supervisor;
    public $company;

    public function __construct($name, $department, $supervisor, $company)
    {
        $this->name = $name;
        $this->link = "https://qualtricsxm29zkvsd7y.qualtrics.com/jfe/form/SV_9FtECtejcxTGgL4";
        $this->department = $department;
        $this->supervisor = $supervisor;
        $this->company = $company;
    }

    public function build()
    {
        return $this->view('coworkersMsg',
        [
            "name" => $this->name,
            "link" => $this->link,
            "department" => $this->department,
            "supervisor" => $this->supervisor,
            "company" => $this->company
        ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Coworkers Msg',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'coworkersMsg',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
