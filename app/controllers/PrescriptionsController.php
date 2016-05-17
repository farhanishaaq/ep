<?php

class PrescriptionsController extends \BaseController
{

    /**
     * Display a listing of prescriptions
     *
     * @return Response
     */
    public function index()
    {
        $patient_id = Input::get('id');
        $patient = Patient::find($patient_id);
        $appointments = $patient->appointments()->has('prescription')->paginate(10);

        return View::make('prescriptions.index', compact('appointments', 'patient_id'));
    }

    /**
     * Show the form for creating a new prescription
     *
     * @return Response
     */
    public function create()
    {
        $formMode = GlobalsConst::FORM_CREATE;
        $appointment = Appointment::find(Input::get('id'));
        $patient_id = $appointment->patient_id;
        $doctors = Employee::where('role', 'Doctor')->where('status', 'Active')->where('clinic_id', Auth::user()->clinic_id)->get();
        $medicines = Medicine::where('clinic_id', Auth::user()->clinic_id)->get()->lists('name', 'id');

        return View::make('prescriptions.create')->nest('_form','prescriptions.partials._form', compact('medicines', 'appointment', 'patient_id', 'doctors', 'formMode'));
    }

    /**
     * Store a newly created prescription in storage.
     *
     * @return Response
     */
    public function store()
    {

        $validator = Validator::make($data = Input::all(), Prescription::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $data['clinic_id'] = Auth::user()->clinic_id;
        $prescription = Prescription::create($data);

        $quantity = Input::get('quantity');
        foreach (Input::get('medicineName') as $key => $value) {

            if ($value != null) {
                $medicine = Medicine::find($value);
                if ($quantity[$key] < $medicine->quantity) {
                    $medicine->quantity -= $quantity[$key];
                } else {
                    $medicine->quantity = 0;
                }
                $medicine->update();
                Medicine::find($value)->prescriptions()->attach($prescription->id, array('quantity' => $quantity[$key]));
            }
        }
        return Redirect::route('appointments.index');
    }

    /**
     * Display the specified prescription.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $prescription = Prescription::with('medicines')->where('appointment_id', $id)->first();
        if (Input::get('flag') != null) {
            $flag = Input::get('flag');
        }
        $medicines = $prescription->medicines()->get();

        return View::make('prescriptions.show', compact('prescription', 'flag', 'medicines'));
    }

    /**
     * Show the form for editing the specified prescription.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $prescription = Prescription::where('appointment_id', $id)->get()->first();

        $medicines = Medicine::where('clinic_id', Auth::user()->clinic_id)->get()->lists('name', 'id');
        return View::make('prescriptions.edit', compact('medicines', 'prescription'))->nest('_form','prescriptions.partials._form', compact('medicines', 'appointment', 'patient_id', 'doctors', 'formMode'));;


    }

    /**
     * Update the specified prescription in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $prescription = Prescription::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Prescription::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data['patient_id'] = $prescription->patient_id;

        if (Input::get('medicine1_id') != null) {
            $medicine = Medicine::find(Input::get('medicine1_id'));
            if ($medicine->id != $prescription->medicine1_id) {
                if (Input::get('med1_qty') < $medicine->quantity) {
                    $medicine->quantity -= Input::get('med1_qty');
                } else {
                    $data['med1_qty'] = $medicine->quantity;
                    $medicine->quantity = 0;
                }
            } else {
                if ($prescription->med1_qty < Input::get('med1_qty')) {
                    $difference = Input::get('med1_qty') - $prescription->med1_qty;
                    $medicine->quantity -= $difference;
                } else if ($prescription->med1_qty > Input::get('med1_qty')) {
                    $difference = $prescription->med1_qty - Input::get('med1_qty');
                    $medicine->quantity += $difference;
                }
                if ($medicine->quantity < 0) {
                    $medicine->quantity = 0;
                    $data['med1_qty'] = 0;
                }
            }
            $medicine->update();
        } else {
            $data['medicine1_id'] = null;
            $data['med1_qty'] = 0;
        }

        if (Input::get('medicine2_id') != null) {
            $medicine = Medicine::find(Input::get('medicine2_id'));
            if ($medicine->id != $prescription->medicine2_id) {
                if (Input::get('med2_qty') < $medicine->quantity) {
                    $medicine->quantity -= Input::get('med2_qty');
                } else {
                    $data['med2_qty'] = $medicine->quantity;
                    $medicine->quantity = 0;
                }
            } else {
                if ($prescription->med2_qty < Input::get('med2_qty')) {
                    $difference = Input::get('med2_qty') - $prescription->med2_qty;
                    $medicine->quantity -= $difference;
                } else if ($prescription->med2_qty > Input::get('med2_qty')) {
                    $difference = $prescription->med2_qty - Input::get('med2_qty');
                    $medicine->quantity += $difference;
                }
                if ($medicine->quantity < 0) {
                    $medicine->quantity = 0;
                    $data['med2_qty'] = 0;
                }
            }
            $medicine->update();
        } else {
            $data['medicine2_id'] = null;
            $data['med2_qty'] = 0;
        }

        if (Input::get('medicine3_id') != null) {
            $medicine = Medicine::find(Input::get('medicine3_id'));
            if ($medicine->id != $prescription->medicine3_id) {
                if (Input::get('med3_qty') < $medicine->quantity) {
                    $medicine->quantity -= Input::get('med3_qty');
                } else {
                    $data['med3_qty'] = $medicine->quantity;
                    $medicine->quantity = 0;
                }
            } else {
                if ($prescription->med3_qty < Input::get('med3_qty')) {
                    $difference = Input::get('med3_qty') - $prescription->med3_qty;
                    $medicine->quantity -= $difference;
                } else if ($prescription->med3_qty > Input::get('med3_qty')) {
                    $difference = $prescription->med3_qty - Input::get('med3_qty');
                    $medicine->quantity += $difference;
                }
                if ($medicine->quantity < 0) {
                    $medicine->quantity = 0;
                    $data['med3_qty'] = 0;
                }
            }
            $medicine->update();
        } else {
            $data['medicine3_id'] = null;
            $data['med3_qty'] = 0;
        }

        if (Input::get('medicine4_id') != null) {
            $medicine = Medicine::find(Input::get('medicine4_id'));
            if ($medicine->id != $prescription->medicine4_id) {
                if (Input::get('med4_qty') < $medicine->quantity) {
                    $medicine->quantity -= Input::get('med4_qty');
                } else {
                    $data['med4_qty'] = $medicine->quantity;
                    $medicine->quantity = 0;
                }
            } else {
                if ($prescription->med4_qty < Input::get('med4_qty')) {
                    $difference = Input::get('med4_qty') - $prescription->med4_qty;
                    $medicine->quantity -= $difference;
                } else if ($prescription->med4_qty > Input::get('med4_qty')) {
                    $difference = $prescription->med4_qty - Input::get('med4_qty');
                    $medicine->quantity += $difference;
                }
                if ($medicine->quantity < 0) {
                    $medicine->quantity = 0;
                    $data['med4_qty'] = 0;
                }
            }
            $medicine->update();
        } else {
            $data['medicine4_id'] = null;
            $data['med4_qty'] = 0;
        }

        if (Input::get('medicine5_id') != null) {
            $medicine = Medicine::find(Input::get('medicine5_id'));
            if ($medicine->id != $prescription->medicine5_id) {
                if (Input::get('med5_qty') < $medicine->quantity) {
                    $medicine->quantity -= Input::get('med5_qty');
                } else {
                    $data['med5_qty'] = $medicine->quantity;
                    $medicine->quantity = 0;
                }
            } else {
                if ($prescription->med5_qty < Input::get('med5_qty')) {
                    $difference = Input::get('med5_qty') - $prescription->med5_qty;
                    $medicine->quantity -= $difference;
                } else if ($prescription->med5_qty > Input::get('med5_qty')) {
                    $difference = $prescription->med5_qty - Input::get('med5_qty');
                    $medicine->quantity += $difference;
                }
                if ($medicine->quantity < 0) {
                    $medicine->quantity = 0;
                    $data['med5_qty'] = 0;
                }
            }
            $medicine->update();
        } else {
            $data['medicine5_id'] = null;
            $data['med5_qty'] = 0;
        }

        if (Input::get('medicine6_id') != null) {
            $medicine = Medicine::find(Input::get('medicine6_id'));
            if ($medicine->id != $prescription->medicine6_id) {
                if (Input::get('med6_qty') < $medicine->quantity) {
                    $medicine->quantity -= Input::get('med6_qty');
                } else {
                    $data['med6_qty'] = $medicine->quantity;
                    $medicine->quantity = 0;
                }
            } else {
                if ($prescription->med6_qty < Input::get('med6_qty')) {
                    $difference = Input::get('med6_qty') - $prescription->med6_qty;
                    $medicine->quantity -= $difference;
                } else if ($prescription->med6_qty > Input::get('med6_qty')) {
                    $difference = $prescription->med6_qty - Input::get('med6_qty');
                    $medicine->quantity += $difference;
                }
                if ($medicine->quantity < 0) {
                    $medicine->quantity = 0;
                    $data['med6_qty'] = 0;
                }
            }
            $medicine->update();
        } else {
            $data['medicine6_id'] = null;
            $data['med6_qty'] = 0;
        }

        $prescription->update($data);

        return Redirect::to('prescriptions?id=' . $prescription->patient_id);
    }

    /**
     * Remove the specified prescription from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Prescription::destroy($id);

        return Redirect::route('prescriptions.index');
    }

    public function printPrescription()
    {
        $appointments = Appointment::has('prescription')->where('clinic_id', Auth::user()->clinic_id)->paginate(10);
        $flag = "pres_print";
        return View::make('appointment_based_data.appointments', compact('appointments', 'flag'));
    }

}
