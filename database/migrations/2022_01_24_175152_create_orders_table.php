<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address', 100);
            // order_placed, prep, make, quality_check, out for delivery
            $table->string('status', 50)->nullable();
            $table->unsignedInteger('food_id')->nullable();
            $table->unsignedInteger('buyer_id')->nullable();
            $table->foreign('food_id')->references('id')->on('food');
            $table->foreign('buyer_id')->references('id')->on('users');
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
        Schema::dropIfExists('orders');
    }
}
