<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRatingLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rating_logs', function($table)
		{
					$table->dropColumn('raring')->nullable();

					$table->string('rating')->nullable();
					$table->string('title')->nullable();
					$table->string('description')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rating_logs', function($table)
		{
			$table->string('raring');

			$table->dropColumn('rating')->nullable();
			$table->dropColumn('title')->nullable();
			$table->dropColumn('description')->nullable();
		});
	}

}
