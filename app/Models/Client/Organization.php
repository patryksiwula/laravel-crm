<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Organization extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'email',
		'phone',
		'address',
		'vat'
	];
	
	/**
	 * Get the projects assigned to client
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function projects(): MorphMany
	{
		return $this->morphMany(Project::class, 'client');
	}
}
