<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineMenufacturersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicine_menufacturers', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->string('name',50);
			$table->string('email',30);
			$table->string('cell',16)->nullable();
			$table->string('phone',16)->nullable();
			$table->string('address',255)->nullable();
			$table->text('description')->nullable();
			$table->softDeletes();
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
		Schema::drop('medicine_menufacturers');
	}

}
