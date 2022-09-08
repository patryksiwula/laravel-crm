<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class Products extends Component
{
	public Collection $inputs;
	public Collection $productsAvailable;
	public Collection $items;
	public array $products;
	public Invoice|Lead $model;
	public Collection $modelProducts;

	public function mount(): void
	{
		$this->inputs = new Collection();
		$this->productsAvailable = Product::select(['id', 'name'])->get();
		$this->items = new Collection();
		
		if (!empty($this->modelProducts))
		{
			foreach ($this->modelProducts as $product)
			$this->addInput($product->id, $product->pivot->quantity);
		}
	}

    public function render()
    {
        return view('livewire.products');
    }

	/**
	 * Add new input to collection
	 *
	 * @return void
	 */
	public function addInput(int $product_id = 0, int $quantity = 1): void
	{
		$this->inputs->push([]);

		$this->items->push([
			'product_id' => $product_id,
			'quantity' => $quantity
		]);

		$this->products[] = [
			'product_id' => $product_id,
			'quantity' => $quantity
		];
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
		$this->items->pull($key);

		unset($this->products[$key]);
	}
}
