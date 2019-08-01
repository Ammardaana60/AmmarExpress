<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id');
         $table->unsignedBigInteger('order_id')->nullable();
         $table->foreign('user_id')->references('id')->on('users');
         $table->foreign('order_id')->references('id')->on('orders');
         $table->integer('country_id');
         $table->integer('city_id');
         $table->integer('postal_code');
         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
