<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Person extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'email',
		'phone',
		'address'
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

	/**
	 * 
	 * Get the client's meetings
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function meetings(): MorphMany
	{
		return $this->morphMany(Meeting::class, 'client');
	}
}
