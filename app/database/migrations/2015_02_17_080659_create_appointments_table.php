<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use \App\Globals\GlobalsConst;
class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('business_unit_id');
			$table->integer('doctor_id');
			$table->integer('patient_id');
			$table->integer('time_slot_id');
			$table->string('code')->nullable();
			$table->date('date');
			$table->time('time');
			$table->enum('payment_status', array_values(GlobalsConst::$PAYMENT_STATUS))->nullable();
			$table->decimal('expected_fee', 8,2)->default(0);
			$table->decimal('discount_amount', 8,2)->default(0);
			$table->decimal('paid_fee', 8,2)->default(0);
			$table->tinyInteger('status')->default();
			$table->enum('reason_type', array_values(GlobalsConst::$CHECK_UP_REASONS) );
			$table->text('checkup_detail')->nullable();
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
		Schema::drop('appointments');
	}

}
