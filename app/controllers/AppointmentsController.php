<?php

class AppointmentsController extends \BaseController {

	/**
	 * Display a listing of appointments
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user()->role == 'Doctor'){
			$appointments = Auth::user()->appointments()->paginate(10);
		}else{
			$appointments = Appointment::where('clinic_id', Auth::user()->clinic_id)->paginate(10);
		}

		return View::make('appointments.index', compact('appointments'));
	}

	/**
	 * Show the form for creating a new appointment
	 *
	 * @return Response
	 */
	public function create()
	{
        $formMode = GobalsConst::FORM_CREATE;
        $doctors = Employee::where('role', 'Doctor')->where('status', 'active')
                    ->where('clinic_id', Auth::user()->clinic_id)->get();
        $patients = Patient::where('clinic_id', Auth::user()->clinic_id)->get();
		return View::make('appointments.create', compact('doctors', 'patients'))->nest('_form','appointments.partials._form',compact('formMode'));;
	}

	/**
	 * Store a newly created appointment in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Appointment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['time'] = Timeslot::findOrFail($data['timeslot_id'])->slot;
        $data['clinic_id'] = Auth::user()->clinic_id;
		Appointment::create($data);

		return Redirect::route('appointments.index');
	}

	/**
	 * Display the specified appointment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$appointment = Appointment::findOrFail($id);

		return View::make('appointments.show', compact('appointment'));
	}

	/**
	 * Show the form for editing the specified appointment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $formMode = GobalsConst::FORM_EDIT;
		$doctors = Employee::where('role', 'Doctor')->where('status', 'active')->get();
        $patients = Patient::where('clinic_id', Auth::user()->clinic_id)->get();
		$appointment = Appointment::find($id);
        $timeslot = $appointment->timeslot->first()->where('dutyday_id', $appointment->timeslot->dutyday_id)->lists('slot','id');

		return View::make('appointments.edit', compact('timeslot','appointment', 'doctors', 'patients'))->nest('_form','appointments.partials._form',compact('formMode','employee'));
	}

	/**
	 * Update the specified appointment in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$appointment = Appointment::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Appointment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['time'] = Timeslot::findOrFail($data['timeslot_id'])->slot;

		if(Input::get('status') == '3' || Input::get('status') == '4' || Input::get('status') == '5'){
			$data['time'] = null;
		}

		$appointment->update($data);

		return Redirect::route('appointments.index');
	}

	/**
	 * Remove the specified appointment from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Appointment::destroy($id);

		return Redirect::route('appointments.index');
	}
        
        public function fetchVitalSign(){
        if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'Receptionist'){
            $appointments = Appointment::has('vitalsign', '=', 0)->where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        }elseif(Auth::user()->role == 'Doctor'){
            $appointments = Appointment::has('vitalsign')->where('employee_id', Auth::id())->paginate(10);
        }
        $flag = "vitals";
        return View::make('appointment_based_data.appointments', compact('appointments', 'flag'));
    }

    public function addPrescriptions(){
        $appointments = Appointment::has('prescription', '=', 0)->where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        $flag = "prescription";
        return View::make('appointment_based_data.appointments', compact('appointments', 'flag'));
    }
}
