<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $content,$order)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        return $this->subject($this->subject)
            ->view('orders.for_customer',compact('order'));
    }
}
