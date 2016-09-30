<?php



class MedicineSale extends \Eloquent {
	
	protected $fillable = ['patient_id','business_unit_id', 'code','date'];

	public static $rules = [

	];

	public function medicineSaleDetails()
	{
		return $this->hasMany('MedicineSaleDetail');
	}

	public function patient()
	{
		return $this->belongsTo('Patient');
	}

	/**
		Function to save Medicine sale
	 */

	public static function saveMedicineSale($data,$dataProcessType=GlobalsConst::DATA_SAVE)
	{
		$vRules = MedicineSale::$rules;
		$response = null;
		if($dataProcessType==GlobalsConst::DATA_SAVE)
		{
			$medicine_sale = new MedicineSale();
		}else{
			$id = isset($data['medicine_saleId']) ? $data['medicine_saleId'] : '';
			if($id != ""){
				$medicine_sale = MedicineSale::find($id);
				//Delete sale detail on sale edit
				MedicineSaleDetail::where('sale_id','=',$id)->delete();
			}else{
				return $response = ['success'=>false, 'error'=>true, 'message'=>'Medicine Sale record did not find for updation!'];
			}
		}

		//***Start Rules Validators
		$validator = Validator::make($data,$vRules);
		if($validator->fails())
		{
			return ['success'=>false, 'error'=>true, 'validatorErrors'=>$validator->errors()];
		}
		//***End Rules Validators

		$patient_Id = isset($data['patient_id']) ? $data['patient_id'] : null;

		$medicine_sale->patient_id 	= $patient_Id;
		$medicine_sale->date 		= $data['date'];
		$medicine_sale->save();

		//passing dumy data to MedicineSaleDetail for testing
		$data	= ['medicine_id'=>[2,3],'business_unit_id'=>[2,3],'unit_price'=>[2,3],'quantity'=>[2,3]];
		$data['MedicineSaleID'] = $medicine_sale->id;
		$msdResult = MedicineSaleDetail::saveMedicineSaleDetail($data,GlobalsConst::DATA_SAVE);

		$response = ['success'=>true, 'error'=>false, 'message'=>'Medicine Sale has been saved successfully'];
		return $response;
	}

	/**
	 	function to generate code for medicine sale
	 */

	public static function createSaleCode($saleNextCount){

		$date = date('ymd');
		$saleCode = $date ."-". $saleNextCount;
		return $saleCode;
	}
}