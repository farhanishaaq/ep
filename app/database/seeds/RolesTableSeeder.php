<?php

use App\Globals\GlobalsConst;

class RolesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('roles')->truncate();
		DB::table('role_user')->truncate();

		//1
		$Role = Role::create([
			'name' => 'Super Admin',
			'description' => 'It is a SuperAdmin who manages the whole EP Portal',
		]);
		$User = User::find(GlobalsConst::SUPER_ADMIN_ID);
		$User->roles()->attach($Role->id);

		//2
		$Role = Role::create([
			'name' => 'Company Admin',
			'description' => 'It is a Admin for the registered company, who manages his company on EP',
		]);
		$User = User::find(GlobalsConst::COMPANY_ADMIN_ID);
		$User->roles()->attach($Role->id);

		//3
		Role::create([
			'name' => 'Portal User',
			'description' => 'It is a Registered User into public EP portal',
		]);

		//4
		Role::create([
			'name' => 'Portal Doctor',
			'description' => 'It is a Registered User who is actually a doctor but not the EP company doctor',
		]);

		//5
		Role::create([
			'name' => 'Company Doctor',
			'description' => 'It is a Employee of the registered company who perform his job as a Doctor',
		]);

		//6
		Role::create([
			'name' => 'Receptionist',
			'description' => 'It is an Employee of the registered company who perform his job as a Receptionist',
		]);

		//7
		Role::create([
			'name' => 'Nurse',
			'description' => 'It is an Employee of the registered company who perform his job as a Nurse',
		]);

		//8
		Role::create([
			'name' => 'Accountant',
			'description' => 'It is an Employee of the registered company who perform his job as a Nurse',
		]);

		
	}

}