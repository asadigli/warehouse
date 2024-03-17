<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cat_id');
            // $table->foreign('cat_id')->references('id')->on('categories');
            $table->string('product_name');
            $table->text('about');
            $table->string('product_id');
            $table->integer('first_price');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('shipping_quantity');
            $table->string('product_image')->default('default.jpg');
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
        Schema::dropIfExists('products');
    }
}
