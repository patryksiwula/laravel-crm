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
		$attributes['project_id'] = $attributes['model_id'];
		unset($attributes['model_id']);
		$attributes['status'] = 'pending';

		return Task::create($attributes);
	}
	
	/**
	 * Update selected task
	 *
	 * @param  \App\Models\Task $task
	 * @param  array $attributes
	 * @return \App\Models\Task
	 */
	public function updateTask(Task $task, array $attributes): bool
	{
		$attributes['project_id'] = $attributes['model_id'];
		unset($attributes['model_id']);

		return $task->update($attributes);
	}
}