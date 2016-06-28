<?php

class Doctor extends \Eloquent {
	
	protected $fillable = ['employee_id','doctor_category_id'];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function employee()
	{
		return $this->belongsTo('Employee');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function medicalSpecialties(){
		return $this->belongsToMany('MedicalSpecialty','doctor_medical_specialty', 'doctor_id', 'medical_specialty_id');
	}

	/**
	 * @return array
	 */
	public function qualifications()
	{
		return $this->belongsToMany('Qualification', 'doctor_qualification', 'doctor_id', 'qualification_id')->withPivot(['institute','start_date','end_date']);
	}

	
	/**
	 * @param $data
	 * @param int $dataProcessType
	 * @return array|null
	 */
	public static function saveDoctor($data,$dataProcessType=GlobalsConst::DATA_SAVE){
		$response = null;
		if($dataProcessType == GlobalsConst::DATA_SAVE){
			$doctor = new Doctor();
		}else{
			$id = isset($data['doctorId']) ? $data['doctorId'] : '';
			if($id != ''){
				$doctor = Doctor::find($id);
			}else{
				return $response = ['success'=>false, 'error'=> true, 'message' => 'Doctor record did not find for updation! '];
			}
		}
		$doctor->user_id = isset($data['user_id']) ? $data['user_id'] : null;
		$doctor->employee_id = isset($data['employee_id']) ? $data['employee_id'] : null;
		$doctor->min_fee = $data['min_fee'];
		$doctor->max_fee = $data['max_fee'];
		$doctor->save();

		//***For medical specialities
		$medicalSpecialtyIds = isset($data['medical_specialty_id']) ? $data['medical_specialty_id'] : '';
		if($medicalSpecialtyIds != ''){
			foreach ($medicalSpecialtyIds as $msId){
				$doctor->medicalSpecialties()->attach($msId);
			}
		}

		//***For Qualifications
		$qualificationIds = isset($data['qualification_id']) ? $data['qualification_id'] : '';
		if($qualificationIds != ''){
			foreach ($qualificationIds as $qId){
				$doctor->qualifications()->attach($qId);
			}
		}

		$response = ['success'=>true, 'error'=> false, 'message'=>'Doctor has been saved successfully!','Doctor'=>$doctor];
		return $response;
	}

	/**
	 * @param array|null $filterParams
	 * @param int $offset
	 * @param int $limit
	 * @return array|\Illuminate\Database\Eloquent\Collection|static[]
	 */
	public static function fetchDoctors(array $filterParams = null,$offset=0,$limit=GlobalsConst::LIST_DATA_LIMIT){
		try{
			if(Auth::user()->user_type == GlobalsConst::SUPER_ADMIN){
				$users = User::where('user_type', \App\Globals\GlobalsConst::DOCTOR);
			}elseif(Auth::user()->user_type == GlobalsConst::ADMIN){
				$users = User::where('company_id', Auth::user()->company_id)
					->where('user_type', \App\Globals\GlobalsConst::DOCTOR);
			}else{
				$users = User::where('business_unit_id', Auth::user()->business_unit_id)
					->where('user_type', \App\Globals\GlobalsConst::DOCTOR);
			}
			if($filterParams){
				$searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'].'%' : '';
				$users->where('full_name','LIKE',$searchKey);
			}
			return $users->skip($offset)->take($limit)
				->orderBy('id','DESC')->get();
		}catch (Exception $e){
			dd($e->getMessage());
		}

	}
}