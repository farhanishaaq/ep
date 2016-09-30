<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineSaleDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicine_sale_details', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('sale_id');
			$table->integer('medicine_id');
			$table->integer('unit_price');
			$table->integer('quantity');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('medicine_sale_details');
	}

}
