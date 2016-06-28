<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resource_role', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resource_id');
			$table->integer('role_id');
			$table->enum('status', ['Allow', 'Deny', 'Indeterminate']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resource_role');
	}

}
