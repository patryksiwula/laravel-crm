<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Product;
use App\Services\InvoiceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Livewire\Redirector;

class DynamicInvoiceCreate extends DynamicInvoice
{		
	/**
	 * Initialize properties when page is loaded
	 *
	 * @return void
	 */
	public function mount(): void
	{
		parent::mount();

		$this->invoiceNumber = '';
		$this->invoice_date = '';
		$this->sale_date = '';
		$this->due_date = '';
		$this->payment_method = 'cash';
		$this->client_type = 'Organization';
		$this->client_id = 0;
	}

    /**
     * Render Livewire component
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
		$clientModel = '\\App\Models\Client\\' . $this->client_type;
		$this->clients = $clientModel::select(['id', 'name'])->get();

        return view('livewire.dynamic-invoice-create');
    }
	
	/**
	 * Save new invoice
	 *
	 * @param  \App\Services\InvoiceService $invoiceService
	 * @return \Illuminate\Http\RedirectResponse|\Livewire\Redirector
	 */
	public function save(InvoiceService $invoiceService): RedirectResponse|Redirector
	{
		$invoice = $this->createInvoice($invoiceService);
		$this->addProductsToInvoice($invoice);

		return redirect()->route('invoices.index')
			->with('action', __('actions.invoice_created'));
	}
	
	/**
	 * Create a new invoice
	 *
	 * @param  \App\Services\InvoiceService $invoiceService
	 * @return \App\Models\Invoice
	 */
	public function createInvoice(InvoiceService $invoiceService): Invoice
	{	
		// Validate invoice details
		$validatedInvoice = $this->validate();
		$validatedInvoice['client_type'] = 'App\Models\Client\\' . $validatedInvoice['client_type'];

		$month = Carbon::parse($validatedInvoice['invoice_date'])->month;
		$year = Carbon::parse($validatedInvoice['invoice_date'])->year;
		$validatedInvoice = array_merge(compact('month'), compact('year'), $validatedInvoice);

		return $invoiceService->createInvoice($validatedInvoice);
	}
	
	/**
	 * Add products to created invoice
	 *
	 * @param  \App\Models\Invoice $invoice
	 * @return void
	 */
	public function addProductsToInvoice(Invoice $invoice): void
	{
		// Validate product fields
		$this->validate([
			'invoiceItems.*.product_id' => ['required', 'numeric', 'min:1'],
			'invoiceItems.*.quantity' => ['required', 'numeric', 'min:1']
		]);

		// Add products to invoice
		foreach ($this->invoiceItems as $item) {
			$product = Product::find($item['product_id']);
			$invoice->addItem($product, $item['quantity']);
		}
	}
}
