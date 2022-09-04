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
		$attributes['user_id'] = $attributes['search'][0]['model_id'];
		$attributes['client_id'] = $attributes['search'][1]['model_id'];
		$attributes['client_type'] = $attributes['search'][1]['model_type'];
		
		unset(
			$attributes['search'][0]['model_id'],
			$attributes['search'][1]['model_id'], 
			$attributes['search'][1]['model_type']
		);
		
		$attributes['status'] = 'pending';

		return Project::create($attributes);
	}

	/**
	 * Update selected project
	 *
	 * @param  \App\Models\Project $project
	 * @param  array $attributes
	 * @return bool
	 */
	public function updateProject(Project $project, array $attributes): bool
	{
		$attributes['user_id'] = $attributes['search'][0]['model_id'];
		$attributes['client_id'] = $attributes['search'][1]['model_id'];
		$attributes['client_type'] = $attributes['search'][1]['model_type'];

		unset(
			$attributes['search'][0]['model_id'],
			$attributes['search'][1]['model_id'], 
			$attributes['search'][1]['model_type']
		);

		return $project->update($attributes);
	}
}