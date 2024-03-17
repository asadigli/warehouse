<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returnsale', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->integer('quantity');
            $table->integer('return_price');
            $table->integer('sale_id');
            $table->date('return_date');
            $table->string('availability')->default('useful');
            $table->integer('status')->default(0);
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('returnsale');
    }
}
