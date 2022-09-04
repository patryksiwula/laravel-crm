<?php

namespace App\Models\Client;

use App\Models\Meeting;
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
