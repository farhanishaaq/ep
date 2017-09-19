<?php

class Patient extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
        'name' => 'required',
        'gender' => 'required',
        'age' => 'required',
        'city' => 'required',
        'country' => 'required',
        'address' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'dob', 'gender', 'age', 'email', 'city', 'country', 'address',
    'phone', 'cnic', 'note', 'company_id'];

//  Relationships

    public function user()
    {
        return $this->belongsTo('User');
    }
    public function medicineSales()
    {
        return $this->hasMany('MedicineSale');
    }

    public function allergies()
    {
        return $this->hasMany('Allergy');
    }

    public function drugUsages()
    {
        return $this->hasMany('DrugUsage');
    }

    public function familyHistories()
    {
        return $this->hasMany('FamilyHistory');
    }

    public function previousDiseases()
    {
        return $this->hasMany('PreviousDisease');
    }

    public function surgicalhistories()
    {
        return $this->hasMany('SurgicalHistory');
    }

    public function diagonosticprocedures()
    {
        return $this->hasMany('Diagonosticprocedure');
    }

    public function vitalSigns()
    {
        return $this->hasMany('VitalSign');
    }

    public function labtests()
    {
        return $this->hasMany('Labtest');
    }

    public function appointments()
    {
        return $this->hasMany('Appointment');
    }

    public function prescriptions()
    {
        return $this->hasMany('Prescription');
    }

    public function checkupfees()
    {
        return $this->hasMany('Checkupfee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    /**
     * @param $data
     * @param int $dataProcessType
     * @return array|null
     */
    public static function savePatient($data,$dataProcessType=GlobalsConst::DATA_SAVE){
        $response = null;
        if($dataProcessType==GlobalsConst::DATA_SAVE){
            $patient = new Patient();
        }else{
            $id = isset($data['patientId']) ? $data['patientId'] : '';
            if($id != ''){
                $patient = Patient::find($id);
            }else{
                return $response = ['success'=>false, 'error'=> true, 'message' => 'Employee record did not find for updation! '];
            }
        }
        $patient->company_id = isset($data['company_id']) ? $data['company_id'] : null;
        $patient->business_unit_id = isset($data['business_unit_id']) ? $data['business_unit_id'] : null;
        $patient->user_id = isset($data['user_id']) ? $data['user_id'] : null;
        $patient->save();
        $response = ['success'=>true, 'error'=> false, 'message'=>'Patient has been saved successfully!','Patient'=>$patient];
        return $response;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function fetchPatientsForDropDown(){
        try{
            $patients = self::select('patients.id', 'users.full_name')
                ->join('users','users.id','=','patients.user_id' )
                ->where('users.status', '=', GlobalsConst::STATUS_ON);
            if(Ep::currentUserType() == GlobalsConst::SUPER_ADMIN){
            }elseif(Ep::currentUserType() == GlobalsConst::ADMIN){
                $patients->where('users.company_id', '=', Ep::currentCompanyId());
            }else{
                $patients->where('users.business_unit_id', '=', Ep::currentBusinessUnitId());
            }

//			return dd($patients->toSql());
//            return $patients->orderBy('u.full_name','DESC')->lists('full_name','id');
            return $patients->orderBy('users.full_name','ASC')->get();
        }catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        }catch (Exception $e){
            dd($e->getMessage());
        }

    }
}