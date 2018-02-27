<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SimpleMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      return $this->view('emails.simple')
                ->from('no-reply@mindkraft.org', 'MindKraft Organizing Committee')
                ->subject($this->data['subject'])
                ->with(['body' => $this->data['body'], 'from' => $this->data['from']]);
    }
}
