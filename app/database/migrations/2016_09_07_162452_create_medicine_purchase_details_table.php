<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinePurchaseDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicine_purchase_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('purchase_id');
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
		Schema::drop('medicine_purchase_details');
	}

}
