<?php



class MedicineMenufacturer extends \Eloquent {
	
	protected $fillable = ['name','contact','email','address'];

	public static $rules = [

		'email' => 'required|unique:medicine_menufacturers',
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

	/**
	 *  This function fetches medicine menufacturer data from database
	 */
	public static function fetchMedicineMenufacturers(array $filterParams = null, $offset=0, $limit=GlobalsConst::LIST_DATA_LIMIT){
		try{
			if(Auth::user()->user_type == GlobalsConst::SUPER_ADMIN){
				self::join('medicine_purchases','medicine_purchases.menufacturer_id','=','medicine_menufacturers.id')
					->join('business_units','business_units.id','=','medicine_purchases.business_unit_id');
				$selectArr = ['medicine_menufacturers.id','medicine_menufacturers.name','medicine_menufacturers.email','medicine_menufacturers.cell','medicine_menufacturers.phone','medicine_menufacturers.address','medicine_menufacturers.description'];
			}elseif(Ep::currentUserType() == GlobalsConst::ADMIN){
				$medicineMenufacturers =
					self::join('medicine_purchases','medicine_purchases.menufacturer_id','=','medicine_menufacturers.id')
					->join('business_units','business_units.id','=','medicine_purchases.business_unit_id')
					->where('business_units.company_id','=',Ep::currentCompanyId());
				$selectArr = ['medicine_menufacturers.id','medicine_menufacturers.name','medicine_menufacturers.email','medicine_menufacturers.cell','medicine_menufacturers.phone','medicine_menufacturers.address','medicine_menufacturers.description'];
			}
			else{
				self::join('medicine_purchases','medicine_purchases.menufacturer_id','=','medicine_menufacturers.id')
					->join('business_units','business_units.id','=','medicine_purchases.business_unit_id')
					->where('business_units.company_id','=',Ep::currentCompanyId())
					->where('business_units.id','=',Ep::currentBusinessUnitId());
				$selectArr = ['medicine_menufacturers.id','medicine_menufacturers.name','medicine_menufacturers.email','medicine_menufacturers.cell','medicine_menufacturers.phone','medicine_menufacturers.address','medicine_menufacturers.description'];

			}
			if($filterParams){
				$searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'].'%' : '';
				$medicineMenufacturers->where('full_name','LIKE',$searchKey);
			}

			return $medicineMenufacturers->select($selectArr)->skip($offset)->take($limit)
				->orderBy('medicine_menufacturers.id','DESC')->get();
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