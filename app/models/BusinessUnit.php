<?php

class BusinessUnit extends \Eloquent {

	/**
	 * @var string
	 */
	protected $table = 'business_units';

	/**
	 * @var array
	 */
	protected $fillable = ['name', 'company_id', 'city_id', 'address', 'phone', 'fax', 'description'];

	public static $rules = [
		'name' => 'required',
		'company_id' => 'required',
	];

	public function medicineStocks(){
		return $this->hasMany('MedicineStock');
	}


	public function medicinePurchases()
	{
		return $this->hasMany('MedicinePurchase');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function company(){
		return $this->belongsTo('Company');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function city(){
		return $this->belongsTo('City');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function appointments(){
		return $this->hasMany('Appointment');
	}


	/**
	 * @param $data
	 * @param int $dataProcessType
	 * @return array|null
	 */
	public static function saveBusinessUnit($data,$dataProcessType=GlobalsConst::DATA_SAVE){
		$response = null;
		$comeFrom = isset($data['comeFrom']) ? $data['comeFrom'] : 'Business Unit';
		$validator = Validator::make($data, BusinessUnit::$rules);

		if ($validator->fails())
		{
			$response = ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator];
			return $response;
		}
		if($dataProcessType == GlobalsConst::DATA_SAVE){
			$businessUnit = new BusinessUnit();
		}else{
			$id = isset($data['companyId']) ? $data['companyId'] : '';
			if($id != ''){
				$businessUnit = BusinessUnit::find($id);
			}else{
				return $response = ['success'=>false, 'error'=> true, 'message' => $comeFrom.' record did not find for updation! '];
			}
		}

		//*******Save Business Unit
		$cityId = isset($data['city_id']) ? $data['city_id'] : null;
		$businessUnit->company_id = $data['company_id'];
		$businessUnit->city_id = $cityId;
		$businessUnit->name = $data['name'];
		$businessUnit->address = $data['address'];
		$businessUnit->phone = $data['phone'];
		$businessUnit->fax = $data['fax'];
		$businessUnit->description = $data['description'];
		$businessUnit->is_main = $data['is_main'];
		$businessUnit->save();
		$response = ['success'=>true, 'error'=> false, 'message'=>'BusinessUnit has been saved successfully!','BusinessUnit'=>$businessUnit];
		return $response;
	}

    public static function createBusinessUnit($data,$dataProcessType=GlobalsConst::DATA_SAVE){
        $response = null;
        $comeFrom = isset($data['comeFrom']) ? $data['comeFrom'] : 'Company';
        $validator = Validator::make($data, User::$rules);

        if ($validator->fails())
        {
            $response = ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator];
        }


        //*******Save Business
        $businessUnitData['name'] = $data['bu_name'];
        $businessUnitData['company_id'] = 2;                       //todo dynamic with the flow
        $businessUnitData['city_id'] = $data['city_id'];
        $businessUnitData['address'] = $data['address'];
        $businessUnitData['phone'] = $data['phone'];
        $businessUnitData['fax'] = $data['fax'];
        $businessUnitData['is_main'] = GlobalsConst::YES;
        $businessUnitData['description'] = $data['bu_description'];
        $BusinessUnitResult = BusinessUnit::saveBusinessUnit($businessUnitData, $dataProcessType);
        $BusinessUnit = $BusinessUnitResult['BusinessUnit'];

        //*******Save Admin User
        $userData['company_id'] = 2;                              //todo dynamic with the flow
        $userData['business_unit_id'] = $BusinessUnit->id;
        $userData['user_type'] = GlobalsConst::ADMIN;
        $userData['username'] = $data['username'];
        $userData['password'] = $data['password'];
        $userData['email'] = $data['email'];
        $userData['fname'] = $data['fname'];
        $userData['lname'] = $data['lname'];
        $userData['status'] = GlobalsConst::STATUS_ON;
        $User = User::saveUser($userData,$dataProcessType);

        $Role = Role::find(GlobalsConst::COMPANY_ADMIN_ID);
        $Role->users()->attach($User['user']->id);
        $response = ['success'=>true, 'error'=> false, 'message'=>'Company has been saved successfully!'];
        return $response;
    }

}