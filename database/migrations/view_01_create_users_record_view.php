<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('
            CREATE VIEW IF NOT EXISTS users_records
            AS
            SELECT 
                users.id AS users_id,
                users.username,
                users.first_name,
                users.last_name,
                offers.id AS sell_offer_id,
                offers.item_name
            FROM
                users
                LEFT JOIN offers ON users.id = offers.seller_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_record_view');
    }
};
