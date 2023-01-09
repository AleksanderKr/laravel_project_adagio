<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OffersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'seller_id' => fake()->randomNumber(2, true),
            'order_id' => fake()->randomNumber(2, true),
            'item_name' => fake()->sentence(2),
            'category' => 'elektronika',
            'brand' => 'samsung',
            'description' => fake()->sentence(100),
            'put_up_on' => fake()->date('Y-m-d'),
            'shipper' => 'DPD',
            'price' => fake()->randomFloat(2, 40, 500),
            'pictures' => 'img placeholder',
            'condition' => 'brand new',
        ];
    }
}
