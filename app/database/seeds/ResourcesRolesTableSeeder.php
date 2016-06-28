<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ResourcesRolesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('resource_role')->truncate();
		$resourceIds = Resource::all()->lists('id');
		$Role = Role::find(\App\Globals\GlobalsConst::COMPANY_ADMIN_ROLE);

		foreach ($resourceIds as $resourceId){
			$Role->resources()->attach($resourceId, ['status'=>'Allow']);
		}
	}
}