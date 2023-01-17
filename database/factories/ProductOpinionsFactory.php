<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductOpinionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'offer_id' => fake()->randomNumber(1, true),
            'text_field' => fake()->sentence(10),
            'author' => fake()->word(), # problem
        ];
    }
}
