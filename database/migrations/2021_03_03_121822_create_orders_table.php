<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) 
        {
            $table->text('order_id');
            $table->integer('order_number');
            $table->timestamp('order_date');
            $table->integer('weight');
            $table->integer('quantity');
            $table->text('product');
            $table->text('shipping');
            $table->text('tracking_id')->nullable();
            $table->boolean('fulfilled');
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
