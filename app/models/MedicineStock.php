<?php

use \App\Globals\Ep;

class MedicineStock extends \Eloquent {

	protected $fillable = ['medicine_id','location_id','business_unit_id','minimum_quantity','quantity'];

	public static $rules = [
		'quantity' => 'required',
		'medicine_id' => 'required',

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
		$locationId = isset($data['location_id']) ? $data['location_id'] : 0;
		$medicineId = isset($data['medicine_id']) ? $data['medicine_id'] : null;
		$business_unitId= isset($data['business_unit_id']) ? $data['business_unit_id'] : null;


		$medicine_stock->medicine_id      = $medicineId;
		$medicine_stock->business_unit_id = Ep::currentBusinessUnitId();
		$medicine_stock->location_id      = $locationId;
		$medicine_stock->minimum_quantity = $data['minimum_quantity'];
		$medicine_stock->quantity         = $data['quantity'];
		$medicine_stock->save();



		$response = ['success'=>'true','error'=>'false','message'=>'Medicine stock has been saved successfully!'];

		return $response;
	}

	/**
	 * This function fetch medicine stock data from the database
	 */

	public static function fetchMedicineStocks(array $filterParams = null, $offset=0, $limit=GlobalsConst::LIST_DATA_LIMIT){
		try{
			if(Auth::user()->user_type == GlobalsConst::SUPER_ADMIN){
				$medicineStocks = self::join('business_units','business_units.id','=','medicine_stocks.business_unit_id')
					->join('medicine_locations','medicine_locations.id','=','medicine_stocks.location_id')
					->join('medicines','medicines.id','=','medicine_stocks.medicine_id');
				$selectArr = ['medicine_locations.name As location_name','business_units.name AS business_unit_name', 'medicine_stocks.id','location_id','minimum_quantity', 'quantity'];
			}elseif(Ep::currentUserType() == GlobalsConst::ADMIN){
				$medicineStocks = self::join('business_units','business_units.id','=','medicine_stocks.business_unit_id')
					->join('medicine_locations','medicine_locations.id','=','medicine_stocks.location_id')
					->join('medicines','medicines.id','=','medicine_stocks.medicine_id')
					->where('company_id', Ep::currentCompanyId());
				$selectArr = ['medicines.name as medicine_name','medicine_locations.name As location_name','business_units.name AS business_unit_name', 'medicine_stocks.id','medicine_id','location_id','minimum_quantity', 'quantity'];
			}else{
				$medicineStocks = self::join('business_units','business_units.id','=','medicine_stocks.business_unit_id')
					->join('medicine_locations','medicine_locations.id','=','medicine_stocks.location_id')
					->join('medicines','medicines.id','=','medicine_stocks.medicine_id')
					->where('company_id', Ep::currentCompanyId())->where('user_type','!=',GlobalsConst::ADMIN);
				$selectArr = ['medicine_locations.name As location_name','business_units.name AS business_unit_name', 'medicine_stocks.id','location_id','minimum_quantity', 'quantity'];
			}
			if($filterParams){
				$searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'].'%' : '';
				$medicineStocks->where('full_name','LIKE',$searchKey);
			}

			return $medicineStocks->select($selectArr)->skip($offset)->take($limit)
				->orderBy('id','DESC')->get();
		}
		catch (Throwable $t) {
			// Executed only in PHP 7, will not match in PHP 5.x
			dd($t->getMessage());
		}
		catch (Exception $e){
			dd($e->getMessage());
		}

	}
}