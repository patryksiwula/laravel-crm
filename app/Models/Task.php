<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'description',
		'status',
		'user_id',
		'project_id'
	];
	
	/**
	 * Get the user which the task is assigned to
	 *
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	/**
	 * Get the project which the task belongs to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project(): BelongsTo
	{
		return $this->belongsTo(Project::class);
	}
}
