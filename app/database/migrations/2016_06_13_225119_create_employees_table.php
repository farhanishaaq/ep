<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('business_unit_id');
			$table->integer('user_id');
			$table->string('fname',60)->nullable();
			$table->string('lname',60)->nullable();
			$table->date('joining_date')->nullable();
			$table->date('quite_date')->nullable();
			$table->decimal('joining_salary',8,2)->nullable();
			$table->decimal('current_salary',8,2)->nullable();
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
		Schema::drop('employees');
	}

}
