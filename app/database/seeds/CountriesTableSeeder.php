<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CountriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('countries')->truncate();
		//1
		Country::create([
			'name' => 'Pakistan'
		]);
		//2
		Country::create([
			'name' => 'United Arab Emirates'
		]);
		//3
		Country::create([
			'name' => 'United Kingdom'
		]);
		//4
		Country::create([
			'name' => 'United States'
		]);
		//5
		Country::create([
			'name' => 'Afghanistan'
		]);
		//6
		Country::create([
			'name' => 'China'
		]);
	}
}