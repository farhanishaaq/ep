<?php


use App\Globals\GlobalsConst;

class MedicineCategory extends \Eloquent {
	
	protected $fillable = ['name','parent_id','manufacturer_id','dosage_form','description','is_derived'];


	public function medicineStocks()
	{
		return $this->hasMany('MedicineStock');
	}

	public function menufacturer()
	{
		return $this->belongsTo('MedicineMenufacturer');
	}

	public static function saveMedicineCategory($data,$dataProcessType=GlobalsConst::DATA_SAVE){

		$vRules = MedicineLocation::$rules;
		$response = null;
		if($dataProcessType==GlobalsConst::DATA_SAVE){
			$medicine_category = new MedicineCategory();
		}else{
			$id = isset($data['medicine_categoryId']) ? $data['medicine_categoryId'] : '';
			if($id != ""){
				$medicine_category = MedicineCategory::find($id);
			}else{
				return $response = ['success'=>false, 'error'=> true, 'message' => 'Medicine Category record did not find for updation! '];
			}
		}

		//*****Start Rules Validators
		$validator = Validator::make($data, $vRules);
		if ($validator->fails())
		{
			return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
		}
		//*****End Rules Validators

		$medicine_parentId = isset($data['parent_id']) ? $data['parent_id'] : null;
		$medicine_menufacturerId= isset($data['menufacturer_id']) ? $data['menufacturer_id'] : null;
		$medicine_category->parent_id = $medicine_parentId;
		$medicine_category->menufacturer_id = $medicine_menufacturerId;
		$medicine_category->name = $data['name'];
		$medicine_category->dosage_form = $data['dosage_form'];
		$medicine_category->description = $data['description'];
		$medicine_category->is_derived  = $data['is_derived'];
		$medicine_category->save();
		$response = ['success'=>'true','error'=>'false','message'=>'Medicine category has been saved successfully!'];
		return $response;
	}
}