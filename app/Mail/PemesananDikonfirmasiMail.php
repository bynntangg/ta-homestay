<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PemesananDikonfirmasiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pemesanan;
    public $invoicePath;

    public function __construct($pemesanan, $invoicePath)
    {
        $this->pemesanan = $pemesanan;
        $this->invoicePath = $invoicePath;
    }

    public function build()
    {
        $email = $this->view('emails.pemesanan-dikonfirmasi')
            ->subject('Pemesanan Dikonfirmasi - ' . $this->pemesanan->homestay->nama);
            
        // Lampirkan file PDF
        if ($this->invoicePath && Storage::disk('public')->exists($this->invoicePath)) {
            $email->attach(storage_path('app/public/' . $this->invoicePath), [
                'as' => 'Invoice_' . $this->pemesanan->id . '.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $email;
    }
}