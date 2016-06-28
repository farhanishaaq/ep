<?php

class MedicalSpecialtiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('medical_specialties')->truncate();
		//1
		MedicalSpecialty::create([
			'name' => 'Cardiology',
			'description' => 'Cardiology is a branch of medicine dealing with disorders of the heart as well as parts of the circulatory system. The field includes medical diagnosis and treatment of congenital heart defects, coronary artery disease, heart failure, valvular heart disease and electrophysiology. Physicians who specialize in this field of medicine are called cardiologists,'
		]);

		//2
		MedicalSpecialty::create([
			'name' => 'Dentistry',
			'description' => 'A person who is qualified to treat diseases and other conditions that affect the teeth and gums, especially the repair and extraction of teeth and the insertion of artificial ones.'
		]);

		//3
		MedicalSpecialty::create([
			'name' => 'Dermatology | Skin Specialists',
			'description' => 'Dermatologist provides the medical treatment related to conditions effecting skin, hair and nails.'
		]);

		//4
		MedicalSpecialty::create([
			'name' => 'Cosmetology',
			'description' => 'Cosmetologist is the beauty expert who takes care of people\'s hair, skin and nails. The word has been derived from Greek word which is related to beautifying.'
		]);

		//5
		MedicalSpecialty::create([
			'name' => 'Otolaryngology | ENT-specialist',
			'description' => 'is the oldest medical specialty in the United States. Otolaryngologists are physicians trained in the medical and surgical management and treatment of patients with diseases and disorders of the ear, nose, throat (ENT), and related structures of the head and neck.'
		]);

		//6
		MedicalSpecialty::create([
			'name' => 'Ophthalmology | Eye Specialists',
			'description' => 'the branch of medicine concerned with the study and treatment of disorders and diseases of the eye.'
		]);

		//7
		MedicalSpecialty::create([
			'name' => 'Nutritionology | Dietetics | Diet Specialists',
			'description' => 'the branch of knowledge concerned with the diet and its effects on health, especially with the practical application of a scientific understanding of nutrition.'
		]);

		//8
		MedicalSpecialty::create([
			'name' => 'Hepatology  | Liver specialist',
			'description' => 'Hepatology is a branch of medicine concerned with the study, prevention, diagnosis and management of diseases that affect the liver, gallbladder, biliary tree and pancreas.'
		]);

		//9
		MedicalSpecialty::create([
			'name' => 'Nephrology',
			'description' => 'The branch of medicine that deals with the physiology and diseases of the kidneys.'
		]);
		
		//10
		MedicalSpecialty::create([
			'name' => 'Gynecology',
			'description' => 'Gynaecology is the medical practice dealing with the health of the female reproductive systems (vagina, uterus and ovaries) and the breasts. Literally, outside medicine, it means "the science of women'
		]);
	}

}