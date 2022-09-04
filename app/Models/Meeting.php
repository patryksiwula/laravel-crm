<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
