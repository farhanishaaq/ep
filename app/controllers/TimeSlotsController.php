<?php

use Illuminate\Http\JsonResponse;

class TimeSlotsController extends \BaseController {

	/**
	 * Display a listing of time_slots
	 *
	 * @return Response
	 */
	public function index()
	{
		$timeSlots = TimeSlot::where('company_id', Auth::user()->company_id)->get();

		return View::make('time_slots.index', compact('timeSlots'));
	}

	/**
	 * Show the form for creating a new timeslot
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('time_slots.create');
	}

	/**
	 * Store a newly created timeslot in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), TimeSlot::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $data['company_id'] = Auth::user()->company_id;
		TimeSlot::create($data);

		return Redirect::route('time_slots.index');
	}

	/**
	 * Display the specified timeslot.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$timeslot = TimeSlot::findOrFail($id);

		return View::make('time_slots.show', compact('timeslot'));
	}

	/**
	 * Show the form for editing the specified timeslot.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$timeslot = TimeSlot::find($id);

		return View::make('time_slots.edit', compact('timeslot'));
	}

	/**
	 * Update the specified timeslot in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$timeslot = TimeSlot::findOrFail($id);

		$validator = Validator::make($data = Input::all(), TimeSlot::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$timeslot->update($data);

		return Redirect::route('timeSlots.index');
	}

	/**
	 * Remove the specified timeslot from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		TimeSlot::destroy($id);

		return Redirect::route('timeSlots.index');
	}

    //    Return Free slots to Appointment creation form
    public function getFreeSlots(){
        $id = Input::get('id');                 // Get Employee id
        $date = Input::get('date');             // Get selected date
        $day = date('l', strtotime($date));     // Get day name from date

        $duty_day = DutyDay::where('employee_id', $id)->where('day', $day)
                    ->get()->first();

        if($duty_day) {
            $slot = null;
            $appointments = Appointment::where('date', $date)->where('employee_id', $id)
                            ->get();
            if(count($appointments) > 0){
                $timeSlots = TimeSlot::where('duty_day_id', $duty_day->id)
                    ->where('employee_id', $id);
                foreach($appointments as $appointment){
                    $slot = $timeSlots->where('slot', '!=', $appointment->time)
                            ->get()->toJson();
                }
            }else{
                $slot = TimeSlot::where('duty_day_id', $duty_day->id)
                        ->get()->toJson();
            }

            return JsonResponse::create($slot);
        }
        return 'false';
    }

}
