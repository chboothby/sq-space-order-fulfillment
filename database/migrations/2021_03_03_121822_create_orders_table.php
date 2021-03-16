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
            $table->text('delivery_contact_name');
            $table->text('delivery_addressline1');
            $table->text('delivery_addressline2')->nullable();
            $table->text('delivery_post_code');
            $table->text('notification_sms');
            $table->text('notification_email');
            $table->boolean('courier_informed')->default(false);
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
