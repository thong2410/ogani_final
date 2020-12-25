<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('cate_id')->unsigned();
            $table->integer('thumb_id')->unsigned();
            $table->string('prod_name', 125);
            $table->integer('unit_price')->unsigned();
            $table->integer('sale')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->enum('status', ['normal', 'feature'])->default('normal');
            $table->string('unit', 100);
            $table->text('content');
            $table->json('detail');
            $table->string('seo_title', 150);
            $table->mediumText('seo_description');
            $table->mediumText('seo_keywords');
            $table->timestamps();

            $table->foreign('cate_id')->references('cate_id')->on('categories');
            $table->foreign('thumb_id')->references('id')->on('media');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
