<?php
use \App\Globals\GlobalsConst;

class Company extends \Eloquent {

    /**
     * @var array
     */
	protected $fillable = ['name', 'city_id', 'address', 'phone', 'fax', 'description'];


    public static $rules = [
        'name' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businessUnits(){
        return $this->hasMany('BusinessUnit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(){
        return $this->hasMany('User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees(){
        return $this->hasMany('Employee');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(){
        return $this->belongsTo('City');
    }

    /**
     * @param $data
     * @param int $dataProcessType
     * @return array|null
     */
    public static function saveCompany($data,$dataProcessType=GlobalsConst::DATA_SAVE){
        $response = null;
        $comeFrom = isset($data['comeFrom']) ? $data['comeFrom'] : 'Company';
        $validator = Validator::make($data, User::$rules);

        if ($validator->fails())
        {
            $response = ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator];
        }
        if($dataProcessType == GlobalsConst::DATA_SAVE){
            $company = new Company();
        }else{
            $id = isset($data['companyId']) ? $data['companyId'] : '';
            if($id != ''){
                $user = Company::find($id);
            }else{
                return $response = ['success'=>false, 'error'=> true, 'message' => $comeFrom.' record did not find for updation! '];
            }
        }

        //*******Save Company
        $cityId = isset($data['city_id']) ? $data['city_id'] : null;
        $company->city_id = $cityId;
        $company->name = $data['name'];
        $company->company_type = $data['company_type'];
        $company->address = $data['address'];
        $company->phone = $data['phone'];
        $company->fax = $data['fax'];
        $company->description = $data['description'];
        $company->save();

        //*******Save Business
        $businessUnitData['name'] = $data['bu_name'];
        $businessUnitData['company_id'] = $company->id;
        $businessUnitData['city_id'] = $data['city_id'];
        $businessUnitData['address'] = $data['address'];
        $businessUnitData['phone'] = $data['phone'];
        $businessUnitData['fax'] = $data['fax'];
        $businessUnitData['is_main'] = GlobalsConst::YES;
        $businessUnitData['description'] = $data['bu_description'];
        $BusinessUnitResult = BusinessUnit::saveBusinessUnit($businessUnitData, $dataProcessType);
        $BusinessUnit = $BusinessUnitResult['BusinessUnit'];

        //*******Save Admin User
        $userData['company_id'] = $company->id;
        $userData['business_unit_id'] = $BusinessUnit->id;
        $userData['user_type'] = GlobalsConst::ADMIN;
        $userData['username'] = $data['username'];
        $userData['password'] = $data['password'];
        $userData['email'] = $data['email'];
        $userData['fname'] = $data['fname'];
        $userData['lname'] = $data['lname'];
        $userData['status'] = GlobalsConst::STATUS_ON;
        $User = User::saveUser($userData,$dataProcessType);

        Role::create([
            'company_id'=> $company->id,
            'name' => 'Company Doctor',
            'description' => 'It is a Employee of the registered company who perform his job as a Doctor',
        ]);

        Role::create([
            'company_id'=> $company->id,
            'name' => 'Receptionist',
            'description' => 'It is an Employee of the registered company who perform his job as a Receptionist',
        ]);

        Role::create([
            'company_id'=> $company->id,
            'name' => 'Accountant',
            'description' => 'It is an Employee of the registered company who perform his job as a Accountant',
        ]);


        $roles = Role::where('company_id', $company->id)->lists('id');
        foreach ($roles as $roleId){
            $resourceIds = Resource::all()->lists('id');
            $Role = Role::find($roleId);

            foreach ($resourceIds as $resourceId){
                $Role->resources()->attach($resourceId, ['status'=>'Allow']);
            }
        }

        $Role = Role::find(GlobalsConst::COMPANY_ADMIN_ID);
        $Role->users()->attach($User['user']->id);
        $response = ['success'=>true, 'error'=> false, 'message'=>'Company has been saved successfully!'];
        return $response;
    }
}