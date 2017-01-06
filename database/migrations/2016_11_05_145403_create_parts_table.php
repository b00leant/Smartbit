<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->integer('hardware_type_id')->unsigned();
            $table->foreign('hardware_type_id')
                ->references('id')
                ->on('hardware_types')
                ->onDelete('cascade');
            $table->increments('id');
            $table->string('nome');
            $table->float('prezzo');
            $table->integer('quantita');
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
        Schema::drop('parts');
    }
}
