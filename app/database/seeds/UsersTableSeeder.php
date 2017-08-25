<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use App\Globals\GlobalsConst;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();
		DB::table('employees')->truncate();
		DB::table('doctors')->truncate();
		DB::table('patients')->truncate();

		//For Super Admin (1)
		$this->addSuperAdmin();

		//For Admin (2)
		$this->addAdmin();

		//For Doctor (3)
		$this->addDoctor();

		//For Receptionist (4)
		$this->addReceptionist();

		//For Nurse (5)
		$this->addNurse();

		//For Accountant (6)
		$this->addAccountant();

		//For Admin of EP_DEMO_COMPANY_TWO (7)
		$user = User::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_TWO,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_THREE,
			'city_id'=> GlobalsConst::LAHORE_OF_PAK,
			'username'=> 'adminD2',
			'email'=> 'adminTwo@easyphysicians.com',
			'password'=> Hash::make('ep123456'),
			'fname'=> 'Atif',
			'lname'=> 'Khan',
			'full_name'=> 'Atif Khan',
			'user_type'=> 'Admin',
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

		//(7+10)
		$this->addFakerData();
	}


	private function addSuperAdmin(){
		$user = User::create([
			'city_id'=> GlobalsConst::LAHORE_OF_PAK,
			'username'=> 'superAdmin',
			'email'=> 'superAdmin@easyphysicians.com',
			'password'=> Hash::make('ep123456'),
			'fname'=> 'Rashid',
			'lname'=> 'Hussain',
			'full_name'=> 'Rashid Hussain',
			'user_type'=> 'Super Admin',
			'dob'=> '1988-12-01',
			'cnic'=> '35200-1478048-1',
			'gender'=> 'Male',
			'status'=> 'Active',
		]);
//        $Role = Role::find(GlobalsConst::SUPER_ADMIN_ID);
//        $Role->users()->attach($user->id);
	}

	private function addAdmin(){
		$user = User::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'city_id'=> GlobalsConst::LAHORE_OF_PAK,
			'username'=> 'adminD1',
			'email'=> 'admin@easyphysicians.com',
			'password'=> Hash::make('ep123456'),
			'fname'=> 'Ahmad',
			'lname'=> 'Raza',
			'full_name'=> 'Ahmad Raza',
			'user_type'=> 'Admin',
			'dob'=> '1988-12-01',
			'cnic'=> '35200-1478048-1',
			'gender'=> 'Male',
			'status'=> 'Active',
		]);
        $Role = Role::find(GlobalsConst::COMPANY_ADMIN_ID);
        $Role->users()->attach($user->id);
		Employee::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'user_id'=> $user->id,
			'joining_date'=> '2013-04-15',
			'joining_salary'=> 25000,
			'current_salary'=> 35000,
		]);
	}

	private function addDoctor(){
		$user = User::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'city_id'=> GlobalsConst::LAHORE_OF_PAK,
			'username'=> 'doctor',
			'email'=> 'doctor@easyphysicians.com',
			'password'=> Hash::make('ep123456'),
			'fname'=> 'Ehsaan',
			'lname'=> 'Ali',
			'full_name'=> 'Ehsaan Ali',
			'user_type'=> 'Doctor',
			'dob'=> '1988-12-01',
			'cnic'=> '35200-1478048-1',
			'gender'=> 'Male',
			'status'=> 'Active',
		]);
        $Role = Role::find(GlobalsConst::DOCTOR_ID);
        $Role->users()->attach($user->id);
//		$doctorRole = 1;
//		$user->roles()->attach($doctorRole);
		$employee = Employee::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'user_id'=> $user->id,
			'joining_date'=> '2013-04-15',
			'joining_salary'=> 25000,
			'current_salary'=> 35000,
		]);
		$doctor = Doctor::create([
			'user_id'=> $user->id,
			'employee_id'=> $employee->id,
			'min_fee'=> 200,
			'max_fee'=> 1000,
		]);
		$medicalSpecialties = 1;
		$qualifications = [1,9];
		$doctor->medicalSpecialties()->attach($medicalSpecialties);
		$doctor->qualifications()->attach($qualifications);
		$doctor->qualifications()->attach($qualifications);
	}

	private function addReceptionist(){
		$user = User::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'city_id'=> GlobalsConst::LAHORE_OF_PAK,
			'username'=> 'receptionist',
			'email'=> 'receptionist@easyphysicians.com',
			'password'=> Hash::make('ep123456'),
			'fname'=> 'Rafia',
			'lname'=> 'Khan',
			'full_name'=> 'Rafia Khan',
			'user_type'=> 'Employee',
			'dob'=> '1988-12-01',
			'cnic'=> '35200-1478048-1',
			'gender'=> 'Female',
			'status'=> 'Active',
		]);
		$receptionistRole = 5;
		$user->roles()->attach($receptionistRole);

		Employee::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'user_id'=> $user->id,
			'joining_date'=> '2013-04-15',
			'joining_salary'=> 25000,
			'current_salary'=> 35000,
		]);
	}

	private function addAccountant(){
		$user = User::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'city_id'=> GlobalsConst::LAHORE_OF_PAK,
			'username'=> 'accountant',
			'email'=> 'accountant@easyphysicians.com',
			'password'=> Hash::make('ep123456'),
			'fname'=> 'Umer',
			'lname'=> 'Khan',
			'full_name'=> 'Umer Khan',
			'user_type'=> 'Employee',
			'dob'=> '1988-12-01',
			'cnic'=> '35200-1478048-1',
			'gender'=> 'Female',
			'status'=> 'Active',
		]);
		$accountantRole = 6;
		$user->roles()->attach($accountantRole);
		Employee::create([
			'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
			'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
			'user_id'=> $user->id,
			'joining_date'=> '2013-04-15',
			'joining_salary'=> 25000,
			'current_salary'=> 35000,
		]);
	}


    private function addNurse(){
        $user = User::create([
            'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
            'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
            'city_id'=> GlobalsConst::LAHORE_OF_PAK,
            'username'=> 'nurse',
            'email'=> 'nurse@easyphysicians.com',
            'password'=> Hash::make('ep123456'),
            'fname'=> 'Shaziya',
            'lname'=> 'Tariq',
            'full_name'=> 'Shaziya Tariq',
            'user_type'=> 'Employee',
            'dob'=> '1988-12-01',
            'cnic'=> '35200-1478048-1',
            'gender'=> 'Female',
            'status'=> 'Active',
        ]);
        $nurseRole = 7;
        $user->roles()->attach($nurseRole);
        Employee::create([
            'company_id' => GlobalsConst::EP_DEMO_COMPANY_ONE,
            'business_unit_id'=> GlobalsConst::EP_DEMO_BUSINESS_UNIT_ONE,
            'user_id'=> $user->id,
            'joining_date'=> '2013-04-15',
            'joining_salary'=> 25000,
            'current_salary'=> 35000,
        ]);
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



            if($index < 9) {
                $user = User::create([
                    'company_id' => $companyId,
                    'business_unit_id'=> $businessUnitId,
                    'city_id'=> $cityId,
                    'email'=> $faker->unique()->email,
                    'username'=> $faker->username,
                    'password'=> Hash::make('ep123456'),
                    'fname'=> $faker->firstName,
                    'lname'=> $faker->lastName,
                    'full_name'=> $faker->firstName.' '.$faker->lastName,
                    'user_type'=> $faker->randomElement(['Doctor']),
                    'dob'=> $faker->dateTimeThisCentury->format('Y-m-d'),
                    'cnic'=> '35200-'.$faker->numberBetween(1469067,3000000).'-' .$faker->numberBetween(0,9),
                    'gender'=> $faker->randomElement(['Male','Female']),
                    'address'=> $faker->address,
                    'cell'=> $faker->phoneNumber,
                    'status'=> $faker->randomElement(['Active']),
                ]);
                $employee = Employee::create([
                    'company_id' => $companyId,
                    'business_unit_id'=> $businessUnitId,
                    'user_id'=> $user->id,
                    'joining_date'=> $faker->dateTimeThisDecade,
                    'joining_salary'=> $faker->numberBetween($min = 5000, $max = 15000),
                    'current_salary'=> $faker->numberBetween($min = 10000, $max = 25000),
                ]);
                Doctor::create([
                    'user_id' => $user->id,
                    'employee_id' => $employee->id,
                    'min_fee'=> $faker->numberBetween($min = 200, $max = 800),
                    'max_fee'=> $faker->numberBetween($min = 800, $max = 3000),
                ]);
            }else{
                $user = User::create([
                    'company_id' => $companyId,
                    'business_unit_id'=> $businessUnitId,
                    'city_id'=> $cityId,
                    'email'=> $faker->unique()->email,
                    'username'=> $faker->username,
                    'password'=> Hash::make('ep123456'),
                    'fname'=> $faker->firstName,
                    'lname'=> $faker->lastName,
                    'full_name'=> $faker->firstName.' '.$faker->lastName,
                    'user_type'=> $faker->randomElement(['Patient']),
                    'dob'=> $faker->dateTimeThisCentury->format('Y-m-d'),
                    'cnic'=> '35200-'.$faker->numberBetween(1469067,3000000).'-' .$faker->numberBetween(0,9),
                    'gender'=> $faker->randomElement(['Male','Female']),
                    'address'=> $faker->address,
                    'cell'=> $faker->phoneNumber,
                    'status'=> $faker->randomElement(['Active','Inactive']),
                ]);
                Patient::create([
                    'company_id' => $companyId,
                    'business_unit_id'=> $businessUnitId,
                    'user_id'=> $user->id,
                ]);
            }

            $i++;
            $j++;
        }
    }

}