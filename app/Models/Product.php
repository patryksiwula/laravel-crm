<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'description',
		'quantity',
		'price'
	];
	
	/**
	 * The invoices that the product is included in
	 *
	 * @return BelongsToMany
	 */
	public function invoices(): BelongsToMany
	{
		return $this->belongsToMany(Invoice::class);
	}
}
