<?php

use App\Globals\GlobalsConst;

class Medicine extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'name' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'description', 'category_id'];

	public function menufacturer()
	{
		return $this->belongsTo('MedicineMenufacturer');
	}

	public function prescriptions()
	{
		return $this->belongsToMany('Prescription','medicine_prescription','medicine_id','prescription_id')->wherePivot('quantity');
	}

	public function medicineStocks(){
		return $this->hasMany('MedicineStock');
	}

	public function medicinePurchaseDetails(){
		return $this->hasMany('MedicinePurchaseDetail');
	}

	public function medicineSaleDetails(){
		return $this->hasMany('MedicineSaleDetail');
	}

	public static function saveMedicine($data,$dataProcessType=GlobalsConst::DATA_SAVE){
		$vRules = Medicine::$rules;
		if($dataProcessType==GlobalsConst::DATA_SAVE){
			$medicine = new Medicine();
		}elseif($dataProcessType==GlobalsConst::DATA_UPDATE){

			$id = isset($data['MedicineId']) ? $data['MedicineId'] : '';
			if($id != ''){
				$medicine = Medicine::find($id);
			}else{
				return $response = ['success'=>false, 'error'=> true, 'message' => ' record did not find for updation! '];
			}
		}

		//*****Start Rules Validators
        $validator = Validator::make($data, $vRules);
        if ($validator->fails())
        {
            return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
        }
		//*****End Rules Validators

		$medicine = new Medicine();
		$medicine->category_id  = 1;
		$medicine->name     	= $data['name'];
		$medicine->description  = $data['description'];

		$medicine->save();


		$response = ['success'=>true, 'error'=> false, 'message'=> 'Medicine has been saved successfully!'];
		return $response;
	}


}