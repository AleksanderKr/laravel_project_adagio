<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users>
 */
class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => fake()->firstName(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'telephone' => fake()->numerify('+48 %%% %%% %%%'),
            'NIP' => fake()->numerify('%%% %% %% %%%'),
            'password' => fake()->word(),   # proper salted hashing
            'email' => fake()->email(),
            'join_date' => fake()->date('Y-m-d'),
        ];
    }
}
