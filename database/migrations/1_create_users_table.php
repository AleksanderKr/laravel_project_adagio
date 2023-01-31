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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 80);
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->string('telephone', 20);
            $table->string('NIP', 20);
            $table->string('password', 128);
            $table->string('salt', 254);
            $table->string('email', 80);
            $table->date('join_date');
            $table->rememberToken();
            $table->boolean('role'); # 0 - user, 1 - admin
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
