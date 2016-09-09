<?php



class MedicineMenufacturer extends \Eloquent {
	
	protected $fillable = ['name','contact','email','address'];

	public static $rules = [

		'email' => 'required|unique:manufacturers',
		'name' => 'required',
	];

	public function medicinePurchases()
	{
		return $this->hasMany('MedicinePurchase');
	}

	public function medicines()
	{
		return $this->hasMany('Medicine');
	}

	public function medicineCategories()
	{
		return $this->hasMany('MedicineCategory');
	}

	public static function saveMedicineMenufacturer($data,$dataProcessType=GlobalsConst::DATA_SAVE){

		$vRules = MedicineMenufacturer::$rules;
		$response = null;
		if($dataProcessType==GlobalsConst::DATA_SAVE){
			$medicine_menufacturer = new MedicineMenufacturer();
		}else{
			$id = isset($data['medicine_menufacturerId']) ? $data['medicine_menufacturerId'] : '';
			if($id != ""){
				$medicine_menufacturer = MedicineMenufacturer::find($id);
			}else{
				return $response = ['success'=>false, 'error'=> true, 'message' => 'Medicine manufacturer record did not find for updation! '];
			}
		}

		//*****Start Rules Validators
		$validator = Validator::make($data, $vRules);
		if ($validator->fails())
		{
			return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
		}
		//*****End Rules Validators

		$medicine_menufacturer->name = $data['name'];
		$medicine_menufacturer->email = $data['email'];
		$medicine_menufacturer->cell = $data['cell'];
		$medicine_menufacturer->phone  = $data['phone'];
		$medicine_menufacturer->address  = $data['address'];
		$medicine_menufacturer->description  = $data['description'];
		$medicine_menufacturer->save();
		$response = ['success'=>'true','error'=>'false','message'=>'Medicine manufacturer has been saved successfully!'];
		return $response;
	}
}