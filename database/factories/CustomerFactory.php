<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countries = [
            'MEX', 'USA', 'CAN', 'BRA', 'ARG',
            'COL', 'PER', 'CHL', 'ESP', 'FRA',
            'DEU', 'ITA', 'GBR', 'NLD', 'PRT',
            'JPN', 'CHN', 'KOR', 'AUS', 'IND',
        ];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'age' => fake()->numberBetween(0, 120),
            'country' => fake()->randomElement($countries),
        ];
    }
}
