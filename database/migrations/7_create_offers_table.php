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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seller_id')->unsigned();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->string('item_name', 140);
            $table->string('category', 100);
            $table->string('brand', 100);
            $table->string('description', 8000);
            $table->date('put_up_on');
            $table->string('shipper');
            $table->decimal('price', 10, 2);
            $table->binary('pictures');
            $table->string('condition');
        });
        
        Schema::table('offers', function (Blueprint $table) {
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
};
