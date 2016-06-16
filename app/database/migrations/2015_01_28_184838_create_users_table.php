<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id')->nullable();
			$table->integer('business_unit_id')->nullable();
			$table->integer('city_id')->nullable();
			$table->string('username',60)->unique();
			$table->string('email',60)->unique();
			$table->string('password', 128);
			$table->enum('user_type',['SiteUser', 'Doctor', 'Company'])->nullable();
			$table->date('dob')->nullable();
			$table->string('cnic',15)->nullable();//35200-1469067-9
			$table->enum('gender',['Male','Female'])->nullable();
			$table->string('address', 255)->nullable();
			$table->string('cell',16)->nullable();
			$table->string('phone',16)->nullable();
			$table->enum('status',['Active','Inactive'])->default('Active');
			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();

//			$table->unique(array('email', 'company_id'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
