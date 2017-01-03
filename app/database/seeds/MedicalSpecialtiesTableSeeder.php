<?php

class MedicalSpecialtiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('medical_specialties')->truncate();
		//1
		MedicalSpecialty::create([
			'name' => 'Cardiology',
			'description' => 'Cardiology is a branch of medicine dealing with disorders of the heart as well as parts of the circulatory system. The field includes medical diagnosis and treatment of congenital heart defects, coronary artery disease, heart failure, valvular heart disease and electrophysiology. Physicians who specialize in this field of medicine are called cardiologists,',
			'photo'=>'cardiology.png'
		]);

		//2
		MedicalSpecialty::create([
			'name' => 'Dentistry',
			'description' => 'A person who is qualified to treat diseases and other conditions that affect the teeth and gums, especially the repair and extraction of teeth and the insertion of artificial ones.',
			'photo'=>'dentistry.jpg'
		]);

		//3
		MedicalSpecialty::create([
			'name' => 'Dermatology | Skin Specialists',
			'description' => 'Dermatologist provides the medical treatment related to conditions effecting skin, hair and nails.',
			'photo'=>'dermatology.png'
		]);

		//4
		MedicalSpecialty::create([
			'name' => 'Cosmetology',
			'description' => 'Cosmetologist is the beauty expert who takes care of people\'s hair, skin and nails. The word has been derived from Greek word which is related to beautifying.',
			'photo'=>'cosmetology.png'
		]);

		//5
		MedicalSpecialty::create([
			'name' => 'Otolaryngology | ENT-specialist',
			'description' => 'is the oldest medical specialty in the United States. Otolaryngologists are physicians trained in the medical and surgical management and treatment of patients with diseases and disorders of the ear, nose, throat (ENT), and related structures of the head and neck.',
			'photo'=>'otolaryngology.jpeg'
		]);

		//6
		MedicalSpecialty::create([
			'name' => 'Ophthalmology | Eye Specialists',
			'description' => 'the branch of medicine concerned with the study and treatment of disorders and diseases of the eye.',
			'photo'=>'ophthalmology.jpg'
		]);

		//7
		MedicalSpecialty::create([
			'name' => 'Nutritionology | Dietetics | Diet Specialists',
			'description' => 'the branch of knowledge concerned with the diet and its effects on health, especially with the practical application of a scientific understanding of nutrition.',
			'photo'=>'nutritionology.png'
		]);

		//8
		MedicalSpecialty::create([
			'name' => 'Hepatology  | Liver specialist',
			'description' => 'Hepatology is a branch of medicine concerned with the study, prevention, diagnosis and management of diseases that affect the liver, gallbladder, biliary tree and pancreas.',
			'photo'=>'hepatology.jpg'
		]);

		//9
		MedicalSpecialty::create([
			'name' => 'Nephrology',
			'description' => 'The branch of medicine that deals with the physiology and diseases of the kidneys.',
			'photo'=>'nephrology.png'
		]);
		
		//10
		MedicalSpecialty::create([
			'name' => 'Gynecology',
			'description' => 'Gynaecology is the medical practice dealing with the health of the female reproductive systems (vagina, uterus and ovaries) and the breasts. Literally, outside medicine, it means "the science of women',
			'photo'=>'gynecology.png'
		]);

		//11
		MedicalSpecialty::create([
			'name' => 'Family Physician',
			'description' => 'Family physicians care for both genders and all ages. Our comprehensive approach to care is necessary in our health care system.',
			'photo'=>'familyphysician.jpg'
		]);

		//12
		MedicalSpecialty::create([
			'name' => 'General Physician',
			'description' => 'In the medical profession, a general practitioner (GP) is a medical doctor who treats acute and chronic illnesses and provides preventive care and health education to patients.',
			'photo'=>'generalphysician.jpg'
		]);
	}

}