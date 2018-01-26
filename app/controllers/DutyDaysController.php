<?php
use App\Globals\GlobalsConst;
use \Illuminate\Support\Facades\Response;
class DutyDaysController extends \BaseController {

    /**
     * Display a listing of duty_days
     *
     * @return Response
     */
    public function index()
    {
        $dutyDays = DutyDay::groupBy('doctor_id')->take(50)->get();
        return View::make('duty_days.index', compact('dutyDays'));
    }

    /**
     * Show the form for creating a new dutyday
     *
     * @return Response
     */
    public function create()
    {
        $doctorName = null;
        $doctorId = Input::get('doctor_id',null);
        if($doctorId != null){
            $employee = (Doctor::findOrFail($doctorId)->employee) ? (Doctor::findOrFail($doctorId)->employee) : null;
            $doctorName = ($employee->user)  ? $employee->user->full_name : null;
        }
        $formMode = GlobalsConst::FORM_CREATE;
        $doctors = Doctor::fetchDoctorsWithNoDutyDays(null, true);
        return View::make('duty_days.create')->nest('_form','duty_days.partials._form', compact('doctors', 'doctorId','doctorName', 'formMode'));
    }

    /**
     * Store a newly created dutyday in storage.
     *
     * @return Response
     */
    public function store()
    {
        $response=null;
        $data = Input::all();
        $response = DutyDay::saveDutyDays($data);
        return Response::json($response);
    }

    /**
     * Display the specified dutyday.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $dutyDays = DutyDay::where('doctor_id', '=', $id)->get();
        $doctor = Doctor::findOrFail($id);
//        return View::make('duty_days.show')->nest('_view','duty_days.partials._view', compact('dutyDays','doctor'));
        return View::make('duty_days.partials._view', compact('dutyDays','doctor'));
    }

    /**
     * Show the form for editing the specified dutyday.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $formMode = GlobalsConst::FORM_EDIT;
        $dutyDays = DutyDay::where('employee_id', '=', $id)->get();
        $makeDayPilotArr = [];
//        $doctors = Employee::findOrFail($id)->where('role', GlobalsConst::DOCTOR);
        $doctors = Employee::findOrFail($id);
        if($dutyDays !== null){
            if(count($dutyDays)){
                foreach($dutyDays as $k=>$dd){
//                    $doctors = $dd->employee;
                    $dpDay = array_search($dd->day, GlobalsConst::$DP_DAYS);
                    $makeDayPilotArr[$k]['start'] =  $dpDay.'T'. $dd->start;
                    $makeDayPilotArr[$k]['end'] =  $dpDay.'T'. $dd->end;
                    $makeDayPilotArr[$k]['id'] =  $dpDay.'T'. $dd->id;
                    $makeDayPilotArr[$k]['text'] =  $dd->start .' To '. $dd->end;
                }

            }
        }
        $makeDayPilotJson = json_encode($makeDayPilotArr);
//        dd($makeDayPilotJson);
        return View::make('duty_days.edit')->nest('_form','duty_days.partials._form', compact('dutyDays', 'doctors', 'makeDayPilotJson', 'formMode'));
    }

    /**
     * Update the specified dutyday in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $validator = Validator::make($data = Input::all(), DutyDay::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $dutyDays = DutyDay::where('employee_id', '=', $id)->get();

        if(Input::get('Sunday') != null){
            $dutyDays[0]->day = (Input::get('Sunday'));
            $dutyDays[0]->update();
            $dutyDays[0]->start = str_replace(' ', '', (Input::get('sun_start_time')));
            $dutyDays[0]->update();
            $dutyDays[0]->end = str_replace(' ', '', (Input::get('sun_end_time')));
            $dutyDays[0]->update();
            DutyDay::updateSlots($dutyDays[0]->start, $dutyDays[0]->end, $dutyDays[0]->id);
        }else{
            $dutyDays[0]->day = null;
            $dutyDays[0]->update();
            $dutyDays[0]->start = null;
            $dutyDays[0]->update();
            $dutyDays[0]->end = null;
            $dutyDays[0]->update();
            Timeslot::where('duty_day_id', '=', $dutyDays[0]->id)->delete();
        }

        if(Input::get('Monday') != null){
            $dutyDays[1]->day = (Input::get('Monday'));
            $dutyDays[1]->update();
            $dutyDays[1]->start = str_replace(' ', '', (Input::get('mon_start_time')));
            $dutyDays[1]->update();
            $dutyDays[1]->end = str_replace(' ', '', (Input::get('mon_end_time')));
            $dutyDays[1]->update();
            DutyDay::updateSlots($dutyDays[1]->start, $dutyDays[1]->end, $dutyDays[1]->id);
        }else{
            $dutyDays[1]->day = null;
            $dutyDays[1]->update();
            $dutyDays[1]->start = null;
            $dutyDays[1]->update();
            $dutyDays[1]->end = null;
            $dutyDays[1]->update();
            Timeslot::where('duty_day_id', '=', $dutyDays[1]->id)->delete();
        }
        if(Input::get('Tuesday') != null){
            $dutyDays[2]->day = (Input::get('Tuesday'));
            $dutyDays[2]->update();
            $dutyDays[2]->start = str_replace(' ', '', (Input::get('tue_start_time')));
            $dutyDays[2]->update();
            $dutyDays[2]->end = str_replace(' ', '', (Input::get('tue_end_time')));
            $dutyDays[2]->update();
            DutyDay::updateSlots($dutyDays[2]->start, $dutyDays[2]->end, $dutyDays[2]->id);
        }else{
            $dutyDays[2]->day = null;
            $dutyDays[2]->update();
            $dutyDays[2]->start = null;
            $dutyDays[2]->update();
            $dutyDays[2]->end = null;
            $dutyDays[2]->update();
            Timeslot::where('duty_day_id', '=', $dutyDays[2]->id)->delete();
        }
        if(Input::get('Wednesday') != null){
            $dutyDays[3]->day = (Input::get('Wednesday'));
            $dutyDays[3]->update();
            $dutyDays[3]->start = str_replace(' ', '', (Input::get('wed_start_time')));
            $dutyDays[3]->update();
            $dutyDays[3]->end = str_replace(' ', '', (Input::get('wed_end_time')));
            $dutyDays[3]->update();
            DutyDay::updateSlots($dutyDays[3]->start, $dutyDays[3]->end, $dutyDays[3]->id);
        }else{
            $dutyDays[3]->day = null;
            $dutyDays[3]->update();
            $dutyDays[3]->start = null;
            $dutyDays[3]->update();
            $dutyDays[3]->end = null;
            $dutyDays[3]->update();
            Timeslot::where('duty_day_id', '=', $dutyDays[3]->id)->delete();
        }
        if(Input::get('Thursday') != null){
            $dutyDays[4]->day = (Input::get('Thursday'));
            $dutyDays[4]->update();
            $dutyDays[4]->start = str_replace(' ', '', (Input::get('thu_start_time')));
            $dutyDays[4]->update();
            $dutyDays[4]->end = str_replace(' ', '', (Input::get('thu_end_time')));
            $dutyDays[4]->update();
            DutyDay::updateSlots($dutyDays[4]->start, $dutyDays[4]->end, $dutyDays[4]->id);
        }else{
            $dutyDays[4]->day = null;
            $dutyDays[4]->update();
            $dutyDays[4]->start = null;
            $dutyDays[4]->update();
            $dutyDays[4]->end = null;
            $dutyDays[4]->update();
            Timeslot::where('duty_day_id', '=', $dutyDays[4]->id)->delete();
        }
        if(Input::get('Friday') != null){
            $dutyDays[5]->day = (Input::get('Friday'));
            $dutyDays[5]->update();
            $dutyDays[5]->start = str_replace(' ', '', (Input::get('fri_start_time')));
            $dutyDays[5]->update();
            $dutyDays[5]->end = str_replace(' ', '', (Input::get('fri_end_time')));
            $dutyDays[5]->update();
            DutyDay::updateSlots($dutyDays[5]->start, $dutyDays[5]->end, $dutyDays[5]->id);
        }
        else{
            $dutyDays[5]->day = null;
            $dutyDays[5]->update();
            $dutyDays[5]->start = null;
            $dutyDays[5]->update();
            $dutyDays[5]->end = null;
            $dutyDays[5]->update();
            Timeslot::where('duty_day_id', '=', $dutyDays[5]->id)->delete();
        }
        if(Input::get('Saturday') != null){
            $dutyDays[6]->day = (Input::get('Saturday'));
            $dutyDays[6]->update();
            $dutyDays[6]->start = str_replace(' ', '', (Input::get('sat_start_time')));
            $dutyDays[6]->update();
            $dutyDays[6]->end = str_replace(' ', '', (Input::get('sat_end_time')));
            $dutyDays[6]->update();
            DutyDay::updateSlots($dutyDays[6]->start, $dutyDays[6]->end, $dutyDays[6]->id);
        }
        else{
            $dutyDays[6]->day = null;
            $dutyDays[6]->update();
            $dutyDays[6]->start = null;
            $dutyDays[6]->update();
            $dutyDays[6]->end = null;
            $dutyDays[6]->update();
            Timeslot::where('duty_day_id', '=', $dutyDays[6]->id)->delete();
        }

        return Redirect::route('duty_days.index');
    }

    /**
     * Remove the specified dutyday from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        DutyDay::destroy($id);

        return Redirect::route('duty_days.index');
    }

}
