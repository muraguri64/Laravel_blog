<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The verify instance.
     *
     * @var Verify
     */
    public $email;
    public $name;   
    public $subject; 
    public $message_send;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$name,$subject,$message_send)
    {
        $this->email        = $email;
        $this->name         = $name;
        $this->subject      = $subject;        
        $this->message_send = $message_send;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from('muraguri@gmail.com')
                     ->view('email.contactmail');

    }
}
