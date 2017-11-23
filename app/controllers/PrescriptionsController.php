<?php

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
        $prescription = null;
        $prescriptionsDetails = null;
        $prescriptionCheckUpImgPath = null;

        $_detail_row = View::make('prescriptions.partials._detail_row', compact('medicines', 'appointment', 'patient_id', 'doctors', 'formMode', 'prescriptionNextCount', 'prescriptionsDetails', 'prescriptionCheckUpImgPath'));
        return View::make('prescriptions.create')->nest('_form','prescriptions.partials._form', compact('medicines', 'appointment', 'patient_id', 'doctors', 'formMode', 'prescriptionNextCount','_detail_row','prescription','prescriptionCheckUpImgPath'));
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
        $formMode = GlobalsConst::FORM_EDIT;
        $prescription = Prescription::find($id);
        $prescriptionsDetails = PrescriptionDetail::where('prescription_id','=',$id)->get();
        $appointment = Appointment::find($prescription->appointment_id);

        $prescriptionNextCount = "";
        $chkupPrescriptionImgDir = Ep::checkUpPrescriptionDirectory();
        $prescriptionCheckUpImgPath = asset($chkupPrescriptionImgDir.'/'.$prescription->check_up_photo);

        $_detail_row = View::make('prescriptions.partials._detail_row', compact('medicines', 'appointment', 'patient_id', 'doctors', 'formMode', 'prescriptionNextCount', 'prescriptionsDetails', 'prescriptionCheckUpImgPath'));
        return View::make('prescriptions.edit')->nest('_form','prescriptions.partials._form', compact('medicines', 'appointment', 'patient_id', 'doctors', 'formMode','prescriptionNextCount','_detail_row','prescription'));

        //return View::make('prescriptions.edit')->nest('_form','prescriptions.partials._form',compact('formMode','prescription'));


    }

    /**
     * Update the specified prescription in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $data = Input::all();
        $data['PrescriptionDetailId'] = $id;
        $result = Prescription::savePrescription($data, GlobalsConst::DATA_UPDATE);
        return $result;
        dd($data);
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
