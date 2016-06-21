<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use App\Globals\GlobalsConst;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();
		DB::table('employees')->truncate();
		DB::table('patients')->truncate();
		//For Super Admin (1)
		User::create([
			'city_id'=> GlobalsConst::LAHORE_OF_PAK,
			'username'=> 'superAdmin',
			'email'=> 'superAdmin@easyphysicians.com',
			'password'=> Hash::make('superAd123456'),
			'fname'=> 'Rashid',
			'lname'=> 'Hussain',
			'dob'=> '1988-12-01',
			'cnic'=> '35200-1478048-1',
			'gender'=> 'Male',
			'status'=> 'Active',
		]);

		//For Admin (2)
		$user = User::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'city_id'=> GlobalsConst::LAHORE_OF_PAK,
			'username'=> 'adminD1',
			'email'=> 'admin@easyphysicians.com',
			'password'=> Hash::make('admin123456'),
			'fname'=> 'Ahmad',
			'lname'=> 'Raza',
			'dob'=> '1988-12-01',
			'cnic'=> '35200-1478048-1',
			'gender'=> 'Male',
			'status'=> 'Active',
		]);
		Employee::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'user_id'=> $user->id,
			'joining_date'=> '2013-04-15',
			'joining_salary'=> 25000,
			'current_salary'=> 35000,
		]);

		//For Admin of EP_DEMO_COMPANY_TWO (3)
		$user = User::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_TWO,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_THREE,
			'city_id'=> GlobalsConst::LAHORE_OF_PAK,
			'username'=> 'adminD2',
			'email'=> 'adminTwo@easyphysicians.com',
			'password'=> Hash::make('admin123456'),
			'fname'=> 'Atif',
			'lname'=> 'Khan',
			'dob'=> '1988-12-01',
			'cnic'=> '35200-1478048-1',
			'gender'=> 'Male',
			'status'=> 'Active',
		]);
		Employee::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'user_id'=> $user->id,
			'joining_date'=> '2013-04-15',
			'joining_salary'=> 25000,
			'current_salary'=> 35000,
		]);
		$this->addFakerData();
	}

	private function addFakerData(){
		$faker = Faker::create();
		$businessUnits = BusinessUnit::all()->lists('id');
		$cities = City::all()->lists('id');
		$i = 0;
		$j = 0;
		foreach(range(1, 10) as $index)
		{
			//*** for $businessUnits
			if(isset($businessUnits[$i])){
				$id = $businessUnits[$i];
			}else{
				$i = 0;
				$id = $businessUnits[$i];
			}
			$BusinessUnitObj = BusinessUnit::find($id);
			$businessUnitId = $BusinessUnitObj->id;
			$companyId = $BusinessUnitObj->company->id;


			//*** for $cities
			if(isset($cities[$j])){
				$cid = $cities[$j];
			}else{
				$j = 0;
				$cid = $cities[$j];
			}
			$CityObj = City::find($cid);
			$cityId = $CityObj->id;

			$user = User::create([
				'company_id' => $companyId,
				'business_unit_id'=> $businessUnitId,
				'city_id'=> $cityId,
				'email'=> $faker->unique()->email,
				'username'=> $faker->username,
				'password'=> Hash::make('123456'),
				'fname'=> $faker->firstName,
				'lname'=> $faker->lastName,
				'dob'=> $faker->dateTimeThisCentury->format('Y-m-d'),
				'cnic'=> '35200-'.$faker->numberBetween(1469067,3000000).'-' .$faker->numberBetween(0,9),
				'gender'=> $faker->randomElement(['Male','Female']),
				'address'=> $faker->address,
				'cell'=> $faker->phoneNumber,
				'status'=> $faker->randomElement(['Active','Inactive']),
			]);

			if($index < 9) {
				Employee::create([
					'company_id' => $companyId,
					'business_unit_id'=> $businessUnitId,
					'user_id'=> $user->id,
					'joining_date'=> $faker->dateTimeThisDecade,
					'joining_salary'=> $faker->numberBetween($min = 5000, $max = 15000),
					'current_salary'=> $faker->numberBetween($min = 10000, $max = 25000),
				]);
			}else{
				Patient::create([
					'user_id'=> $user->id,
				]);
			}

			$i++;
			$j++;
		}
	}
}