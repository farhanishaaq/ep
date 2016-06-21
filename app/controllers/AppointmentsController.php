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
			$appointments = Appointment::where('company_id', Auth::user()->company_id)->paginate(10);
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
                    ->where('company_id', Auth::user()->company_id)->get();
        $patients = Patient::where('company_id', Auth::user()->company_id)->get();
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
		$data['time'] = Timeslot::findOrFail($data['time_slot_id'])->slot;
        $data['company_id'] = Auth::user()->company_id;
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
        $patients = Patient::where('company_id', Auth::user()->company_id)->get();
        $appointment = Appointment::find($id);
        $timeslot = $appointment->timeslot->first()->where('duty_day_id', $appointment->timeslot->duty_day_id)->lists('slot','id');

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
        $patients = Patient::where('company_id', Auth::user()->company_id)->get();
		$appointment = Appointment::find($id);
        $timeslot = $appointment->timeslot->first()->where('duty_day_id', $appointment->timeslot->duty_day_id)->lists('slot','id');

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
		$data['time'] = Timeslot::findOrFail($data['time_slot_id'])->slot;

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
//            $dutyDay = DutyDay::where('day','=',GlobalsConst::$DAYS_WITH_NUM_KEYS[$day])->first();
//            $timeSlots = $dutyDay->timeSlots()->lists('slot','id');
//            $timeSlots = $dutyDay->timeSlots()->get(['id','slot']);
            $timeSlots = Timeslot::fetchAvailableTimeSlots($doctorId,$strDay);
            $appointments = Appointment::fetchAppointmentsByDay($strDay);

            if($timeSlots != null){
                if(count($timeSlots)){
                    $data['timeSlots'] = $timeSlots;
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
