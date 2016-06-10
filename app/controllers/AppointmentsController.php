<?php

use App\Globals\Ep;
use App\Globals\GlobalsConst;

class AppointmentsController extends \BaseController {

	/**
	 * Display a listing of appointments
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user()->role == 'Doctor'){
			$appointments = Auth::user()->appointments()->paginate(50);
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

        $formMode = GlobalsConst::FORM_CREATE;
        $doctors = Employee::where('role', 'Doctor')->where('status', 'active')
                    ->where('clinic_id', Auth::user()->clinic_id)->get();
        $patients = Patient::where('clinic_id', Auth::user()->clinic_id)->get();
		return View::make('appointments.create', compact('doctors','patients'))->nest('_form','appointments.partials._form',compact('doctors','patients','formMode'));;
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
        $data['date'] = date('Y-m-d', strtotime($data['date']));
		$data['time'] = Timeslot::findOrFail($data['timeslot_id'])->slot;
        $data['clinic_id'] = Auth::user()->clinic_id;
        $appointment = Appointment::create($data);
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
        $formMode = GlobalsConst::FORM_EDIT;
        $doctors = Employee::where('role', 'Doctor')->where('status', 'active')->get();
        $patients = Patient::where('clinic_id', Auth::user()->clinic_id)->get();
        $appointment = Appointment::find($id);
        $timeslot = $appointment->timeslot->first()->where('dutyday_id', $appointment->timeslot->dutyday_id)->lists('slot','id');

        return View::make('appointments.show', compact('timeslot','appointment', 'doctors', 'patients'))->nest('_view','appointments.partials._view',compact('formMode','employee','appointment','doctors','patients'));
	}

	/**
	 * Show the form for editing the specified appointment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $formMode = GlobalsConst::FORM_EDIT;
		$doctors = Employee::where('role', 'Doctor')->where('status', 'active')->get();
        $patients = Patient::where('clinic_id', Auth::user()->clinic_id)->get();
		$appointment = Appointment::find($id);
        $timeslot = $appointment->timeslot->first()->where('dutyday_id', $appointment->timeslot->dutyday_id)->lists('slot','id');

		return View::make('appointments.edit', compact('timeslot','appointment', 'doctors', 'patients'))->nest('_form','appointments.partials._form',compact('formMode','employee','appointment','doctors','patients'));
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
        return View::make('appointments.index', compact('appointments', 'flag'));
    }

    public function showTestReports(){
        if(Input::get('id') !== null){
            $appointments = Appointment::where('patient_id', Input::get('id'))->paginate(10);
        }else{
            $appointments = Appointment::where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        }
        $flag = "test";
        return View::make('appointment_based_data.appointments', compact('appointments', 'flag'));
    }

    public function printTestReports(){
        $appointments = Appointment::has('labtests')->where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        $flag = "test_print";
        return View::make('appointment_based_data.appointments', compact('appointments', 'flag'));
    }

    public function addCheckUpFee(){
        if(Auth::user()->role == "Accountant"){
            $appointments = Appointment::where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        }else{
            $appointments = Appointment::has('checkupfee', '=', 0)->where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        }
        $flag = "check_fee";
        return View::make('appointment_based_data.appointments', compact('appointments', 'flag'));
    }

    public function addTestFee(){
        if(Input::get('id') !== null){
            $appointments = Appointment::where('patient_id', Input::get('id'))->paginate(10);
        }else{
            $appointments = Appointment::has('labtests')->where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        }
        $flag = "test_fee";
        return View::make('appointment_based_data.appointments', compact('appointments', 'flag'));
    }

    public function testFeeInvoice(){
        $appointments = Appointment::has('labtests')->where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        $flag = "test_invoice";
        return View::make('appointment_based_data.appointments', compact('appointments', 'flag'));
    }

    public function checkupFeeInvoice(){
        $appointments = Appointment::has('checkupfee')->where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        $flag = "checkup_invoice";
        return View::make('appointment_based_data.appointments', compact('appointments', 'flag'));
    }

    public function fetchTimeSlotsAndBookedAppointments(){
        $day = Input::get('day','');
        $doctorId = Input::get('employee_id','');
        if($day == ''){
            $response = ['success'=>false,'error'=>true,'message' => 'Please select Date'];
        }
        elseif($doctorId == ''){
            $response = ['success'=>false,'error'=>true,'message' => 'Please select Doctor'];
        }
        else{
            $strDay = GlobalsConst::$DAYS_WITH_NUM_KEYS[$day];
//            $dutyDay = Dutyday::where('day','=',GlobalsConst::$DAYS_WITH_NUM_KEYS[$day])->first();
//            $timeSlots = $dutyDay->timeslots()->lists('slot','id');
//            $timeSlots = $dutyDay->timeslots()->get(['id','slot']);
            $timeSlots = Timeslot::fetchAvailableTimeSlots($doctorId,$strDay);
            $appointments = Appointment::fetchAppointmentsByDay($strDay);

            if($timeSlots != null){
                if(count($timeSlots)){
                    $data['timeslots'] = $timeSlots;
                    $makeDayPilotArr = [];
                    foreach($appointments as $k=>$ap){
//                    $doctors = $dd->employee;
                        $dpDay = array_search($ap->day, GlobalsConst::$DP_DAYS);
                        $makeDayPilotArr[$k]['start'] =  $dpDay.'T'. $ap->start;
                        $makeDayPilotArr[$k]['end'] =  $dpDay.'T'. $ap->end;
                        $makeDayPilotArr[$k]['id'] =  $dpDay.'T'. $ap->id;
                        $makeDayPilotArr[$k]['text'] =  $ap->name.' '.$ap->start .' To '. $ap->end;
                    }
                    $data['appointments'] = $makeDayPilotArr;
                    $response = ['success'=>true,'error'=>false,'data'=> $data];
                }else{
                    $response = ['success'=>false,'error'=>true,'message' => 'There is no slot available for this date'];
                }
            }else{
                $response = ['success'=>false,'error'=>true,'message' => 'There is no slot available for this date'];
            }

        }
        return Response::json($response);
    }
}
