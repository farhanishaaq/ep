<?php

class Prescription extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['code', 'note', 'patient_id', 'appointment_id', 'procedure',
                            'company_id', 'check_up_note', 'parent_id', 'refill'];

    // Relationships
    public function patient()
    {
        return $this->belongsTo('Patient');
    }

    public function appointment()
    {
        return $this->belongsTo('Appointment');
    }

    public function employee()
    {
        return $this->belongsTo('Employee');
    }

    public function medicines()
    {
        return $this->belongsToMany('Medicine','medicine_prescription','prescription_id','medicine_id')->withPivot('quantity');
    }

    public static function savePrescription($data,$dataProcessType=GlobalsConst::DATA_SAVE){
        $vRules = Prescription::$rules;
        if($dataProcessType==GlobalsConst::DATA_SAVE){
            $prescription = new Prescription();
        }elseif($dataProcessType==GlobalsConst::DATA_UPDATE){

            $id = isset($data['PrescriptionDetailId']) ? $data['PrescriptionDetailId'] : '';
            if($id != ''){
                $prescription = Prescription::find($id);
                //Delete Prescription Detail on Prescription Edit
                PrescriptionDetail::where('prescription_id','=',$id)->delete();
            }else{
                return $response = ['success'=>false, 'error'=> true, 'message' => ' record did not find for updation! '];
            }
        }
        //*****Start Rules Validators
//        $validator = Validator::make($data, $vRules);
//        if ($validator->fails())
//        {
//            return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
//        }
        //*****End Rules Validators
        $prescription->patient_id     = $data['patient_id'];
        $prescription->appointment_id = $data['appointment_id'];
        $prescription->code           = $data['code'];
        $prescription->check_up_note  = $data['check_up_note'];
        $prescription->check_up_photo = $data['photo'];
        $prescription->refill         = $data['refill'];
        $prescription->test_procedures= $data['test_procedure'];
        $prescription->parent_id      = isset($data['Prescription_id']) ? $data['Prescription_id'] : null;
        $prescription->save();

        $data['PrescriptionDetailId']= $prescription->id;
        $pdResult = PrescriptionDetail::savePrescriptionDetail($data,GlobalsConst::DATA_SAVE);
        if($pdResult['success'] == true){
            $response = ['success'=>true, 'error'=> false, 'message'=>'Prescription has been saved successfully!'];
        }
    }

    public static function fetchPrescriptionOfPatient($id)
    {

        return Prescription::where('patient_id','=',$id)->lists('code','id');
        //return Prescription::find($id);
    }

    
}