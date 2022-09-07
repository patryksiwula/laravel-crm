<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
}
