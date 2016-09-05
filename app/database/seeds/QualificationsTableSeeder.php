<?php

class QualificationsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('qualifications')->truncate();
		//1
		Qualification::create([
			'code' => 'MBBS',
			'title' => 'Bachelor of Medicine',
			'description' => 'MBBS is an abbreviation for Medicinae Baccalaureus, Baccalaureus Chirurgiae, or Bachelor of Medicine, Bachelor of Surgery in English, a primary medical qualification.'
		]);

		//2
		Qualification::create([
			'code' => 'Dip-Card',
			'title' => 'Diploma in Cardiology',
			'description' => 'Diploma in Cardiology'
		]);

		//3
		Qualification::create([
			'code' => 'BDS',
			'title' => 'Bachelor of Dental Surgery',
			'description' => 'Bachelor of Dental Surgery'
		]);

		//4
		Qualification::create([
			'code' => 'RDS',
			'title' => 'Respiratory Distress Syndrome',
			'description' => 'Respiratory Distress Syndrome'
		]);

		//5
		Qualification::create([
			'code' => 'PMDS',
			'title' => 'Persistent Müllerian duct syndrome',
			'description' => 'Persistent Müllerian duct syndrome'
		]);

		//6
		Qualification::create([
			'code' => 'MCPS',
			'title' => 'Member of College of Physicians & Surgeons',
			'description' => 'Its is Member of College of Physicians and Surgeons Pakistan.

College of Physicians and Surgeons Pakistan is a firm responsible for the registration of Postgraduate Doctors of Pakistan. It makes rules, enrolls doctors and conducts exams for the Post graduation in Pakistan. Currently, CPSP is registering for FCPSI, II and MCPS. CPSP also enrolls foreign qualified doctors.'
		]);

		//7
		Qualification::create([
			'code' => 'MPH',
			'title' => 'Master of public health',
			'description' => 'Master of public health, a degree designating successful training in analyzing past, present, and future public health issues.'
		]);

		//8
		Qualification::create([
			'code' => 'MSC (Food & Nutrition)',
			'title' => 'Master of Science (Food & Nutrition)',
			'description' => 'Master of Science (Food & Nutrition)'
		]);

		//9
		Qualification::create([
			'code' => 'FRCS',
			'title' => 'Fellowship of the Royal College of Surgeons',
			'description' => 'Fellowship of the Royal College of Surgeons (FRCS) is a professional qualification to practise as a senior surgeon in Ireland or the United Kingdom.'
		]);

		//10
		Qualification::create([
			'code' => 'MS General Surgery',
			'title' => 'M.S Degree in General Surgery',
			'description' => 'M.S Degree in General Surgery'
		]);

		//11
		Qualification::create([
			'code' => 'FCPS',
			'title' => 'Fellowship of the College of Physicians and Surgeons',
			'description' => 'M.S Degree in General Surgery'
		]);

		//12
		Qualification::create([
			'code' => 'Fellowship Liver Transplant Surgery',
			'title' => 'Fellowship Liver Transplant Surgery',
			'description' => 'FFellowship Liver Transplant Surgery'
		]);


		//13
		Qualification::create([
			'code' => 'Hepatobiliary Surgeon',
			'title' => 'Hepatobiliary Surgeon',
			'description' => 'Hepatobiliary: Having to do with the liver plus the gallbladder, bile ducts, or bile. For example, MRI (magnetic resonance imaging) can be applied to the hepatobiliary system. Hepatobiliary makes sense since "hepato-" refers to the liver and "-biliary" refers to the gallbladder, bile ducts, or bile.'
		]);

		//14
		Qualification::create([
			'code' => 'CPS',
			'title' => 'Cycle per second',
			'description' => 'Cycle per second, now known as hertz, which is the SI unit for frequency. Counts per second and counts per minute are widely used in ionising radiation metrology to signify the rate at which ionising events are detected by a radiological measurement instrument.'
		]);


		//15
		Qualification::create([
			'code' => 'MD/DM',
			'title' => 'Doctor of Medicine',
			'description' => 'Doctor of Medicine (MD or DM), or in Latin: Medicinae Doctor, meaning "teacher of medicine", is a terminal degree for physicians and surgeons. In countries that follow the tradition of ancient Scotland, it is a first professional graduate degree awarded upon graduation from medical school.'
		]);


	}

}