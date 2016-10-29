<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MedicinesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('medicines')->truncate();
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Medicine::create([
				'company_id' => \App\Globals\GlobalsConst::EP_DEMO_COMPANY_ONE,
				'business_unit_id'=> \App\Globals\GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
				'name' => 'Panadol',
				'available_quantity' => 1000,
				'used_quantity' => 0
			]);

			Medicine::create([
				'company_id' => \App\Globals\GlobalsConst::EP_DEMO_COMPANY_ONE,
				'business_unit_id'=> \App\Globals\GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
				'name' => 'Ciproxin',
				'available_quantity' => 1000,
				'used_quantity' => 0
			]);

			Medicine::create([
				'company_id' => \App\Globals\GlobalsConst::EP_DEMO_COMPANY_ONE,
				'business_unit_id'=> \App\Globals\GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
				'name' => 'Ciproxin',
				'available_quantity' => 1000,
				'used_quantity' => 0
			]);
		}
	}

}