<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCheckupfeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checkupfees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('patient_id');
			$table->integer('appointment_id');
			$table->decimal('checkup_fee',8,2);
			$table->text('fee_note')->nullable();
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
		Schema::drop('checkupfees');
	}

}
