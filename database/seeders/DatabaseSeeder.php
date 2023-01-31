<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        /*
        \App\Models\Users::factory(1)->create();
        \App\Models\Carts::factory(1)->create();
        \App\Models\Orders::factory(1)->create();
        \App\Models\Offers::factory(1)->create();
        \App\Models\ProductOpinions::factory(1)->create();
        \App\Models\UserAddresses::factory(1)->create();
        \App\Models\Shipments::factory(1)->create();
        \App\Models\Payments::factory(1)->create();
        */
        
        /*
            "procedura": comment `carts` table creation after the first one,
            swap order id in `offers` table with some of those two variables or NULL

        */

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
        $increasing_id = 1;
        $decreasing_id = 400;
        
        $categories = array("elektronika", 'AGD', "spożywcze", "moda", "dom i ogród", "zdrowie", "motoryzacja");
        $brands = array("Samsung", "LG", "Xiaomi", "FSO", "Zetor", "Fendt", "PG", "Ursus", "Fiat");
        $shippers = array("DPD", "FedEx", "DHL", "Poczta Polska", "Kaczkomat");
        
        
        for ($x = 0; $x < 100; $x++) {
            $price = fake()->randomFloat(2, 40, 500);
            $username = fake()->firstName();
            $quantity = random_int(1, 15);

        DB::table('users')->insert([
            'username' => $username,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'telephone' => fake()->numerify('+48 %%% %%% %%%'),
            'NIP' => fake()->numerify('%%%%%%%%%%'),
            'password' => hash('sha256', fake()->password()),
            'salt' => fake()->password(),
            'email' => fake()->email(),
            'join_date' => fake()->date('Y-m-d'),
            'remember_token' => null,
            'role' => 0,
        ]);
        
        /*
        DB::table('carts')->insert([
            'user_id' => $increasing_id,
        ]);
        */
        
        DB::table('offers')->insert([
            #'seller_id' => fake()->randomNumber(1, true),
            #'order_id' => fake()->randomNumber(1, true),
            'seller_id' => $increasing_id,
            'order_id' => $decreasing_id,
            'item_name' => fake()->sentence(2),
            'category' => $categories[random_int(0, 6)],
            'brand' => $brands[random_int(0, 8)],
            'description' => fake()->sentence(100),
            'put_up_on' => fake()->date('Y-m-d'),
            'shipper' => $shippers[random_int(0, 4)],
            'price' => $price,
            'pictures' => fake()->imageUrl(640, 480, 'offer'),
            'condition' => 'brand new',
        ]);
        
        $decreasing_id--;

        DB::table('orders')->insert([
            #'cart_id' => fake()->randomNumber(1, true),
            'cart_id' => $increasing_id,
            'quantity' => $increasing_id,
        ]);
        

        DB::table('product_opinions')->insert([
            #'offer_id' => fake()->randomNumber(1, true),
            'offer_id' => $increasing_id,
            'text_field' => fake()->sentence(10),
            'author' => $username,
        ]);

        for ($adr = 1; $adr < 5; $adr++) {
        DB::table('user_addresses')->insert([
            #'user_id' => fake()->randomNumber(1, true),
            'user_id' => $increasing_id,
            'street_and_house_nr' => fake()->streetAddress(),
            'locality' => fake()-> city(),
            'zip_code' => fake()->postcode(),
            'country' => fake()->country(),
        ]);
        }

        $shipment_date = fake()->dateTimeBetween('last year', '-1 month');
        $arrival_date = fake()->dateTimeBetween($shipment_date, strtotime('+5 days'));
        DB::table('shipments')->insert([
            #'cart_id' => fake()->randomNumber(1, true),
            'cart_id' => $increasing_id,
            'company' => $shippers[random_int(0, 4)],
            'sent' => fake()->dateTimeBetween('last year', '-1 month'),
            'arrived' => fake()->dateTimeBetween(fake()->dateTimeBetween('last year', '-1 month'), strtotime('+5 days')),
            'sent_from' => fake()->city(),
            'current_location' => fake()->city(),
        ]);

        DB::table('payments')->insert([
            'cart_id' => fake()->randomNumber(1, true),
            'method' => fake()->creditCardType(),
            'date' => fake()->dateTimeBetween(fake()->dateTimeBetween('last year', '-1 month'), strtotime('-1 week')),
            'status' => 'zapłacono',
            'amount' => $price * $quantity,
        ]);

        $increasing_id++;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
