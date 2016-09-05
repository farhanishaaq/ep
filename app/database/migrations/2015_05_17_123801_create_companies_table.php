<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('city_id')->nullable();
            $table->string('name',60)->unique();
            $table->enum('company_type', ['Hospital','Clinic']);
			$table->string('address', 255)->nullable();
			$table->string('phone',18)->nullable();//+92 42 36857203
			$table->string('fax',18)->nullable();//+92 42 36857203
			$table->string('description',1024)->nullable();//+92 42 36857203
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
		Schema::drop('companies');
	}

}
