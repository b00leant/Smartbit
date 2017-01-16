<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCenterRestrictionToRepairs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repairs', function (Blueprint $table) {
            //
            $table->integer('technical_support_id')->unsigned()->nullable();
            $table->foreign('technical_support_id')->references('id')->on('technical_supports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repairs', function (Blueprint $table) {
            //
            $table->dropForeign(['technical_support_id']);
            $table->dropColumn('technical_support_id');
        });
    }
}
