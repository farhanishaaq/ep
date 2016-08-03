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
		$appointments = Appointment::where('business_unit_id', Ep::currentBusinessUnitId())->take(50)->get();
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
		$appointmentMaxId = Appointment::where('business_unit_id','=',Ep::currentBusinessUnitId())->max('id');
		$appointmentMaxId += 1;
		$appointmentMaxIdPad = str_pad($appointmentMaxId,4,'0',STR_PAD_LEFT);

		$appointmentCode = date('Ymd').'-'.$appointmentMaxIdPad;
        /*$doctors = User::where('user_type', GlobalsConst::DOCTOR)
					->where('status', GlobalsConst::STATUS_ON)
                    ->where('company_id', Auth::user()->company_id)->lists('full_name', 'id');
		$patients = Patient::where('business_unit_id', Auth::user()->business_unit_id)->get();*/
		$doctors = Doctor::fetchDoctorsForDropDown();
		$patients = Patient::fetchPatientsForDropDown();
		
		return View::make('appointments.create', compact('doctors','patients'))->nest('_form','appointments.partials._form',compact('doctors','patients','formMode','appointmentCode'));	}

	/**
	 * Store a newly created appointment in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
        $data['date'] = date('Y-m-d', strtotime($data['date']));
		$data['time'] = Timeslot::findOrFail($data['time_slot_id'])->slot;
        $data['business_unit_id'] = Ep::currentBusinessUnitId();
		unset($data['remaining_fee']);
		unset($data['total_paid']);
		$response = Appointment::saveAppointment($data);
		return $response;
	}

	/**
	 * Display the specified appointment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
//		dd('dd');
		$timeSlot = null;
        $formMode = GlobalsConst::FORM_EDIT;
		$doctors = Doctor::fetchDoctorsForDropDown();
		$patients = Patient::fetchPatientsForDropDown();
        $appointment = Appointment::find($id);
//        $timeSlot = $appointment->timeSlot->first()->where('duty_day_id', $appointment->timeSlot->duty_day_id)->lists('slot','id');

        return View::make('appointments.show', compact('timeSlot','appointment', 'doctors', 'patients'))->nest('_view','appointments.partials._view',compact('formMode','employee','appointment','doctors','patients'));
	}

	/**
	 * Show the form for editing the specified appointment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$appointmentCode=null;
		$formMode = GlobalsConst::FORM_EDIT;
		$doctors = Doctor::fetchDoctorsForDropDown();
		$patients = Patient::fetchPatientsForDropDown();
		$appointment = Appointment::find($id);
		$timeSlot = $appointment->timeSlot()->where('duty_day_id', $appointment->timeSlot->duty_day_id)->first()->id;
		$timeSlotsByAppointmentDate = TimeSlot::fetchTimeSlotsByAppointmentDate($appointment,true);
		return View::make('appointments.edit')->nest('_form','appointments.partials._form',compact('formMode','employee','appointment','doctors','patients','timeSlotsByAppointmentDate','timeSlot', 'appointmentCode'));
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

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function fetchTimeSlotsAndBookedAppointments(){
        $day = Input::get('day','');
        $doctorId = Input::get('doctor_id','');
        if($day == ''){
            $response = ['success'=>false,'error'=>true,'message' => 'Please select Date'];
        }
        elseif($doctorId == ''){
            $response = ['success'=>false,'error'=>true,'message' => 'Please select Doctor'];
        }
        else{
			if ($day == 0){
				$day = 7;
			}
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
                        /*$dpDay = array_search($ap->day, GlobalsConst::$DP_DAYS);
                        $makeDayPilotArr[$k]['start'] =  $dpDay.'T'. $ap->start;
                        $makeDayPilotArr[$k]['end'] =  $dpDay.'T'. $ap->end;
                        $makeDayPilotArr[$k]['id'] =  $dpDay.'T'. $ap->id;
                        $makeDayPilotArr[$k]['text'] =  $ap->name.' '.$ap->start .' To '. $ap->end;*/
						$makeDayPilotArr[$k]['id'] = $ap->id;
						$makeDayPilotArr[$k]['title'] = $ap->title;
						$makeDayPilotArr[$k]['start'] = $ap->start;
						$makeDayPilotArr[$k]['end'] = $ap->end;
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
