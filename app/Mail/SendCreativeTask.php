<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCreativeTask extends Mailable
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
        return $this->from('noreply@allianceprojects.in', 'CREATIVES - DIGITAL LABS')->subject($this->mdata['subject'])->view('mail.creative.send_status')->with('mdata', $this->mdata);
    }
}
