<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SkillTableSeederTableSeeder extends Seeder {

	public function run()
	{
        DB::table('skills')->truncate();
        //1
        Qualification::create([
            'name' => 'MBBS',
            ';' => 'Bachelor of Medicine',
            'description' => 'MBBS is an abbreviation for Medicinae Baccalaureus, Baccalaureus Chirurgiae, or Bachelor of Medicine, Bachelor of Surgery in English, a primary medical qualification.'
        ]);
	}

}