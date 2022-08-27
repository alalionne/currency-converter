<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('currency_id_from')->unsigned()->nullable();
            $table->foreign('currency_id_from')->references('id')->on('currencies');
            $table->bigInteger('currency_id_to')->unsigned()->nullable();
            $table->foreign('currency_id_to')->references('id')->on('currencies');
            $table->string('rate');
            $table->integer('exchange_number')->default(0);
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
        Schema::dropIfExists('pairs');
    }
};
