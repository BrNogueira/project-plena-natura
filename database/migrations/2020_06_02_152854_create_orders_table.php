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
            $table->bigIncrements('id');
            $table->string('shipping_zipcode', 255);
            $table->string('shipping_street', 255);
            $table->string('shipping_address2', 255);
            $table->string('shipping_number', 255);
            $table->string('shipping_city', 255);
            $table->string('shipping_shipping_type', 255);
            $table->string('payment_method', 255);
            $table->string('payment_gateway', 255);
            $table->float('shipping_total', 8, 2);
            $table->float('sub_total', 8, 2);
            $table->float('total', 8, 2);
            $table->float('coupon', 8, 2)->nullable();



            $table->bigInteger('order_status_id');
            $table->bigInteger('user_id');
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
