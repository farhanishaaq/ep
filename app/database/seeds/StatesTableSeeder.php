<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class StatesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('states')->truncate();
		//UAE States/Provinces
		//1
		State::create([
			'country_id' => 1,
			'name' => 'Punjab'
		]);
		//2
		State::create([
			'country_id' => 1,
			'name' => 'Sindh'
		]);
		//3
		State::create([
			'country_id' => 1,
			'name' => 'Blochistan'
		]);
		//4
		State::create([
			'country_id' => 1,
			'name' => 'Khaiber Pakhtoon Khan'
		]);

		//UAE States
		//5
		State::create([
			'country_id' => 2,
			'name' => 'Dubai'
		]);
		//6
		State::create([
			'country_id' => 2,
			'name' => 'Abu Dhabi'
		]);
		//7
		State::create([
			'country_id' => 2,
			'name' => 'Sharjah'
		]);
		//8
		State::create([
			'country_id' => 2,
			'name' => 'Fujairah'
		]);
		//9
		State::create([
			'country_id' => 2,
			'name' => 'Umm al-Quwain'
		]);
	}

}