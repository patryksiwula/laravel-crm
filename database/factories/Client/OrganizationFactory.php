<?php

namespace Database\Factories\Client;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
			'email' => fake()->unique()->safeEmail(),
			'phone' => fake()->unique()->e164PhoneNumber(),
			'address' => fake()->address(),
			'vat' => fake()->numerify('##########')
        ];
    }
}
