<?php

use App\Globals\GlobalsConst;

class RolesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('roles')->truncate();
		DB::table('role_user')->truncate();
		//1
		$Role = Role::create([
			'name' => 'SuperAdmin',
			'description' => 'It is a SuperAdmin who manages the whole EP Portal',
		]);
		$User = User::find(GlobalsConst::SUPER_ADMIN_ID);
		$User->roles()->attach($Role->id);

		//2
		$Role = Role::create([
			'name' => 'CompanyAdmin',
			'description' => 'It is a Admin for the registered company, who manages his company on EP',
		]);
		$User = User::find(GlobalsConst::COMPANY_ADMIN_ID);
		$User->roles()->attach($Role->id);

		//3
		Role::create([
			'name' => 'PortalUser',
			'description' => 'It is a RegisteredUser into public EP portal',
		]);

		//4
		Role::create([
			'name' => 'PortalDoctor',
			'description' => 'It is a RegisteredUser who is actually a doctor but not the EP company doctor',
		]);

		
	}

}