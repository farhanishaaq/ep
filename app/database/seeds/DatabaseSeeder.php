<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CountriesTableSeeder');
		$this->command->info('Countries Table seeded!');

		$this->call('StatesTableSeeder');
		$this->command->info('States Table seeded!');

		$this->call('CitiesTableSeeder');
		$this->command->info('Cities Table seeded!');

        $this->call('CompaniesTableSeeder');
        $this->command->info('Companies Table seeded!');

		$this->call('BusinessUnitsTableSeeder');
        $this->command->info('BusinessUnits Table seeded!');

		$this->call('UsersTableSeeder');
        $this->command->info('Users, Employees and Patients Tables seeded!');

		$this->call('RolesTableSeeder');
        $this->command->info('Roles Table seeded!');

		$this->call('ResourcesTableSeeder');
        $this->command->info('Resources Table seeded!');

		$this->call('ResourcesRolesTableSeeder');
        $this->command->info('ResourcesRoles Table seeded!');
		
	}

}
