<?php

namespace App\Mail;

use Barryvdh\DomPDF\PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private string $pdfPath, private string $fileName) { }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('patryk.siw@gmail.com', 'Company')
					->attach($this->pdfPath, [
						'as' => $this->fileName,
						'mime' => 'application/pdf'
					])
					->view('invoices.email');
    }
}
