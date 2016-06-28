<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('companies')->truncate();
		//1
        Company::create([
			'city_id'=> 1,
            'name' => 'EP Clinic',
            'company_type' => 'Clinic',
            'address' => 'DHA Lahore',
            'phone' => '+92 42 36852203',
            'fax' => '+92 42 36853405',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.',
        ]);

		//2
		Company::create([
			'city_id'=> 1,
			'name' => 'EP Hospital',
			'company_type' => 'Hospital',
			'address' => 'DHA Lahore',
			'phone' => '+92 42 36852203',
			'fax' => '+92 42 36853405',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.',
		]);
	}

}