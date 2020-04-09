<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Geral extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
       $this->data=$data; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
   
    public function build()
    {
        $data=$this->data;
       return $this->subject($this->data['assunto'])->from('info@pataspelos.com','Pelos & Patas')->replyTo('pelosepatas@gmail.com', 'Pelos & Patas')->view('emails.geral',compact(['data']));
    }
}
