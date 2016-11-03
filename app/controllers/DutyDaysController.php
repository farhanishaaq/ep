<?php
use App\Globals\GlobalsConst;
use \Illuminate\Support\Facades\Response;
class DutydaysController extends \BaseController {

	/**
	 * Display a listing of dutydays
	 *
	 * @return Response
	 */
	public function index()
	{
        $dutyDays = Dutyday::where('clinic_id', Auth::user()->clinic_id)->groupBy('employee_id')->paginate(10);

		return View::make('dutydays.index', compact('dutyDays'));
	}

	/**
	 * Show the form for creating a new dutyday
	 *
	 * @return Response
	 */
	public function create()
	{
        $formMode = GlobalsConst::FORM_CREATE;
		$doctors = Employee::has('dutydays', '=', 0)->where('role', GlobalsConst::DOCTOR)
                ->where('status', 'Active')->where('clinic_id', Auth::user()->clinic_id)->get();
        return View::make('dutydays.create')->nest('_form','dutydays.partials._form', compact('doctors','formMode'));
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
        $data['clinic_id'] = Auth::user()->clinic_id;
        $day = $data['day'];
        $dayFinal = isset(GlobalsConst::$DP_DAYS[$day]) ? GlobalsConst::$DP_DAYS[$day] : null;
        $data['day'] =  $dayFinal;

        Dutyday::$rules['day'] = 'required|unique:dutydays,day,NULL,id,employee_id,'.$data['employee_id'];
		$validator = Validator::make($data, Dutyday::$rules);

		if($validator->fails()) {
            $response = ['success'=>false,'error'=>true,'message' => $validator->errors()];
		}elseif($dayFinal == null){
            $response = ['success'=>false,'error'=>true,'message' => 'Wrong Day provided!'];
        }else{
            $dutyDay = Dutyday::create($data);
            Dutyday::makeSlots($data['start'], $data['end'], $dutyDay->id, $data['employee_id']);
            $response = ['success'=>true,'error'=>false,'message' => 'Day Time has been saved successfully'];
        }

        return Response::json($response);
        /*$data['clinic_id'] = Auth::user()->clinic_id;
		if(Input::get('Sunday') != null){
            $data['day'] = (Input::get('Sunday'));
            $data['start'] = str_replace(' ', '', (Input::get('sun_start_time')));
            $data['end'] = str_replace(' ', '', (Input::get('sun_end_time')));
            $day_id = Dutyday::create($data)->id;
            Dutyday::makeSlots($data['start'], $data['end'], $day_id, $data['employee_id']);
        }else{
            $data['day'] = null;
            $data['start'] = null;
            $data['end'] = null;
            Dutyday::create($data);
        }

        if(Input::get('Monday') != null){
        	$data['day'] = (Input::get('Monday'));
            $data['start'] = str_replace(' ', '', (Input::get('mon_start_time')));
            $data['end'] = str_replace(' ', '', (Input::get('mon_end_time')));
            $day_id = Dutyday::create($data)->id;
            Dutyday::makeSlots($data['start'], $data['end'], $day_id, $data['employee_id']);
        }else{
            $data['day'] = null;
            $data['start'] = null;
            $data['end'] = null;
            Dutyday::create($data);
        }

        if(Input::get('Tuesday') != null){
        	$data['day'] = (Input::get('Tuesday'));
            $data['start'] = str_replace(' ', '', (Input::get('tue_start_time')));
            $data['end'] = str_replace(' ', '', (Input::get('tue_end_time')));
            $day_id = Dutyday::create($data)->id;
            Dutyday::makeSlots($data['start'], $data['end'], $day_id, $data['employee_id']);
        }else{
            $data['day'] = null;
            $data['start'] = null;
            $data['end'] = null;
            Dutyday::create($data);
        }

        if(Input::get('Wednesday') != null){
        	$data['day'] = (Input::get('Wednesday'));
            $data['start'] = str_replace(' ', '', (Input::get('wed_start_time')));
            $data['end'] = str_replace(' ', '', (Input::get('wed_end_time')));
            $day_id = Dutyday::create($data)->id;
            Dutyday::makeSlots($data['start'], $data['end'], $day_id, $data['employee_id']);
        }else{
            $data['day'] = null;
            $data['start'] = null;
            $data['end'] = null;
            Dutyday::create($data);
        }

        if(Input::get('Thursday') != null){
        	$data['day'] = (Input::get('Thursday'));
            $data['start'] = str_replace(' ', '', (Input::get('thu_start_time')));
            $data['end'] = str_replace(' ', '', (Input::get('thu_end_time')));
            $day_id = Dutyday::create($data)->id;
            Dutyday::makeSlots($data['start'], $data['end'], $day_id, $data['employee_id']);
        }else{
            $data['day'] = null;
            $data['start'] = null;
            $data['end'] = null;
            Dutyday::create($data);
        }

        if(Input::get('Friday') != null){
            $data['day'] = (Input::get('Friday'));
            $data['start'] = str_replace(' ', '', (Input::get('fri_start_time')));
            $data['end'] = str_replace(' ', '', (Input::get('fri_end_time')));
            $day_id = Dutyday::create($data)->id;
            Dutyday::makeSlots($data['start'], $data['end'], $day_id, $data['employee_id']);
        }else{
            $data['day'] = null;
            $data['start'] = null;
            $data['end'] = null;
            Dutyday::create($data);
        }

        if(Input::get('Saturday') != null){
            $data['day'] = (Input::get('Saturday'));
            $data['start'] = str_replace(' ', '', (Input::get('sat_start_time')));
            $data['end'] = str_replace(' ', '', (Input::get('sat_end_time')));
            $day_id = Dutyday::create($data)->id;
            Dutyday::makeSlots($data['start'], $data['end'], $day_id, $data['employee_id']);
        }else{
            $data['day'] = null;
            $data['start'] = null;
            $data['end'] = null;
            Dutyday::create($data);
        }*/

		return Redirect::route('dutydays.index');
	}

	/**
	 * Display the specified dutyday.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $dutyDays = Dutyday::where('employee_id', '=', $id)->get();
        $doctor = Employee::findOrFail($id);
        return View::make('dutydays.show')->nest('_view','dutydays.partials._view', compact('dutyDays','doctor'));
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
        $dutyDays = Dutyday::where('employee_id', '=', $id)->get();
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
        return View::make('dutydays.edit')->nest('_form','dutydays.partials._form', compact('dutyDays', 'doctors', 'makeDayPilotJson', 'formMode'));
	}

	/**
	 * Update the specified dutyday in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make($data = Input::all(), Dutyday::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $dutydays = Dutyday::where('employee_id', '=', $id)->get();

            if(Input::get('Sunday') != null){
                $dutydays[0]->day = (Input::get('Sunday'));
                $dutydays[0]->update();
                $dutydays[0]->start = str_replace(' ', '', (Input::get('sun_start_time')));
                $dutydays[0]->update();
                $dutydays[0]->end = str_replace(' ', '', (Input::get('sun_end_time')));
                $dutydays[0]->update();
                Dutyday::updateSlots($dutydays[0]->start, $dutydays[0]->end, $dutydays[0]->id);
            }else{
                $dutydays[0]->day = null;
                $dutydays[0]->update();
                $dutydays[0]->start = null;
                $dutydays[0]->update();
                $dutydays[0]->end = null;
                $dutydays[0]->update();
                Timeslot::where('dutyday_id', '=', $dutydays[0]->id)->delete();
            }

            if(Input::get('Monday') != null){
                $dutydays[1]->day = (Input::get('Monday'));
                $dutydays[1]->update();
                $dutydays[1]->start = str_replace(' ', '', (Input::get('mon_start_time')));
                $dutydays[1]->update();
                $dutydays[1]->end = str_replace(' ', '', (Input::get('mon_end_time')));
                $dutydays[1]->update();
                Dutyday::updateSlots($dutydays[1]->start, $dutydays[1]->end, $dutydays[1]->id);
            }else{
                $dutydays[1]->day = null;
                $dutydays[1]->update();
                $dutydays[1]->start = null;
                $dutydays[1]->update();
                $dutydays[1]->end = null;
                $dutydays[1]->update();
                Timeslot::where('dutyday_id', '=', $dutydays[1]->id)->delete();
            }
            if(Input::get('Tuesday') != null){
                $dutydays[2]->day = (Input::get('Tuesday'));
                $dutydays[2]->update();
                $dutydays[2]->start = str_replace(' ', '', (Input::get('tue_start_time')));
                $dutydays[2]->update();
                $dutydays[2]->end = str_replace(' ', '', (Input::get('tue_end_time')));
                $dutydays[2]->update();
                Dutyday::updateSlots($dutydays[2]->start, $dutydays[2]->end, $dutydays[2]->id);
            }else{
                $dutydays[2]->day = null;
                $dutydays[2]->update();
                $dutydays[2]->start = null;
                $dutydays[2]->update();
                $dutydays[2]->end = null;
                $dutydays[2]->update();
                Timeslot::where('dutyday_id', '=', $dutydays[2]->id)->delete();
            }
            if(Input::get('Wednesday') != null){
                $dutydays[3]->day = (Input::get('Wednesday'));
                $dutydays[3]->update();
                $dutydays[3]->start = str_replace(' ', '', (Input::get('wed_start_time')));
                $dutydays[3]->update();
                $dutydays[3]->end = str_replace(' ', '', (Input::get('wed_end_time')));
                $dutydays[3]->update();
                Dutyday::updateSlots($dutydays[3]->start, $dutydays[3]->end, $dutydays[3]->id);
            }else{
                $dutydays[3]->day = null;
                $dutydays[3]->update();
                $dutydays[3]->start = null;
                $dutydays[3]->update();
                $dutydays[3]->end = null;
                $dutydays[3]->update();
                Timeslot::where('dutyday_id', '=', $dutydays[3]->id)->delete();
            }
            if(Input::get('Thursday') != null){
                $dutydays[4]->day = (Input::get('Thursday'));
                $dutydays[4]->update();
                $dutydays[4]->start = str_replace(' ', '', (Input::get('thu_start_time')));
                $dutydays[4]->update();
                $dutydays[4]->end = str_replace(' ', '', (Input::get('thu_end_time')));
                $dutydays[4]->update();
                Dutyday::updateSlots($dutydays[4]->start, $dutydays[4]->end, $dutydays[4]->id);
            }else{
                $dutydays[4]->day = null;
                $dutydays[4]->update();
                $dutydays[4]->start = null;
                $dutydays[4]->update();
                $dutydays[4]->end = null;
                $dutydays[4]->update();
                Timeslot::where('dutyday_id', '=', $dutydays[4]->id)->delete();
            }
            if(Input::get('Friday') != null){
                $dutydays[5]->day = (Input::get('Friday'));
                $dutydays[5]->update();
                $dutydays[5]->start = str_replace(' ', '', (Input::get('fri_start_time')));
                $dutydays[5]->update();
                $dutydays[5]->end = str_replace(' ', '', (Input::get('fri_end_time')));
                $dutydays[5]->update();
                Dutyday::updateSlots($dutydays[5]->start, $dutydays[5]->end, $dutydays[5]->id);
            }
            else{
                $dutydays[5]->day = null;
                $dutydays[5]->update();
                $dutydays[5]->start = null;
                $dutydays[5]->update();
                $dutydays[5]->end = null;
                $dutydays[5]->update();
                Timeslot::where('dutyday_id', '=', $dutydays[5]->id)->delete();
            }
            if(Input::get('Saturday') != null){
                $dutydays[6]->day = (Input::get('Saturday'));
                $dutydays[6]->update();
                $dutydays[6]->start = str_replace(' ', '', (Input::get('sat_start_time')));
                $dutydays[6]->update();
                $dutydays[6]->end = str_replace(' ', '', (Input::get('sat_end_time')));
                $dutydays[6]->update();
                Dutyday::updateSlots($dutydays[6]->start, $dutydays[6]->end, $dutydays[6]->id);
            }
            else{
                $dutydays[6]->day = null;
                $dutydays[6]->update();
                $dutydays[6]->start = null;
                $dutydays[6]->update();
                $dutydays[6]->end = null;
                $dutydays[6]->update();
                Timeslot::where('dutyday_id', '=', $dutydays[6]->id)->delete();
            }

        return Redirect::route('dutydays.index');
	}

	/**
	 * Remove the specified dutyday from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Dutyday::destroy($id);

		return Redirect::route('dutydays.index');
	}

}
