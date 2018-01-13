<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('medicine_data', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('SETID');
            $table->string('SPL_VERSION');
            $table->string('PRODUCT_NAME');
            $table->string('	PRODUCT_CODE');
            $table->string('	NDC');
            $table->string('PACKAGE_DESCRIPTION');
            $table->string('FORM_CODE');
            $table->string('PRODUCT_NUMBER');
            $table->string('	PART_YN');
            $table->string('	TOTAL_PRODUCT_QUANTITY');
            $table->string('STRENGTH');
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
		//
	}

}
