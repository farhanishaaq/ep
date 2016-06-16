<?php

use App\Globals\GlobalsConst;

class RolesTableSeeder extends Seeder {

	public function run()
	{
		//1
		Role::create([
			'name' => 'SuperAdmin',
			'description' => 'It is a SuperAdmin who manages the whole EP Portal',
		]);

		//2
		Role::create([
			'name' => 'SiteUser',
			'description' => 'It is a RegisteredUser into public EP portal, who manages his public sites',
		]);

		//3
		Role::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'name' => 'Admin',
			'description' => 'It is a Admin for the registered company, who manages his company on EP',
		]);

		//4
		Role::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_TWO,
			'name' => 'Admin',
			'description' => 'It is a Admin for the registered company, who manages his company on EP',
		]);

		
	}

}