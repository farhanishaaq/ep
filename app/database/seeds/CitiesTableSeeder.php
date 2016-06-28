<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CitiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('cities')->truncate();
		//Punjab Cities
		//1
		City::create([
			'state_id' => 1,
			'name' => 'Lahore'
		]);
		//2
		City::create([
			'state_id' => 1,
			'name' => 'Islamabad'
		]);
		//3
		City::create([
			'state_id' => 1,
			'name' => 'Rawalpindi'
		]);
		//4
		City::create([
			'state_id' => 1,
			'name' => 'Faisalabad'
		]);
		//5
		City::create([
			'state_id' => 1,
			'name' => 'Sialkot'
		]);

		//Sindh Cities
		//6
		City::create([
			'state_id' => 2,
			'name' => 'Karachi'
		]);

		//Balochistan Cities
		//7
		City::create([
			'state_id' => 3,
			'name' => 'Quetta'
		]);

		//KPK Cities
		//8
		City::create([
			'state_id' => 4,
			'name' => 'Pashawer'
		]);

		//KPK Cities
		//9
		City::create([
			'state_id' => 5,
			'name' => 'Dubai'
		]);
		//10
		City::create([
			'state_id' => 6,
			'name' => 'Abu Dhabi'
		]);
	}

}