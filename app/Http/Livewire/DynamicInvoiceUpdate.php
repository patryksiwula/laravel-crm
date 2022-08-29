<?php

namespace App\Http\Livewire;

use App\Models\Client\Organization;
use App\Models\Client\Person;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\RedirectResponse;
use Livewire\Redirector;

class DynamicInvoiceUpdate extends DynamicInvoice
{
	public int $invoiceId;

	/**
	 * Initialize properties when page is loaded
	 *
	 * @return void
	 */
	public function mount(): void
	{
		parent::mount();

		$this->invoiceNumber = $this->invoice->invoice_number;
		$this->invoice_date = $this->invoice->invoice_date;
		$this->sale_date = $this->invoice->sale_date;
		$this->due_date = $this->invoice->due_date;
		$this->payment_method = $this->invoice->payment_method;
		$this->client_type = substr($this->invoice->client_type, 18);
		$this->client_id = $this->invoice->client_id;

		if (!empty($this->invoice->products))
		{
			foreach ($this->invoice->products as $product)
				$this->addInput($product->id, $product->pivot->quantity);
		}
	}

    public function render()
    {
		switch ($this->client_type)
		{
			case 'Organization':
				$this->clients = Organization::all();
				break;
			
			case 'Person':
				$this->clients = Person::all();
				break;
		}

        return view('livewire.dynamic-invoice-update');
    }

	public function getInvoiceProperty(): Invoice|null
	{
		return Invoice::find($this->invoiceId);
	}

	/**
	 * Save new invoice
	 *
	 * @param  \App\Services\InvoiceService $invoiceService
	 * @return \Illuminate\Http\RedirectResponse|\Livewire\Redirector
	 */
	public function save(InvoiceService $invoiceService): RedirectResponse|Redirector
	{
		$this->updateInvoice($invoiceService);
		$this->updateInvoiceProducts($this->invoice);

		return redirect()->route('invoices.index')
			->with('action', 'invoice_updated');
	}

	/**
	 * Create a new invoice
	 *
	 * @param  \App\Services\InvoiceService $invoiceService
	 * @return \App\Models\Invoice
	 */
	public function updateInvoice(InvoiceService $invoiceService): Invoice
	{	
		// Validate invoice details
		$validatedInvoice = $this->validate();
		$validatedInvoice['client_type'] = 'App\Models\Client\\' . $validatedInvoice['client_type'];

		return $invoiceService->updateInvoice($this->invoice, $validatedInvoice);
	}
	
	/**
	 * Add products to created invoice
	 *
	 * @param  \App\Models\Invoice $invoice
	 * @return void
	 */
	public function updateInvoiceProducts(Invoice $invoice): void
	{
		// Validate product fields
		$this->validate([
			'invoiceItems.*.product_id' => ['required', 'numeric', 'min:1'],
			'invoiceItems.*.quantity' => ['required', 'numeric', 'min:1']
		]);
		
		$invoice->syncItems($this->invoiceItems);
	}
}
