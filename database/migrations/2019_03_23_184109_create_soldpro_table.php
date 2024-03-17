<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoldproTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soldpro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller');
            $table->string('product_id');
            $table->date('date');
            $table->string('contact_number')->nullable();
            $table->string('buyer')->nullable();
            $table->integer('quantity');
            $table->integer('sold_price');
            $table->integer('first_price');
            $table->string('token')->unique();
            $table->integer('verified')->default('0');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('soldpro');
    }
}
