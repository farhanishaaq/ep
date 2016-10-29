<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('business_unit_id');
			$table->string('name',70);
			$table->integer('available_quantity');
			$table->integer('used_quantity');
			$table->text('description')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->unique(array('name', 'business_unit_id'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('medicines');
	}

}
