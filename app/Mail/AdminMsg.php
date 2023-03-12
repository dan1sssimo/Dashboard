<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminMsg extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name;
    public $link;
    public $email;
    public $password;
    public $status;
    public $company;
    public $test;
    public $department;

    public function __construct($name, $link, $email, $password, $company, $status, $test, $department)
    {
        $this->name = $name;
        $this->link = $link;
        $this->password = $password;
        $this->email = $email;
        $this->status = $status;
        $this->company = $company;
        $this->test = $test;
        $this->department = $department;
    }

    public function build()
    {
        return $this->view('admin-msg',
            [
                "name" => $this->name,
                "link" => $this->link,
                "email" => $this->email,
                "password" => $this->password,
                "status" => $this->status,
                "company" => $this->company,
                "test" => $this->test,
                "department" => $this->department
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
            subject: 'Admin Msg',
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
            view: 'admin-msg',
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
