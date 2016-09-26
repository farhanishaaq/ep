<?php



class MedicineLocation extends \Eloquent {
	
	protected $fillable = ['name'];

	public static $rules = [
		'name' => 'required'
	];

	public function medicineStocks()
	{
		return $this->hasMany('MedicineStock');
	}


	public static function saveMedicineLocation($data,$dataProcessType=GlobalsConst::DATA_SAVE){

		$vRules = MedicineLocation::$rules;
		$response = null;
		if($dataProcessType==GlobalsConst::DATA_SAVE){
			$medicine_location = new MedicineLocation();
		}else{
			$id = isset($data['medicine_locationId']) ? $data['medicine_locationId'] : '';
			if($id != ""){
				$medicine_location = MedicineLocation::find($id);
			}else{
				return $response = ['success'=>false, 'error'=> true, 'message' => 'Medicine Location record did not find for updation! '];
			}
		}

		//*****Start Rules Validators
		$validator = Validator::make($data, $vRules);
		if ($validator->fails())
		{
			return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
		}
		//*****End Rules Validators

		$medicine_location->name = $data['name'];
		$medicine_location->description  = $data['description'];
		$medicine_location->save();
		$response = ['success'=>'true','error'=>'false','message'=>'Medicine location has been saved successfully!'];
		return $response;
	}
}