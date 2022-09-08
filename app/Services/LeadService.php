<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Product;
use Illuminate\Support\Collection;

class LeadService
{
	public function createLead(array $attributes): Lead
	{
		$attributes['stage'] = 'new';

		if (!empty($attributes['search'][0]['model_id']))
			$attributes['user_id'] = $attributes['search'][0]['model_id'];

		if (!empty($attributes['search'][1]['model_id']))
			$attributes['client_id'] = $attributes['search'][1]['model_id'];

		if (!empty($attributes['search'][1]['model_type']))
			$attributes['client_type'] = $attributes['search'][1]['model_type'];

		unset(
			$attributes['search'][0]['model_id'],
			$attributes['search'][1]['model_id'],
			$attributes['search'][1]['client_type']
		);

		if (empty($attributes['products']))
			return Lead::create($attributes);

		$products = $attributes['products'];
		unset($attributes['products']);
		$lead = Lead::create($attributes);

		foreach ($products as $product)
		{
			$addProduct = Product::find($product['product_id']);
			$lead->addProduct($addProduct, $product['quantity']);
		}

		return $lead;
	}

	public function updateLead(Lead $lead, array $attributes): bool
	{
		if (!empty($attributes['search'][0]['model_id']))
			$attributes['user_id'] = $attributes['search'][0]['model_id'];

		if (!empty($attributes['search'][1]['model_id']))
			$attributes['client_id'] = $attributes['search'][1]['model_id'];

		if (!empty($attributes['search'][1]['model_type']))
			$attributes['client_type'] = $attributes['search'][1]['model_type'];

		unset(
			$attributes['search'][0]['model_id'],
			$attributes['search'][1]['model_id'],
			$attributes['search'][1]['client_type']
		);

		$products = [];

		if (!empty($attributes['products']))
		{
			$products = $attributes['products'];
			unset($attributes['products']);

			$lead->syncItems(new Collection($products));
		}

		return $lead->update($attributes);
	}
}