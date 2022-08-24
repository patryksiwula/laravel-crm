<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

	protected $fillable = [
		'invoice_number',
		'invoice_date',
		'sale_date',
		'due_date',
		'payment_method',
		'user_id'
	];
}
