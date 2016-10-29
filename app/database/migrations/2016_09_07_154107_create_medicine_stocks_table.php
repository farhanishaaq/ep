<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicine_stocks', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('medicine_id');
			$table->integer('business_unit_id');
			$table->integer('location_id');
			$table->integer('minimum_quantity')->default(5);
			$table->integer('quantity');
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
		Schema::drop('medicine_stocks');
	}

}
