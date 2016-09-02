<?php

class PrescriptionDetail extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['prescription_id', 'medicine_id', 'usage_type', 'dosage_strength', 'usage_quantity',
                            'quantity_unit','frquencies', 'conditional_note','extra_note'];

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

    public static function savePrescriptionDetail($data,$dataProcessType=GlobalsConst::DATA_SAVE){
        $vRules = PrescriptionDetail::$rules;





        $medicineIds = $data['medicine_id'];
        foreach ($medicineIds as $k => $mId){
            if($k == -1){
                continue;
            }
            if($dataProcessType==GlobalsConst::DATA_SAVE){
                $prescription_detail = new PrescriptionDetail();
            }elseif($dataProcessType==GlobalsConst::DATA_UPDATE){

                $id = isset($data['PrescriptionDetailId']) ? $data['PrescriptionDetailId'] : '';
                if($id != ''){
                    $prescription_detail = PrescriptionDetail::find($id);
                }else{
                    return $response = ['success'=>false, 'error'=> true, 'message' => ' record did not find for updation! '];
                }
            }

            //*****Start Rules Validators
            $validator = Validator::make($data, $vRules);
            if ($validator->fails())
            {
                return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
            }
            //*****End Rules Validators

            $prescription_detail->prescription_id   = $data['prescriptionId'];
            $prescription_detail->medicine_id       = 2;
            $prescription_detail->usage_type        = $data['usage_type'][$k];
            $prescription_detail->dosage_strength   = $data['dosage_strength'][$k];
            $prescription_detail->usage_quantity    = $data['usage_quantity'][$k];;
            $prescription_detail->quantity_unit     = $data['quantity_unit'][$k];
            $prescription_detail->frequencies       = $data['frequencies'][$k];
            $prescription_detail->conditional_note  = $data['conditional_note'][$k];
            $prescription_detail->extra_note        = $data['extra_note'][$k];
            $prescription_detail->save();
        }
        $response = ['success'=>true, 'error'=> false, 'message'=> 'Prescription Detail has been saved successfully!'];
        return $response;
    }
}