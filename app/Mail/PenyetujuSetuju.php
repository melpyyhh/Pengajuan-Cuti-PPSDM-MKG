<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PenyetujuSetuju extends Mailable
{
    use Queueable, SerializesModels;

    public $pengajuan;

    /**
     * Create a new message instance.
     *
     * @param $pengajuan
     */
    public function __construct($pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pengajuan Cuti Diterima')
            ->view('emails.penyetuju-setuju')
            ->with([
                'pengajuan' => $this->pengajuan,
            ]);
    }    
}
