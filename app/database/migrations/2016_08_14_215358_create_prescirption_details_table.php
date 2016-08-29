<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Globals\GlobalsConst;
class CreatePrescirptionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//it is not required drop it before to create new
		Schema::drop('medicine_prescription');

		Schema::create('prescription_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('prescription_id');
			$table->integer('medicine_id');
			$table->enum('usage_type',array_values(GlobalsConst::$USAGE_TYPES))->nullable();
			$table->enum('dosage_strength',array_values(GlobalsConst::$DOSAGE_STRENGTHS))->nullable();
			$table->integer('usage_quantity');
			$table->enum('quantity_unit',array_values(GlobalsConst::$DOSE_QTY_UNIT));
			$table->string('frequencies',1024);//json string will handle it
			$table->string('conditional_note')->nullable();
			$table->text('extra_note')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//****
		Schema::drop('prescription_details');
		Schema::create('medicine_prescription', function(Blueprint $table)
		{
			$table->increments('id');
		});

	}

}
