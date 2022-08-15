<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
