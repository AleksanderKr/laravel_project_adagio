<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipments>
 */
class ShipmentsFactory extends Factory
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
            'company' => 'DPD',
            'sent' => fake()->dateTimeBetween('last year', '-1 month'),
            'arrived' => fake()->dateTimeBetween(fake()->dateTimeBetween('last year', '-1 month'), strtotime('+5 days')),
            'sent_from' => fake()->city(),
            'current_location' => fake()->city(),
        ];
    }
}
