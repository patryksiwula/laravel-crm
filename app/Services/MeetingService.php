<?php

namespace App\Services;

use App\Models\Meeting;

class MeetingService
{	
	/**
	 * Create a new meeting
	 *
	 * @param  array $attributes
	 * @return \App\Models\Meeting
	 */
	public function createMeeting(array $attributes): Meeting
	{
		$attributes['user_id'] = $attributes['search'][0]['model_id'];
		$attributes['client_id'] = $attributes['search'][1]['model_id'];
		$attributes['client_type'] = $attributes['search'][1]['model_type'];
		
		unset(
			$attributes['search'][0]['model_id'],
			$attributes['search'][1]['model_id'], 
			$attributes['search'][1]['model_type']
		);

		return Meeting::create($attributes);
	}
	
	/**
	 * Update selected meeting
	 *
	 * @param  \App\Models\Meeting $meeting
	 * @param  array $attributes
	 * @return bool
	 */
	public function updateMeeting(Meeting $meeting, array $attributes): bool
	{
		$attributes['user_id'] = $attributes['search'][0]['model_id'];
		$attributes['client_id'] = $attributes['search'][1]['model_id'];
		$attributes['client_type'] = $attributes['search'][1]['model_type'];

		unset(
			$attributes['search'][0]['model_id'],
			$attributes['search'][1]['model_id'], 
			$attributes['search'][1]['model_type']
		);

		return $meeting->update($attributes);
	}
}