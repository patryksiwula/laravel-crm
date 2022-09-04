<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{	
	/**
	 * Create a new task
	 *
	 * @param  array $attributes
	 * @return \App\Models\Task
	 */
	public function createTask(array $attributes): Task
	{
		$attributes['user_id'] = $attributes['search'][0]['model_id'];
		$attributes['project_id'] = $attributes['search'][1]['model_id'];
		unset($attributes['search'][0]['model_id'], $attributes['search'][1]['model_id']);
		$attributes['status'] = 'pending';

		return Task::create($attributes);
	}
	
	/**
	 * Update selected task
	 *
	 * @param  \App\Models\Task $task
	 * @param  array $attributes
	 * @return bool
	 */
	public function updateTask(Task $task, array $attributes): bool
	{
		$attributes['user_id'] = $attributes['search'][0]['model_id'];
		$attributes['project_id'] = $attributes['search'][1]['model_id'];
		unset($attributes['search'][0]['model_id'], $attributes['search'][1]['model_id']);

		return $task->update($attributes);
	}
}