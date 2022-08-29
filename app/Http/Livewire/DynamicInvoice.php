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
	public Collection $productsAvailable;
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
		$this->user_id = Auth::user()->id;
		$this->inputs = new Collection();
		$this->productsAvailable = Product::all();
		$this->invoiceItems = new Collection();
		$this->clients = new Collection();
	}

	/**
	 * Add new input to collection
	 *
	 * @return void
	 */
	public function addInput(int $product_id = 0, int $quantity = 1): void
	{
		$this->inputs->push([]);

		$this->invoiceItems->push([
			'product_id' => $product_id,
			'quantity' => $quantity
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
		$this->invoiceItems->pull($key);
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
}
