<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ConfigurationService
{	
	/**
	 * Update CRM's configuration file
	 *
	 * @param  array $attributes
	 * @return void
	 */
	public function updateConfiguration(array $attributes): void
	{
		foreach ($attributes as $key => $value) {
			DB::table('configs')->where('name', $key)
				->update(['value' => $value]);
		}
	}
}