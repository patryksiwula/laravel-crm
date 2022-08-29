<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Project extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'description',
		'status',
		'deadline',
		'user_id',
		'client_id',
		'client_type'
	];
	
	/**
	 * Get the user assigned to the project
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	/**
	 * Get the client assigned to the project
	 *
	 * @return MorphTo
	 */
	public function client(): MorphTo
	{
		return $this->morphTo();
	}
}
