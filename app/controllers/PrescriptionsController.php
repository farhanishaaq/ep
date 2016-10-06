<?php

use App\Globals\GlobalsConst;
use App\Globals\Ep;

class PrescriptionsController extends \BaseController
{

    /**
     * Display a listing of prescriptions
     *
     * @return Response
     */
    public function index()
    {
        $prescriptions = Prescription::paginate(20);
        return View::make('prescriptions.index')->nest('_list','prescriptions.partials._list', compact('prescriptions'));
    }

    /**
     * Display a listing of prescriptions
     *
     * @return Response
     */
    public function patientPrescriptions($patientId)
    {
        $prescriptions = Prescription::where('patient_id','=',$patientId)->get();
        return View::make('prescriptions.partials._list', compact('prescriptions'));
    }

    /**
     * Show the form for creating a new prescription
     *
     * @return Response
     */
    public function create()
    {
        $formMode = GlobalsConst::FORM_CREATE;
        $appointmentId = Input::get('appointmentId',null);
        if($appointmentId == null){
            return Redirect::route('appointments.index')->with('appointmentErrorMsg','Appointment does not exist');
        }
        $appointment = Appointment::find(Input::get('appointmentId'));
        $patient_id = $appointment->patient_id;
        $prescriptionNextCount = (int)(Prescription::where('patient_id','=',$patient_id)->count()) + 1;

        $medicines= null;
        $prescriptionsDetails = null;
        $prescriptionCheckUpImgPath = null;

        $_detail_row = View::make('prescriptions.partials._detail_row', compact('medicines', 'appointment', 'patient_id', 'doctors', 'formMode', 'prescriptionNextCount', 'prescriptionsDetails', 'prescriptionCheckUpImgPath'));
        return View::make('prescriptions.create')->nest('_form','prescriptions.partials._form', compact('medicines', 'appointment', 'patient_id', 'doctors', 'formMode', 'prescriptionNextCount','_detail_row'));
    }


    public function followUpPrescriptions()
    {
        $parentPrescriptionId = Input::get('parentPrescriptionId');
        $prescriptionsDetails = PrescriptionDetail::where('prescription_id','=',$parentPrescriptionId)->get();
        $prescription = Prescription::find($parentPrescriptionId);

        $chkupPrescriptionImgDir = Ep::checkUpPrescriptionDirectory();
        $prescriptionCheckUpImgPath = asset($chkupPrescriptionImgDir.'/'.$prescription->check_up_photo);

        return View::make('prescriptions.partials._detail_row', compact('prescriptionsDetails','prescriptionCheckUpImgPath'));
    }


    /**
     * Store a newly created prescription in storage.
     *
     * @return Response
     */
    public function store()
    {

        $data = Input::all();

        $result = Prescription::savePrescription($data);
        return $result;


    }

    /**
     * Display the specified prescription.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
//        $prescription = Prescription::with('medicines')->where('appointment_id', $id)->first();
        $prescription = Prescription::find($id);
        $medicines = $prescription->medicines()->get();
//        dd($medicines);
        return View::make('prescriptions.show')
                            ->nest('_viewPrescription','prescriptions.partials._viewPrescription', compact('prescription', 'medicines'));
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

        $medicines = Medicine::where('company_id', Auth::user()->company_id)->get()->lists('name', 'id');
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

    public function printPrescription($id)
    {
        $prescription = Prescription::find($id);
        $medicines = $prescription->medicines()->get();
        $_viewPrescription = View::make('prescriptions.partials._viewPrescription', compact('prescription', 'medicines'))->render();
        return PDF::html('prescriptions.printPrescription',compact('_viewPrescription'));
    }

    public function uploadCheckUpPic(){
        $response = null;

        if (Input::hasFile('checkUpPhoto')) {
            $file            = Input::file('checkUpPhoto');
            $destinationPath = public_path(EP::checkUpPrescriptionDirectory());
            $filename        = str_random(4).'_'.$file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
//			$response = ['success'=>true,'error'=>false,'message'=>'Photo has been uploaded successfully!','uploadedFileName'=>$filename,'abc'=>$uploadSuccess];
            $response = ['success'=>true,'uploaded'=>$filename,'message'=>'Photo has been uploaded successfully!'];

        }else{
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
            $response = ['success'=>false,'error'=>'No files were processed.'];
        }
        return Response::json($response);
    }

    public function deleteCheckUpPic()
    {
        $response = null;
        if (Input::get('imageName')) {
            $file = Input::get('imageName');
            $destinationPath = public_path(EP::checkUpPrescriptionDirectory());
            unlink($destinationPath .'/'. $file );
            $response = ['success'=>true,'uploaded'=>$file,'message'=>'Photo has been Deleted successfully!'];

        }else{
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
            $response = ['success'=>false,'error'=>'No files were processed.'];
        }
        return Response::json($response);


    }

}
