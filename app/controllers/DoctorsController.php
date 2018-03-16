<?php
use App\Globals\Ep;
use App\Globals\GlobalsConst;

class DoctorsController extends \BaseController {

	/**
	 * Display a listing of patients
	 *
	 * @return Response
	 */
	private $_medicalSpeciality;
	private $_doctor;
	public function __construct(MedicalSpecialty $medicalSpecialty,Doctor $doctor )
    {
    $this->_medicalSpeciality = $medicalSpecialty;
    $this->_doctor = $doctor;
    }


    public function index()
	{
		$users = Doctor::fetchDoctors();
		return View::make('doctors.index', compact('users'));
	}


	/**
	 * Show the form for creating a new patient
	 *
	 * @return Response
	 */
	public function create()
	{
		$formMode = GlobalsConst::FORM_CREATE;
		$doctorMaxId = Doctor::max('id');
		$doctorUsername = 'Doctor-'.($doctorMaxId+1);
		$doctorPassword = $doctorUsername;
		$doctorEmail = $doctorUsername.GlobalsConst::DUMMY_EMAIL_DOMAIN;
		$user = null;
		return View::make('doctors.create')->nest('_form','doctors.partials._form',compact('formMode','doctor','doctorUsername','doctorPassword','doctorEmail','user'));
	}

	/**
	 * Store a newly created doctor in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data['company_id'] = Auth::user()->company_id;
		$data['business_unit_id'] = Auth::user()->business_unit_id;
		$data['status'] = Ep::getSwitchButtonVal(Input::get('status'),GlobalsConst::STATUS_ON,GlobalsConst::STATUS_OFF);
		$data['user_type'] = GlobalsConst::DOCTOR;
		$data['comeFrom'] = 'Doctor';
		$response = User::saveUser($data);
		return $response;
	}

	/**
	 * Display the specified doctor.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$doctor = Doctor::findOrFail($id);
		return View::make('doctors.show')->nest('_view','doctors.partials._view', compact('doctor'));
	}

	/**
	 * Show the form for editing the specified doctor.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$formMode = GlobalsConst::FORM_EDIT;
		$doctor = Doctor::find($id);
		$user = isset($doctor->user) ? $doctor->user :null;
		return View::make('doctors.edit')->nest('_form','doctors.partials._form',compact('formMode','doctor','user'));
	}

	/**
	 * Update the specified doctor in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();
		$data['company_id'] = Auth::user()->company_id;
		$data['business_unit_id'] = Auth::user()->business_unit_id;
		$data['status'] = Ep::getSwitchButtonVal(Input::get('status'),GlobalsConst::STATUS_ON,GlobalsConst::STATUS_OFF);
		$data['user_type'] = GlobalsConst::DOCTOR;
		$data['comeFrom'] = 'Patient';

		$data['userId'] = Doctor::find($id)->user->id;
		$data['employeeId'] = Doctor::find($id)->employee->id;
		$data['doctorId'] = $id;
		$response = User::saveUser($data,GlobalsConst::DATA_UPDATE);
		return $response;
	}

	/**
	 * Remove the specified doctor from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Patient::destroy($id);
		return Redirect::route('doctors.index');
	}

	private function sendEmail(){
		$data = ['link' => URL::to('login'), 'name' => Input::get('name')];
		//******Send email to Patient
		Mail::queue('emails.welcome', $data, function($message)
		{
			$message->to(Input::get('email'), Input::get('name'))->subject('Welcome to EP!');
		});
	}

//	public function showDoctorProfile(){
//	    return View::make ("doctors.drProfile");
//
//    }
    public function GetProfile($id)
    {
        $drRecord=Doctor::fetechDoctorRecord($id);
        return View::make('doctors.drProfile', compact('drRecord'));


   }

    public function showDoctors()

    {
//                                                           From Selected Left Panel,For  handle Errors
        $doctors = NULL;
        $data['city'] = '';
        $data['user_id'] = '';
        $data['speciality'] = '';
        $data['selectCities'] ='';
        $data['selectSpecialities'] = '';
        $data['hospital_id']='';

        if(Input::get('cities')!=''){

            $data['selectCities'] = Input::get('cities');
        }
        if(Input::get('speciality')!=''){
            $data['selectSpecialities'] =  Input::get('speciality');
        }
        if (Input::get('hospital')){
            $data['hospital_id']=Input::get('hospital');
        }

        if($data['selectCities']=='' && $data['selectSpecialities']==''){
            $data['user_id'] = Input::get('user_id');
            $data['city'] = Input::get('city');
            $data['speciality'] = Input::get('speciality');
        }
        $doctors = $this->_doctor->fetchPublicDoctors($data);
        $cities = City::all();
        $specialities = MedicalSpecialty::all();

            return View::make('doctors.doctors_get_list', compact('doctors', 'cities', 'specialities'));

        }

    public function showMedicalCategory($id){
                                                    //Show Qualification Detail With Related Doctor List
        $data['qualificationId'] = $id;
        $data['city'] = '';
        $doctors = $this->_doctor->fetchPublicDoctorsSpecialized($data);
        return View::make('doctors.qualification',compact('doctors'));
    }

    public function showDoctorDutyDays(){


        $doctors = $this->_doctor->fetchPublicDoctorsDutyDays();
        return View::make('doctors.portalDutyDays',compact('doctors'));

    }



}

