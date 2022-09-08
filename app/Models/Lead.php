<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;

class Lead extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'description',
		'lead_value',
		'stage',
		'source',
		'user_id',
		'client_id',
		'client_type'
	];
	
	/**
	 * Get the sales owner
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	/**
	 * Get the client associated with the lead
	 *
	 * @return MorphTo
	 */
	public function client(): MorphTo
	{
		return $this->morphTo();
	}

	public function products(): BelongsToMany
	{
		return $this->belongsToMany(Product::class)
			->withPivot('quantity');
	}

	public function addProduct(Product $product, int $quantity): void
	{
		$this->products()->attach($product, ['quantity' => $quantity]);
	}

	public function syncItems(Collection $items): void
	{
		$this->products()->detach();

		foreach ($items as $item)
			$this->products()->attach(Product::find($item['product_id']), ['quantity' => $item['quantity']]);
	}
}
