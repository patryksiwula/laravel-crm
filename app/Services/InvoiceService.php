<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceService
{		
	/**
	 * Create a new invoice
	 *
	 * @param  array $attributes
	 * @return \App\Models\Invoice
	 */
	public function createInvoice(array $attributes): Invoice
	{
		$invoiceNumber = $this->generateInvoiceNumber($attributes['month'], $attributes['year']);
		unset($attributes['month'], $attributes['year']);
		$attributes = array_merge(['invoice_number' => $invoiceNumber], $attributes);
		$invoice = Invoice::create($attributes);

		return $invoice;
	}
	/**
	 * Generate invoice number for a new invoice
	 *
	 * @param  int $month
	 * @param  int $year
	 * @return string
	 */
	public function generateInvoiceNumber(int $month, int $year): string
	{
		// Append zeros for single-digit numbers
		$month = sprintf("%02d", $month);

		$number = Invoice::whereMonth('invoice_date', $month)
					->whereYear('invoice_date', $year)
					->orderByDesc('invoice_number')
					->first('invoice_number');

		if ($number === null)
			return '1/' . $month . '/' . $year;

		$number = $number->invoice_number;

		// Extract the identification number from string and increment it by 1
		$backslash = strpos($number, '/');
		$number = substr($number, 0, $backslash);

		return ++$number . '/' . $month . '/' . $year;
	}
}