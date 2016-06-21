<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreviousDiseasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('previous_diseases', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('business_unit_id');
			$table->integer('patient_id');
			$table->string('disease_name')->nullable();
			$table->text('disease_notes')->nullable();
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
		Schema::drop('previous_diseases');
	}

}
