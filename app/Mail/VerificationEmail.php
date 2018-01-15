<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationEmail extends Mailable
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

      $subject = 'User Verification Email';

      return $this->view('emails.verification')
                ->from(env('MAIL_FROM_ADDRESS', ''), env('MAIL_FROM_NAME', ''))
                ->subject($subject)
                ->with(['id' => $this->data['id'], 'api_token' => $this->data['api_token']]);
    }
}
