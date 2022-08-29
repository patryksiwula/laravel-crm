<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function index(): View
    {
        $invoices = Invoice::with(['user', 'client'])->paginate(15);

		return view('invoices.list', compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Invoice $invoice): View
    {
		$this->authorize('edit-invoices');
		$products = $invoice->products();

		return view('invoices.edit', [
			'invoiceId' => $invoice->id,
			'products' => $products
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Invoice $invoice): RedirectResponse
    {
        $this->authorize('delete-invoices');
		$invoice->delete();

		return redirect()->route('invoices.index')
			->with('action', 'invoice_deleted');
    }

	public function download(Invoice $invoice): Response
	{
		$pdf = PDF::loadView('invoices.invoice-pdf', compact('invoice'));
		$fileName = __('Invoice') . '_' . $invoice->invoice_number . '.pdf';

		return $pdf->download($fileName);
	}

	public function send(Invoice $invoice): RedirectResponse
	{
		$pdf = PDF::loadView('invoices.invoice-pdf', compact('invoice'));
		$fileName = __('Invoice') . '_' . $invoice->invoice_number . '.pdf';
		$pdfContent = $pdf->download()->getOriginalContent();

		Storage::put('public/invoices/' . $fileName, $pdfContent);
		Mail::to($invoice->client->email)->send(new InvoiceMail('public/invoices/' . $fileName, $fileName));

		return redirect()->route('invoices.index')
			->with('action', 'invoice_sent');
	}
}
