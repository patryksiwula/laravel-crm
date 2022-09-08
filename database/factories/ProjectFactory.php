<?php

namespace Database\Factories;

use App\Models\Client\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word(),
			'description' => fake()->text(100),
			'deadline' => fake()->date(),
			'status' => 'pending',
			'user_id' => User::all()->random()->id,
			'client_type' => 'App\Models\Client\Person',
			'client_id' => Person::all()->random()->id
        ];
    }
}
