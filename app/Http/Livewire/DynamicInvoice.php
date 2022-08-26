<?php

namespace App\Http\Livewire;

use App\Models\Client\Organization;
use App\Models\Client\Person;
use App\Models\Invoice;
use App\Models\Product;
use App\Services\InvoiceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Redirector;

class DynamicInvoice extends Component
{		
	public string $invoiceNumber;
	public string $invoice_date;
	public string $sale_date;
	public string $due_date;
	public string $payment_method;
	public string $client_type;
	public int $client_id;
	public int $user_id;

	public Collection $inputs;
	public Collection $products;
	public Collection $invoiceItems;
	public Collection $clients;

	protected $rules = [
		'invoice_date' => ['required', 'date'],
		'sale_date' => ['required', 'date'],
		'due_date' => ['required', 'date'],
		'payment_method' => ['in:cash,bank transfer,credit card'],
		'client_type' => ['required', 'string'],
		'client_id' => ['required', 'numeric', 'min:1'],
		'user_id' => ['required', 'numeric']
	];
	
	/**
	 * Initialize properties when page is loaded
	 *
	 * @return void
	 */
	public function mount(): void
	{
		$this->invoiceNumber = '';
		$this->invoice_date = '';
		$this->sale_date = '';
		$this->due_date = '';
		$this->payment_method = 'cash';
		$this->client_type = 'Organization';
		$this->client_id = 0;
		$this->user_id = Auth::user()->id;

		$this->inputs = new Collection();
		$this->products = Product::all();
		$this->invoiceItems = new Collection();
		$this->clients = new Collection();
	}
    
    /**
     * Render Livewire component
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
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

        return view('livewire.dynamic-invoice');
    }
	
	/**
	 * Add new input to collection
	 *
	 * @return void
	 */
	public function addInput(): void
	{
		$this->inputs->push([]);

		$this->invoiceItems->push([
			'product_id' => 0,
			'quantity' => 1
		]);
	}
	
	/**
	 * Remove input from collection
	 *
	 * @param  int $key
	 * @return void
	 */
	public function removeInput(int $key): void
	{
		$this->inputs->pull($key);
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
			->with('action', 'invoice_created');
	}

	/**
	 * Display generated invoice number
	 *
	 * @param  \App\Services\InvoiceService $invoiceService
	 * @return void
	 */
	public function generateInvoiceNumber(InvoiceService $invoiceService): void
	{
		$month = Carbon::parse($this->invoice_date)->month;
		$year = Carbon::parse($this->invoice_date)->year;
		$this->invoiceNumber = $invoiceService->generateInvoiceNumber($month, $year);
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
		$this->validate(['invoiceItems.*.quantity' => ['required', 'numeric', 'min:1']]);

		// Add products to invoice
		foreach ($this->invoiceItems as $item) {
			$product = Product::find($item['product_id']);
			$invoice->addItem($product, $item['quantity']);
		}
	}
}
