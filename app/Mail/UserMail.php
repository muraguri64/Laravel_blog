<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;


     /**
     * The verify instance.
     *
     * @var Verify
     */
    public $verify;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($verify,$name)
    {
        $this->verify = $verify;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('muraguri64@gmail.com')
                    ->view('email.mail');
    }
}
