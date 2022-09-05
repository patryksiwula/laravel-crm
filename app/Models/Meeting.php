<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Meeting extends Model
{
    use HasFactory;

	protected $fillable = [
		'description',
		'time',
		'user_id',
		'client_type',
		'client_id'
	];

	protected $dates = ['time'];
	
	/**
	 * Get the user assigned to the meeting
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	/**
	 * Get the client assigned to the meeting
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function client(): MorphTo
	{
		return $this->morphTo();
	}
}
