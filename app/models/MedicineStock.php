<?php



class MedicineStock extends \Eloquent {

	protected $fillable = ['medicine_id','location_id','business_id','minimum_stock','quantity'];

	public static $rules = [
		'business_unit_id' => 'required',
		'quantity' => 'required',

	];

	public function businessUnit()
	{
		return $this->belongsTo('BusinessUnit');
	}

	public function medicine()
	{
		return $this->belongsTo('Medicine');
	}

	public function location()
	{
		return $this->belongsTo('MedicineLocation');
	}

	public static function saveMedicineStock($data,$dataProcessType=GlobalsConst::DATA_SAVE){

		$vRules   = MedicineStock::$rules;
		$response = null;
		if($dataProcessType==GlobalsConst::DATA_SAVE){
			$medicine_stock = new MedicineStock();
		}
		else{
			$id = isset($data['medicine_stockId']) ? $data['medicine_stockId'] : '';
			if($id!=''){
				$medicine_stock = MedicineStock::find($id);
			}
			else{
				return $respone = ['success'=>'false','error'=>'true','message'=>'Medicine stock record did not find for updation!'];
			}
		}

		//*****Start Rules Validators
		$validator = Validator::make($data, $vRules);
		if ($validator->fails())
		{
			return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
		}
		//*****End Rules Validators

		$locationId = isset($data['location_id']) ? $data['medicine_id'] : null;
		$medicineId = isset($data['medicine_id']) ? $data['medicine_id'] : null;
		$business_unitId= isset($data['business_unit_id']) ? $data['business_unit_id'] : null;


		$medicine_stock->medicine_id      = $medicineId;
		$medicine_stock->business_unit_id = $business_unitId;
		$medicine_stock->location_id      = $locationId;
		$medicine_stock->minimum_quantity = $data['minimum_quantity'];
		$medicine_stock->quantity         = $data['quantity'];
		$medicine_stock->save();
		$response = ['success'=>'true','error'=>'false','message'=>'Medicine stock has been saved successfully!'];
		return $response;
	}
}