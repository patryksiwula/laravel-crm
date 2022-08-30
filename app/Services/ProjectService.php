<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{	
	/**
	 * Create a new project
	 *
	 * @param  mixed $attributes
	 * @return \App\Models\Project
	 */
	public function createProject(array $attributes): Project
	{
		$attributes['client_id'] = $attributes['model_id'];
		$attributes['client_type'] = $attributes['model_type'];
		unset($attributes['model_id'], $attributes['model_type']);
		$attributes['status'] = 'pending';

		return Project::create($attributes);
	}
}