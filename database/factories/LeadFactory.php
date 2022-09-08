<?php

namespace Database\Factories;

use App\Models\Client\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		$sources = ['facebook', 'instagram', 'linkedin', 'other'];

        return [
            'name' => fake()->word(),
			'description' => fake()->text(100),
			'source' => $sources[rand(0, 3)],
			'lead_value' => fake()->numberBetween(1000, 1000000),
			'user_id' => User::all()->random()->id,
			'client_id' => Person::all()->random()->id,
			'client_type' => 'App\Models\Client\Person'
        ];
    }
}
