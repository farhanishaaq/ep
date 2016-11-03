<?php



class MedicineLocation extends \Eloquent {
	
	protected $fillable = ['name','description'];

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

	/**
	 *  This function fetches medicine locations data from database
	 */
	public static function fetchMedicineLocations(array $filterParams = null, $offset=0, $limit=GlobalsConst::LIST_DATA_LIMIT){
		try{
			if(Auth::user()->user_type == GlobalsConst::SUPER_ADMIN){
				$medicineLocations = DB::table('medicine_locations')->select('id','name','description');
			}elseif(Ep::currentUserType() == GlobalsConst::ADMIN){
				$medicineLocations = DB::table('medicine_locations')
					->join('medicine_stocks','medicine_stocks.location_id','=','medicine_locations.id')
					->join('business_units','business_units.id','=','medicine_stocks.business_unit_id')
					->select('medicine_locations.id','medicine_locations.name','medicine_locations.description')
					->where('business_units.company_id','=',Ep::currentCompanyId());
			}
			else{
				$medicineLocations = DB::table('medicine_locations')
					->join('medicine_stocks','medicine_stocks.location_id','=','medicine_locations.id')
					->join('business_units','business_units.id','=','medicine_stocks.business_unit_id')
					->select('medicine_locations.id','medicine_locations.name','medicine_locations.description')
					->where('business_units.company_id','=',Ep::currentCompanyId())
					->where('business_units.id','=',Ep::currentBusinessUnitId());
			}
			if($filterParams){
				$searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'].'%' : '';
				$medicineLocations->where('full_name','LIKE',$searchKey);
			}

			return $medicineLocations->skip($offset)->take($limit)
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