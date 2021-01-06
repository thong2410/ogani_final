<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderAndOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->integer('user_id')->unsigned();
            $table->string('full_name');
            $table->string('phone_number',15);
            $table->string('order_email');
            $table->string('order_address');
            $table->string('order_address2');           
            $table->string('order_Note',125)->nullable();           
            $table->enum('order_status', ['processing', 'shipping', 'delivered','cancelled'])->default('processing');
            $table->enum('order_type', ['cod', 'banking'])->default('cod');
            $table->integer('total_price');
            $table->string('coupon')->nullable();

            $table->foreign('user_id')->references('user_id')->on('users');
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('order_detail_id');
            $table->bigInteger('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('unit_price')->unsigned();
            $table->integer('quantity')->unsigned();    

            $table->foreign('order_id')->references('order_id')->on('orders');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_details');
        Schema::drop('orders');
    }
}
