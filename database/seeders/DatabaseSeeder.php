<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('offers')->insert([
            'item_name' => fake()->sentence(2),
            'category' => 'elektronika',
            'brand' => fake()->company(),
            'description' => fake()->sentence(10),
            'put_up_on' => fake()->date('Y-m-d'),
            'shipper' => 'DPD',
            'price' => fake()->randomFloat(2, 40, 500),
            'pictures' => 'img placeholder',
            'condition' => 'brand new',
            'product_opinion_id' => fake()->randomNumber(2, true),
        ]);

        DB::table('product_opinions')->insert([
            'text_field' => fake()->sentence(10),
            'author' => fake()->word(),
        ]);

        DB::table('user_addresses')->insert([
            'street_and_house_nr' => fake()->streetAddress(),
            'locality' => fake()-> city(),
            'zip_code' => fake()->postcode(),
            'country' => fake()->country(),
        ]);

        DB::table('users')->insert([
            'username' => fake()->firstName(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'sell_offers' => fake()->randomNumber(2, true),
            'address_id' => fake()->randomNumber(2, true),
            'telephone' => fake()->e164PhoneNumber(),
            'NIP' => fake()->numerify('%%% %% %% %%%'),
            'password' => fake()->password(),
            'email' => fake()->email(),
            'join_date' => fake()->date('Y-m-d'),
            'cart_id' => fake()->randomNumber(2, true),
        ]);

        $shipment_date = fake()->dateTimeBetween('last year', '-1 month');
        $arrival_date = fake()->dateTimeBetween($shipment_date, strtotime('+5 days'));
        DB::table('shipments')->insert([
            'company' => 'DPD',
            'sent' => $shipment_date,
            'arrived' => $arrival_date,
            'sent_from' => fake()->city(),
            'current_location' => fake()->city(),
        ]);

        DB::table('payments')->insert([
            'method' => fake()->creditCardType(),
            'date' => fake()->dateTimeBetween($shipment_date, strtotime('-1 week')),
            'status' => fake()->word(),         # mozna dodac cos lepszego niz word()
            'amount' => fake()->randomNumber(1, true),
        ]);

        DB::table('orders')->insert([
            'offer_id_f' => fake()->randomNumber(2, true),              # offer id a nie random
            'quantity' => fake()->randomNumber(1, true),
        ]);

        DB::table('cart')->insert([
            'orders_id' => fake()->randomNumber(2, true),
            'shipment_id' => fake()->randomNumber(2, true),
            'payment_id' => fake()->randomNumber(2, true),
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
