<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRedAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $mdata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mdata)
    {
        $this->mdata = $mdata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@allianceprojects.in', 'Alliance Group - RED ALERT')->subject($this->mdata['subject'])->view('mail.red_alert')->with('mdata', $this->mdata);
    }

}
