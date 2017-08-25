<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ResourcesRolesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('resource_role')->truncate();
        $xm = Role::all()->count();
		for ($x = 2; $x <= 6; $x++){
            $resourceIds = Resource::all()->lists('id');
            $Role = Role::find($x);

            foreach ($resourceIds as $resourceId){
                $Role->resources()->attach($resourceId, ['status'=>'Allow']);
            }
        }

	}
}