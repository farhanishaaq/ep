<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Globals\GlobalsConst;
class RecreateMedicinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//old one should drop
		Schema::drop('medicines');



		Schema::create('medicines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->string('name',70);
			$table->text('description')->nullable();
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
		//****don't drop it here
//		Schema::drop('medicines');
	}

}
