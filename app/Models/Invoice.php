<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use PhpParser\ErrorHandler\Collecting;

class Invoice extends Model
{
    use HasFactory;

	protected $fillable = [
		'invoice_number',
		'invoice_date',
		'sale_date',
		'due_date',
		'payment_method',
		'client_type',
		'client_id',
		'user_id'
	];

	protected $dates = [
		'invoice_date',
		'sale_date',
		'due_date'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function client(): MorphTo
	{
		return $this->morphTo();
	}

	public function products(): BelongsToMany
	{
		return $this->belongsToMany(Product::class)
			->withPivot('quantity')
			->withTimestamps();
	}

	public function syncItems(Collection $invoiceItems): void
	{
		$this->products()->detach();

		foreach ($invoiceItems as $item)
			$this->products()->attach(Product::find($item['product_id']), ['quantity' => $item['quantity']]);
	}

	public function addItem(Product $product, int $quantity): void
	{
		$this->products()->attach($product, ['quantity' => $quantity]);
	}
}
