<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVitalsignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vitalsigns', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('patient_id');
			$table->integer('appointment_id');
			$table->smallInteger('weight')->nullable();//In pound
			$table->smallInteger('height')->nullable();//In cm
			$table->integer('bp_systolic')->nullable();// 120/80 mmHg (120 over 80). So 120 is systolic
			$table->integer('bp_diastolic')->nullable();// 120/80 mmHg (120 over 80). So 80 is diastolic
			$table->string('blood_group', 3)->nullable();
			$table->string('pulse_rate')->nullable();//heartbeats per minute
			$table->string('respiration_rate')->nullable();//breaths per minute
			$table->integer('temperature')->nullable();//In fahrenheit
			$table->text('note');
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
		Schema::drop('vitalsigns');
	}

}
