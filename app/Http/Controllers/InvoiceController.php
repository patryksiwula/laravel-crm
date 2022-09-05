<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
		$dateFormat = DB::table('configs')->where('id', 5)->get('value');
		$dateFormat = $dateFormat->get(0)->value;

		return view('invoices.list', compact('invoices', 'dateFormat'));
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
	
	/**
	 * Generate invoice PDF and download it.
	 *
	 * @param  \App\Models\Invoice $invoice
	 * @param  \App\Services\InvoiceService $invoiceService
	 * @return \Illuminate\Http\Response
	 */
	public function download(Invoice $invoice, InvoiceService $invoiceService): Response
	{
		return $invoiceService->downloadInvoice($invoice);
	}
	
	/**
	 * Send an email to client containing the generated invoice.
	 *
	 * @param  \App\Models\Invoice $invoice
	 * @param  \App\Services\InvoiceService $invoiceService
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function send(Invoice $invoice, InvoiceService $invoiceService): RedirectResponse
	{
		if ($invoiceService->sendInvoice($invoice) === null)
			return redirect()->route('invoices.index')->with('action', 'invoice_send_error');
			
		return redirect()->route('invoices.index')
			->with('action', 'invoice_sent');
	}
}
