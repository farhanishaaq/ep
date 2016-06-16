<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiagonosticproceduresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('diagonosticprocedures', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('patient_id');
			$table->integer('appointment_id');
			$table->text('procedure_note')->nullable();
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
		Schema::drop('diagonosticprocedures');
	}

}
