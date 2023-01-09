<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserAddressesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->randomNumber(2, true),
            'street_and_house_nr' => fake()->streetAddress(),
            'locality' => fake()-> city(),
            'zip_code' => fake()->postcode(),
            'country' => fake()->country(),
        ];
    }
}
