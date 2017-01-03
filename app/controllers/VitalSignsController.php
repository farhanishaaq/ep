<?php

use \App\Globals\GlobalsConst;

class VitalSignsController extends \BaseController {

    /**
     * Display a listing of vital_signs
     *
     * @return Response
     */
    public function index() {
        $patient_id = Input::get('id');

        $patient = Patient::find($patient_id);
        $appointments = Appointment::where('company_id', Auth::user()->company_id)->paginate(10);
//        $appointments = $patient->appointments()->has('vitalsign')->paginate(1);

        return View::make('vital_signs.index', compact('appointments', 'patient_id'));
    }

    /**
     * Show the form for creating a new vitalsign
     *
     * @return Response
     */
    public function create() {

        $formMode = GlobalsConst::FORM_CREATE;
        $patient_id = Input::get('patientId',null);
//        $appointment_id = Input::get('appointmentId',null);
         $appointment_id = Input::get('appointmentId',null);
         $vitalSign = "";

//            $vitalSigns = Appointment::where('patient_id', '=', $patient_id)->get();
//            $appointment_id = $vitalSigns[0]->id;
            return View::make('vital_signs.create')->nest('_form', 'vital_signs.partials._form', compact('formMode', 'patient_id','appointment_id', 'vitalSign'));

    }

    public function fetchVitalSignsByPatientId()
    {
        $formMode = GlobalsConst::FORM_EDIT;
        $patientId = Input::get('patientId',null);


        if($patientId !== null){

            $vitalSigns = VitalSign::where('patient_id','=',$patientId)->get();
            if($vitalSigns->count()) {

            return View::make('vital_signs.partials._fetchVitalSignsByPatientId',compact('formMode','patientId','vitalSigns'));
//            return View::make('appointments.show', compact('patientId','vitalSigns'))->nest('_form','vital_signs.partials._form'));

            }else{
            return 'You have not any record';
        }
        }
        else {
            return "Error";
        }

    }

    public function vitalSignFetchHistory()
    {
        $formMode = GlobalsConst::FORM_EDIT; //This is just a trick coz we are not eidting
        $VitalSignId = Input::get('VitalSignId');
        $vitalSign = VitalSign::where('id','=',$VitalSignId)->first();

//        echo $vitalSign[0]->weight;exit;
//        dd($vitalSign);
//        $patient_id = $vitalSigns[0]->patient_id;
//        $appointment_id = $vitalSigns[0]->appointment_id;
//        $vital_signs = VitalSign::find($parentVitalSignId);
//line 56, 57 id added by me with line 61 values adding for solve errors but did not working well till now
//      return View::make('vital_signs.partials._view', compact('formMode','vitalSigns'));
// this command is not working so i'm running command of line 60
      return View::make('vital_signs.partials._form', compact('formMode','vitalSign'));
//        return View::make('vital_signs.includes.modal_form')->nest('_form', 'vital_signs.partials._form', compact('formMode', 'vitalSign'));
    }

    /**
     * Store a newly created vitalsign in storage.
     *
     * @return Response
     */
    public function store() {
            $data = Input::all();
            $response = VitalSign::saveVitalSigns($data);
            return $response;

//        $validator = Validator::make($data = Input::all(), VitalSign::$rules);
//
//        if ($validator->fails()) {
//            return Redirect::back()->withErrors($validator)->withInput();
//        }
//       $data['company_id'] = Auth::user()->company_id;
//        VitalSign::create($data);
//
//        return Redirect::to('/app_vitals');
    }

    /**
     * Display the specified vitalsign.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
//      $vitalsign = VitalSign::where('appointment_id', $id)->get()->first();
        $vital_sign = VitalSign::where('patient_id', '=', $id)->get();
        $vitalsign = VitalSign::findOrFail($id);

        return View::make('vital_signs._partials._view', compact('vital_sign', 'vitalsign'));
    }

    /**
     * Show the form for editing the specified vitalsign.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $vitalsign = VitalSign::where('appointment_id', $id)->get()->first();

        return View::make('vital_signs.edit', compact('vitalsign'));
    }

    /**
     * Update the specified vitalsign in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $vitalsign = VitalSign::findOrFail($id);

        $validator = Validator::make($data = Input::all(), VitalSign::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data['patient_id'] = $vitalsign->patient_id;

        $vitalsign->update($data);

        return Redirect::to('vital_signs?id=' . $vitalsign->patient_id);
    }

    /**
     * Remove the specified vitalsign from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        VitalSign::destroy($id);

        return Redirect::route('vital_signs.index');
    }

}
