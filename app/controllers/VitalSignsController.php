<?php

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
        $appointment = Appointment::findOrFail(Input::get('id'));

        return View::make('vital_signs.create', compact('appointment'));
    }

    /**
     * Store a newly created vitalsign in storage.
     *
     * @return Response
     */
    public function store() {
        $validator = Validator::make($data = Input::all(), VitalSign::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data['company_id'] = Auth::user()->company_id;
        VitalSign::create($data);

        return Redirect::to('/app_vitals');
    }

    /**
     * Display the specified vitalsign.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $vitalsign = VitalSign::where('appointment_id', $id)->get()->first();

        return View::make('vital_signs.show', compact('vitalsign'));
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

        return Redirect::to('vitalSigns?id=' . $vitalsign->patient_id);
    }

    /**
     * Remove the specified vitalsign from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        VitalSign::destroy($id);

        return Redirect::route('vitalSigns.index');
    }

}
