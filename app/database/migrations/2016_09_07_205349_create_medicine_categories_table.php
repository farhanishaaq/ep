<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicine_categories', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->nullable();
			$table->integer('menufacturer_id');
			$table->string('name',50);
			$table->enum('dosage_form',array_values(GlobalsConst::$DOSAGE_FORMS))->nullable();
			$table->text('description')->nullable();
			$table->enum('is_derived',['Yes','No'])->nullable();
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
		Schema::drop('medicine_categories');
	}

}
