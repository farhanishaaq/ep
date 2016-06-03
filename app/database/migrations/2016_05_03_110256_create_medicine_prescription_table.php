<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinePrescriptionTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_prescription', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id')->unsigned()->nullable();
            $table->integer('prescription_id')->unsigned()->nullable();
            $table->foreign('medicine_id')
                ->references('id')->on('medicines')
                ->onDelete('cascade');
            $table->foreign('prescription_id')
                ->references('id')->on('prescriptions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_prescription', function (Blueprint $table) {
            $table->dropForeign('medicine_prescription_medicine_id_foreign');
            $table->dropForeign('medicine_prescription_prescription_id_foreign');
            Schema::drop('medicine_prescription');
        });
    }

}
