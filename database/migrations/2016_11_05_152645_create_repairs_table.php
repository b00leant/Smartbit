<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seriale',10)->nullable();//ma lo devo rimuovere qrcode!
            $table->integer('person_id')->unsigned()->index()->nullable();
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->string('stato')->nullable();
            $table->date('creazione')->nullable();
            $table->date('inizio')->nullable();
            $table->date('spedizione')->nullable();
            $table->date('fine')->nullable();
            $table->date('ritiro')->nullable();
            $table->date('consegna')->nullable();
            $table->integer('device_id')->unsigned()->nullable();
            $table->foreign('device_id')
                ->references('id')
                ->on('devices')
                ->onDelete('cascade');
            $table->integer('delivery_id')->unsigned()->nullable();
            $table->foreign('delivery_id')->references('id')
                ->on('deliveries')->onDelete('cascade');
            $table->boolean('assistenza')
                ->default(false)->nullable();
            $table->boolean('garanzia')
                ->default(false)->nullable();
            $table->longText('note')->nullable();
            $table->longText('note_lab')->nullable();
            $table->float('prezzo')->nullable();
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
        //Schema::table('repairs',function(Blueprint $table){
        //    $table->dropForeign(['device_id']);
        //    $table->dropForeign(['person_id']);
        //});
        Schema::drop('repairs');
    }
}
