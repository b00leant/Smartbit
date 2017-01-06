<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('devices', function(Blueprint $table)
        {
            //$table->dropForeign(['repair_id']);
            $table->integer('repair_id')->unsigned()->nullable();
            $table->foreign('repair_id')->references('id')->on('repairs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        //Schema::disableForeignKeyConstraints();
        Schema::table('devices', function ($table) {
            
            $table->dropForeign(['repair_id']);
            $table->dropColumn('repair_id');
        });
        Schema::table('repairs', function ($table) {
            $table->dropForeign(['device_id']);
            $table->dropForeign(['person_id']);
            
        });
        
        
    }
}
