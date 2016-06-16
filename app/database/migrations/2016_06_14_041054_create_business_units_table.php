<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('businessUnits', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id')->nullable();
			$table->integer('city_id')->nullable();
			$table->string('name',60);
			$table->string('address', 255)->nullable();
			$table->string('phone',18)->nullable();//+92 42 36857203
			$table->string('fax',16)->nullable();//+92 42 36857203
			$table->string('description',1024)->nullable();//+92 42 36857203
			$table->timestamps();
			$table->softDeletes();

			$table->unique(array('name', 'company_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('businessUnits');
	}

}
