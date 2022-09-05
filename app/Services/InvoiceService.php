<?php

namespace App\Services;

use App\Mail\InvoiceMail;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Response;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{		
	/**
	 * Create a new invoice
	 *
	 * @param  array $attributes
	 * @return \App\Models\Invoice
	 */
	public function createInvoice(array $attributes): Invoice
	{
		$invoiceNumber = $this->generateInvoiceNumber($attributes['month'], $attributes['year']);
		unset($attributes['month'], $attributes['year']);
		$attributes = array_merge(['invoice_number' => $invoiceNumber], $attributes);
		$invoice = Invoice::create($attributes);

		return $invoice;
	}

	/**
	 * Update selected invoice
	 *
	 * @param  \App\Models\Invoice $invoice
	 * @param  array $attributes
	 * @return \App\Models\Invoice
	 */
	public function updateInvoice(Invoice $invoice, array $attributes): Invoice
	{
		$invoice->update($attributes);

		return $invoice;
	}

	/**
	 * Generate invoice number for a new invoice
	 *
	 * @param  int $month
	 * @param  int $year
	 * @return string
	 */
	public function generateInvoiceNumber(int $month, int $year): string
	{
		// Append zeros for single-digit numbers
		$month = sprintf("%02d", $month);

		$number = Invoice::whereMonth('invoice_date', $month)
					->whereYear('invoice_date', $year)
					->orderByDesc('invoice_number')
					->first('invoice_number');

		if ($number === null)
			return '1/' . $month . '/' . $year;

		$number = $number->invoice_number;

		// Extract the identification number from string and increment it by 1
		$backslash = strpos($number, '/');
		$number = substr($number, 0, $backslash);

		return ++$number . '/' . $month . '/' . $year;
	}
	
	/**
	 * Generate invoice in PDF format and download it.
	 *
	 * @param  \App\Models\Invoice $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function downloadInvoice(Invoice $invoice): Response
	{
		$pdf = PDF::loadView('invoices.invoice-pdf', compact('invoice'));
		$fileName = __('Invoice') . '_' . $invoice->invoice_number . '.pdf';

		return $pdf->download($fileName);
	}
	
	/**
	 * Send an email to client with the generated invoice.
	 *
	 * @param  \App\Models\Invoice $invoice
	 * @return \Illuminate\Mail\SentMessage|null
	 */
	public function sendInvoice(Invoice $invoice): SentMessage|null
	{
		$pdf = PDF::loadView('invoices.invoice-pdf', compact('invoice'));
		$fileName = __('Invoice') . '_' . $invoice->invoice_number . '.pdf';
		$pdfContent = $pdf->download()->getOriginalContent();

		Storage::put('public/invoices/' . $fileName, $pdfContent);
		
		return Mail::to($invoice->client->email)->send(new InvoiceMail('public/invoices/' . $fileName, $fileName));
	}
}