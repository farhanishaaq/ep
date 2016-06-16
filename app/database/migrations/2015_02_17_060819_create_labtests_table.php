<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabtestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('labtests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('patient_id');
			$table->integer('appointment_id');
			$table->string('test_name',60);
			$table->decimal('test_fee',8,2)->nullable();
			$table->text('test_description')->nullable();
			$table->text('test_results');
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
		Schema::drop('labtests');
	}

}
