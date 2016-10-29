<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDutyDaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('duty_days', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('doctor_id')->nullable();
			$table->string('day')->nullable();
			$table->time('start')->nullable();
			$table->time('end')->nullable();
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
		Schema::drop('duty_days');
	}

}
