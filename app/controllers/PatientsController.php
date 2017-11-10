<?php
use App\Globals\Ep;
use App\Globals\GlobalsConst;

class PatientsController extends \BaseController {

	/**
	 * Display a listing of patients
	 *
	 * @return Response
	 */
	//protected $_user;

//	public function __construct(User $user)
//    {
//        $this->_user=$user;
//    }
    private $_patient;
    public function __construct(Patient $patient)
    {
        $this->_patient=$patient;
    }

    public function index()
	{
		$patients = Patient::where('company_id', Auth::user()->company_id)->get();
		return View::make('patients.index', compact('patients'));
	}

	/**
	 * Show the form for creating a new patient
	 *
	 * @return Response
	 */
	public function create()
	{
		$formMode = GlobalsConst::FORM_CREATE;
		$patientMaxId = Patient::max('id');
		$patientUsername = 'Patient-'.($patientMaxId+1);
		$patientPassword = $patientUsername;
		$patientEmail = $patientUsername.GlobalsConst::DUMMY_EMAIL_DOMAIN;

		return View::make('patients.create')->nest('_form','patients.partials._form',compact('formMode','patient','patientUsername','patientPassword','patientEmail'));
	}

	/**
	 * Store a newly created patient in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data['company_id'] = Auth::user()->company_id;
		$data['business_unit_id'] = Auth::user()->business_unit_id;
		$data['status'] = 'Active';
		$data['user_type'] = GlobalsConst::PATIENT;
		$data['comeFrom'] = 'Patient';
		$response = User::saveUser($data);
		return $response;
	}

	/**
	 * Display the specified patient.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$patient = Patient::findOrFail($id);
		return View::make('patients.show')->nest('_view','patients.partials._view', compact('patient'));
	}

	/**
	 * Show the form for editing the specified patient.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$formMode = GlobalsConst::FORM_EDIT;
		$patient = Patient::find($id);
		return View::make('patients.edit')->nest('_form','patients.partials._form',compact('formMode','patient'));
	}

	/**
	 * Update the specified patient in storage.
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
		$data['user_type'] = GlobalsConst::PATIENT;
		$data['comeFrom'] = 'Patient';

		$data['userId'] = Patient::find($id)->user->id;
		$data['patientId'] = $id;
		$response = User::saveUser($data,GlobalsConst::DATA_UPDATE);
		return $response;
	}

	/**
	 * Remove the specified patient from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Patient::destroy($id);

		return Redirect::route('patients.index');
	}

    public function patientsReporting(){
        $appointments = Appointment::where('company_id', Auth::user()->company_id)->where('status', 5)->paginate(1);
        return View::make('patients.checked_patients', compact('appointments'));
    }

	private function sendEmail(){
		$data = ['link' => URL::to('login'), 'name' => Input::get('name')];
		//******Send email to Patient
		Mail::queue('emails.welcome', $data, function($message)
		{
			$message->to(Input::get('email'), Input::get('name'))->subject('Welcome to EP!');
		});
	}

    /**
     * @return array|static[]
     */
    public function getUserProfile(){
//        $user =$this->_user->find(16);
//        $patient =$this->_user->find(16)->patient;
//        $city=$this->_user->find(16)->city;
//        $appointments = $this->_user;
//        $vitals;
//        $allergies;
//        $prescription:
//
//        $data=DB::table('doctors')
//        ->join('doctor_qualification', 'doctors.id', '=', 'doctor_qualification.doctor_id')
//        ->join('users', 'doctors.user_id', '=', 'users.id')
//        ->select('doctors.id','max_fee', 'institute','fname','lname','full_name','dob','gender','additional_info','cell','address','email')
//        ->where('doctors.id','=','1')->get();
//        return  $data;
        $user=$this->_patient -> getPatientProfile(16);

        return View::make("patients.patientProfile", compact('user','patient','city'));

        dd($data);

        //return View::make("patients.patientProfile", compact('user','patient','city'));
        //dd($user);
    }

}
