<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterResourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("ALTER TABLE resources CHANGE COLUMN `type` `type` ENUM('Module', 'Group', 'Controller', 'Action')");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement("ALTER TABLE resources CHANGE COLUMN `type` `type` ENUM('Module', 'Controller', 'Action')");
	}

}
