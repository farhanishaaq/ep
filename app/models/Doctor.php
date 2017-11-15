<?php
use App\Globals\GlobalsConst;
use \App\Globals\Ep;

class Doctor extends \Eloquent
{

    protected $fillable = ['user_id', 'employee_id', 'min_fee', 'max_fee'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo('Employee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dutyDays()
    {
        return $this->hasMany('DutyDay');
    }

    public function appointments()
    {
        return $this->hasMany('Appointment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medicalSpecialties()
    {
        return $this->belongsToMany('MedicalSpecialty', 'doctor_medical_specialty', 'doctor_id', 'medical_specialty_id');
    }

    /**
     * @return array
     */
    public function qualifications()
    {
        return $this->belongsToMany('Qualification', 'doctor_qualification', 'doctor_id', 'qualification_id')->withPivot(['institute', 'start_date', 'end_date']);
    }


    /**
     * @param $data
     * @param int $dataProcessType
     * @return array|null
     */
    public static function saveDoctor($data, $dataProcessType = GlobalsConst::DATA_SAVE)
    {
        $response = null;
        if ($dataProcessType == GlobalsConst::DATA_SAVE) {
            $doctor = new Doctor();
        } else {
            $id = isset($data['doctorId']) ? $data['doctorId'] : '';
            if ($id != '') {
                $doctor = Doctor::find($id);
            } else {
                return $response = ['success' => false, 'error' => true, 'message' => 'Doctor record did not find for updation! '];
            }
        }
        $doctor->user_id = isset($data['user_id']) ? $data['user_id'] : null;
        $doctor->employee_id = isset($data['employee_id']) ? $data['employee_id'] : null;
        $doctor->min_fee = $data['min_fee'];
        $doctor->max_fee = $data['max_fee'];
        $doctor->save();

        //***For medical specialities
        $medicalSpecialtyIds = isset($data['medical_specialty_id']) ? $data['medical_specialty_id'] : '';
        if ($medicalSpecialtyIds != '') {
            foreach ($medicalSpecialtyIds as $msId) {
                $doctor->medicalSpecialties()->attach($msId);
            }
        }

        //***For Qualifications
        $qualificationIds = isset($data['qualification_id']) ? $data['qualification_id'] : '';
        if ($qualificationIds != '') {
            foreach ($qualificationIds as $qId) {
                $doctor->qualifications()->attach($qId);
            }
        }

        $response = ['success' => true, 'error' => false, 'message' => 'Doctor has been saved successfully!', 'Doctor' => $doctor];
        return $response;
    }

    /**
     * @param array|null $filterParams
     * @param int $offset
     * @param int $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function fetchDoctors(array $filterParams = null, $offset = 0, $limit = GlobalsConst::LIST_DATA_LIMIT)
    {
        try {
            $doctors = self::select('doctors.*')
                ->join('employees', 'employees.id', '=', 'doctors.employee_id')
                ->join('users', 'users.id', '=', 'employees.user_id')
                ->where('users.status', '=', GlobalsConst::STATUS_ON);
            if (Ep::currentUserType() == GlobalsConst::SUPER_ADMIN) {
            } elseif (Ep::currentUserType() == GlobalsConst::ADMIN) {
//				$doctors->where('users.company_id', '=', Ep::currentCompanyId()); //@todo uncomment it in future coz it is right
                $doctors->where('users.business_unit_id', '=', Ep::currentBusinessUnitId());  //@todo remove it in future coz it is right

            } else {
                $doctors->where('users.business_unit_id', '=', Ep::currentBusinessUnitId());
//				$doctors->join('business_units','business_units.id','=','users.business_unit_id' );
                /*->where('users.business_unit_id', Ep::currentBusinessUnitId())
                    ->join('employees','employees.user_id','=','users.id' )
                    ->whereExists(function($query){
                        $query->select(DB::raw(1))
                            ->from('doctors')
                            ->whereRaw('employees.id = doctors.employee_id');
                    });*/
            }
            if ($filterParams) {
                $searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'] . '%' : '';
                $doctors->where('full_name', 'LIKE', $searchKey);
            }

//			return dd($doctors->toSql());
            return $doctors->skip($offset)->take($limit)
                ->orderBy('id', 'DESC')->get();
        } catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function fetchDoctorsForDropDown()
    {
        try {
            $doctors = self::select('doctors.id', 'users.full_name', 'max_fee')
                ->join('employees', 'employees.id', '=', 'doctors.employee_id')
                ->join('users', 'users.id', '=', 'employees.user_id')
                ->where('users.status', '=', GlobalsConst::STATUS_ON);
            if (Ep::currentUserType() == GlobalsConst::SUPER_ADMIN) {
            } elseif (Ep::currentUserType() == GlobalsConst::ADMIN) {
//				$doctors->where('users.company_id', '=', Ep::currentCompanyId());@todo uncomment it in future coz it is right
                $doctors->where('users.business_unit_id', '=', Ep::currentBusinessUnitId());//@todo remove it in future coz it is right
            } else {
                $doctors->where('users.business_unit_id', '=', Ep::currentBusinessUnitId());
            }

//			return dd($doctors->toSql());
            return $doctors->orderBy('users.full_name', 'ASC')->get();
        } catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * @param null $cols
     * @param bool $isLists
     * @return mixed
     */
    public static function fetchDoctorsWithNoDutyDays(array $cols = null, $isLists = false)
    {
        if ($cols == null) {
            $cols = ['full_name', 'doctors.id AS doctor_id'];
        }
//		$qryBuilder = User::has('dutyDays', '=', 0)
        $qryBuilder = User::select($cols)
            ->join('employees', 'employees.user_id', '=', 'users.id')
            ->join('doctors', 'employees.id', '=', 'doctors.employee_id')
            ->where('users.user_type', GlobalsConst::DOCTOR)
            ->where('users.status', GlobalsConst::STATUS_ON)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('duty_days')
                    ->whereRaw('doctors.id = duty_days.doctor_id');
            });
        switch (Auth::user()->user_type) {
            case GlobalsConst::SUPER_ADMIN:
                break;
            case GlobalsConst::ADMIN:
//				$qryBuilder->where('users.company_id', Auth::user()-; //@todo uncomment it in future coz it is right
                $qryBuilder->where('users.business_unit_id', Auth::user()->business_unit_id); //@todo remove it in future coz it is right
                break;
            default:
                $qryBuilder->where('users.business_unit_id', Auth::user()->business_unit_id);
                break;
        }

//		dd($qryBuilder->toSql());
        if ($isLists)
            return $qryBuilder->lists('full_name', 'doctor_id');
        else
            return $qryBuilder->get();
    }

    /**
     * @param $companyId
     * @param bool $forDropDown
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public static function fetchDoctorsByCompanyId($companyId, $forDropDown = false)
    {
        $qryBuilder = self::join('users', 'users.id', '=', 'doctors.user_id', 'inner')
            ->where('users.company_id', '=', $companyId)
            ->orderBy('users.full_name')
            ->select(['users.full_name', 'doctors.id',]);

//        dd($qryBuilder->toSql());
        if ($forDropDown == true) {
            return $qryBuilder->lists('users.full_name', 'doctors.id');
        } else {
            return $qryBuilder->get();
        }
    }

    public static function fetchDoctorDutyAndFeeInfoByDoctorId($doctorId)
    {
        $qryBuilder = Doctor::join('duty_days', 'duty_days.doctor_id', '=', 'doctors.id')
            ->where('doctors.id', '=', $doctorId);
        return $qryBuilder->get();
    }


    //    public function getDoctorsId($city="Lahore",$speciality="Cardiology"){
//
////       $specialityId= MedicalSpecialty::select('id')->where('name', 'like',  $speciality)->get();
////
////       // $doctorsId = DB::table('doctor_medical_specialty')->where('medical_specialty_id','=',$specialityId[0]['id'])->get();
////        $doctors = $this->find(1)->doctor;
////       dd($doctors);
////
////       return $doctors;
//


    public static function fetechDoctorRecord()
    {


        $data = DB::table('doctors')
            ->join('doctor_qualification', 'doctors.id', '=', 'doctor_qualification.doctor_id')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->select('doctors.id', 'max_fee', 'institute', 'fname', 'lname', 'full_name', 'dob', 'gender', 'additional_info', 'cell', 'address', 'email')
            ->where('doctors.id', '=', '1')
            ->get();

        return $data;
    }


    public static function fetchPublicDoctors(array $filterParams = null, $offset = 0, $limit = GlobalsConst::LIST_DATA_LIMIT)
    {
        try {


            $doctors = DB::table('doctors')
                ->join('users', 'doctors.user_id', '=', 'users.id')
                ->join('doctor_qualification', 'doctors.id', '=', 'doctor_qualification.doctor_id')
                ->join('qualifications', 'doctor_qualification.id', '=', 'qualifications.id')
                ->join('duty_days', 'doctors.id', '=', 'duty_days.doctor_id')
                ->join('doctor_medical_specialty', 'doctors.id', '=', 'doctor_medical_specialty.doctor_id')
                ->join('medical_specialties', 'doctor_medical_specialty.medical_specialty_id', '=', 'medical_specialties.id')
                ->join('cities', 'users.city_id', '=', 'cities.id')
                ->select('max_fee','min_fee','medical_specialties.name','full_name','doctors.id','start','end','code')
                ->where('medical_specialties.id', '=', $filterParams['specialityId'])
                ->where('cities.id', '=', $filterParams['cityId'])
                ->get();
//dd($doctors);


//            $doctors = DB::table('users')
//            ->join('doctors', 'users.id', '=', 'doctors.users_id')
//                ->select('doctors.max_fee');
//                ->where('medical_specialities.id', '=', $filterParams['specialityId']);
//                ->where('users.status', '=', GlobalsConst::STATUS_ON)
//            if (isset($filterParams['cityId'])) {
//                if(isset($filterParams['specialityId'])){
//                        ->join('users', 'users.id', '=', 'employees.user_id')
//                        ->where('medical_speciality.id', '=',$filterParams['specialityId']);
//                }
//                if (isset($filterParams['cityId'])) {
//                    $doctors->where('users.city_id', '=', $filterParams['cityId']);
//                }
//                $searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'] . '%' : '';
//                $doctors->where('full_name', 'LIKE', $searchKey);
//            }
//			return dd($doctors->toSql());
            return $doctors;
//            return $doctors;
        } catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}