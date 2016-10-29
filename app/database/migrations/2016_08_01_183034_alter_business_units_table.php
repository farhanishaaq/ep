<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Globals\GlobalsConst;
class AlterBusinessUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_units', function($table) {
			$table->enum('is_main',[GlobalsConst::YES,GlobalsConst::NO])->default(GlobalsConst::NO);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_units', function($table) {
			$table->dropColumn('is_main');
		});
	}

}
