<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSurgicalHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('surgical_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('business_unit_id');
			$table->integer('patient_id');
			$table->string('surgery_name');
			$table->date('surgery_date')->nullable();
			$table->text('surgery_notes')->nullable();
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
		Schema::drop('surgical_histories');
	}

}
