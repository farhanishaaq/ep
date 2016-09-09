<?php


use App\Globals\GlobalsConst;

class MedicinePurchase extends \Eloquent {
	
	protected $fillable = ['business_unit_id','manufacturer_id','date'];
	public static $rules = [
		'business_unit_id' => 'required',
		'menufacturer_id' => 'required',
	];

	public function purchaseDetails()
	{
		return $this->hasMany('MedicinePurchaseDetail');
	}

	public function businessUnit()
	{
		return $this->belongsTo('BusinessUnit');
	}

	public function manufacturer(){
		return $this->belongsTo('MedicineManufacturer');
	}

	public static function saveMedicinePurchase($data,$dataProcessType=GlobalsConst::DATA_SAVE){

		$vRules = MedicinePurchase::$rules;
		$response = null;
		if($dataProcessType==GlobalsConst::DATA_SAVE){
			$medicine_purchase = new MedicinePurchase();
		}else{
			$id = isset($data['medicine_purchaseId']) ? $data['medicine_purchaseId'] : '';
			if($id != ""){
				$medicine_purchase = MedicinePurchase::find($id);
				//Delete purchase Detail on purchase Edit
				MedicinePurchaseDetail::where('purchase_id','=',$id)->delete();
			}else{
				return $response = ['success'=>false, 'error'=> true, 'message' => 'Medicine Purchase record did not find for updation! '];
			}
		}

		//*****Start Rules Validators
		$validator = Validator::make($data, $vRules);
		if ($validator->fails())
		{
			return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
		}
		//*****End Rules Validators

		$medicine_menufacturerId = isset($data['menufacturer_id']) ? $data['menufacturer_id'] : null;
		$business_unitId= isset($data['business_unit_id']) ? $data['business_unit_id'] : null;

		$medicine_purchase->menufacturer_id = $medicine_menufacturerId;
		$medicine_purchase->business_unit_id = $business_unitId;

		$medicine_purchase->date = $data['date'];
		$medicine_purchase->save();

		//passing dummy data to purchaseDetail for testing
		//$data = ['MedicinePurchaseID'=>$medicine_purchase->id,'medicine_id'=>['0'=>1,'1'=>2],'unit_price'=>['0'=>10,'1'=>20],'quantity'=>['0'=>100,'1'=>200]];
		$data['MedicinePurchaseID'] = $medicine_purchase->id;
		$mpdResult = MedicinePurchaseDetail::saveMedicinePurchaseDetail($data,GlobalsConst::DATA_SAVE);

		//passing dummy data to purchaseDetail for testing
		$data 	   = ['medicine_id'=>1,'business_unit_id'=>1,'location_id'=>1,'minimum_quantity'=>5,'quantity'=>7];

		$msResult  = MedicineStock::saveMedicineStock($data,GlobalsConst::DATA_SAVE);
		$response  = ['success'=>'true','error'=>'false','message'=>'Medicine purchase has been saved successfully!'];
		return $response;
	}

}