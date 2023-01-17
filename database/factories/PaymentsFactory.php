<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cart_id' => fake()->randomNumber(1, true),
            'method' => fake()->creditCardType(),
            'date' => fake()->dateTimeBetween(fake()->dateTimeBetween('last year', '-1 month'), strtotime('-1 week')),
            'status' => 'zapłacono',
            'amount' => fake()->randomNumber(3, true),  # ilość x cena produktu
        ];
    }
}
