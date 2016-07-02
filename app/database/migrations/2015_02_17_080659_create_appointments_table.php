<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('business_unit_id');
			$table->integer('doctor_id');
			$table->integer('patient_id');
			$table->integer('time_slot_id');
			$table->string('title');
			$table->date('date');
			$table->time('time');
			$table->decimal('fee',8,2);
			$table->tinyInteger('status')->default();
			$table->text('checkup_reason')->nullable();
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
		Schema::drop('appointments');
	}

}
