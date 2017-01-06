<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicalSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('citta');
            $table->string('nome');
            $table->string('brand');
            /*
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')
                ->references('id')->on('brands')->onDelete('cascade');
            */
            $table->string('indirizzo');
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
        Schema::drop('technical_supports');
    }
}
