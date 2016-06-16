<?php


class BusinessUnitsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('businessunits')->truncate();
		//1
		BusinessUnit::create([
			'company_id'=> 1,
			'city_id'=> 1,
			'name' => 'DHA Lahore Clinic',
			'address' => 'DHA Lahore',
			'phone' => '+92 42 35252203',
			'fax' => '+92 42 35253405',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.',
		]);

		//2
		BusinessUnit::create([
			'company_id'=> 1,
			'city_id'=> 1,
			'name' => 'Johar Town Clinic',
			'address' => 'Johar Town E-Block',
			'phone' => '+92 42 35752203',
			'fax' => '+92 42 35753405',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.',
		]);

		//3
		BusinessUnit::create([
			'company_id'=> 2,
			'city_id'=> 1,
			'name' => 'Johar Town Hospital',
			'address' => 'Johar Town A-Block',
			'phone' => '+92 42 35567890',
			'fax' => '+92 42 35567891',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.',
		]);

		//4
		BusinessUnit::create([
			'company_id'=> 2,
			'city_id'=> 1,
			'name' => 'DHA Hospital',
			'address' => 'Johar Town A-Block',
			'phone' => '+92 42 35567890',
			'fax' => '+92 42 35567891',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus semper nulla. Integer auctor, tortor nec volutpat feugiat, nisl nunc volutpat odio, sed bibendum nisi dolor sed libero. Etiam id mi tellus. Etiam eu eros efficitur, aliquet elit placerat, sodales neque. Maecenas vehicula scelerisque erat, eget sollicitudin eros luctus a. Nullam ullamcorper nibh sit amet lorem interdum, et feugiat nisl pellentesque. Maecenas ac diam aliquet, ultricies enim sed, sodales dui. Nam tristique eu est nec lobortis. Aliquam tincidunt odio dolor, vel rhoncus felis lobortis id. Morbi sollicitudin lectus sit amet dignissim porta. Donec dictum dapibus mi in hendrerit. Donec ullamcorper fermentum pretium.',
		]);
	}

}