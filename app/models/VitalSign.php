<?php

class VitalSign extends \Eloquent {

	// Add your validation rules here
	public static $rules = [

		'weight' => 'required',
		'height' => 'required',
		'bp_systolic' => 'required',
		'bp_diastolic' => 'required',
		'pulse_rate' => 'required',
		'respiration_rate' => 'required',
		'temperature' => 'required',
		'gait_speed' => 'required',
		'addiction' => 'required',
		'communities' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['weight', 'height', 'bp_systolic', 'bp_diastolic', 'blood_group',
        'pulse_rate', 'respiration_rate', 'temperature','gait_speed','addiction','communities', 'note', 'patient_id',
        'appointment_id', 'company_id'];

	public function patient()
    {
        return $this->belongsTo('Patient', 'patient_id');
    }

    public function appointment()
    {
        return $this->belongsTo('Appointment');
    }

	public static function saveVitalSigns($data,$dataProcessType=GlobalsConst::DATA_SAVE){
		$vRules = VitalSign::$rules;
		if($dataProcessType==GlobalsConst::DATA_SAVE){
			$vital_signs = new VitalSign();
		}elseif($dataProcessType==GlobalsConst::DATA_UPDATE){

			$id = isset($data['id']) ? $data['id'] : '';
			if($id != ''){
				$vital_signs = VitalSign::find($id);
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

		$vital_signs = new VitalSign();

		//$vital_signs->id  = 2;
		$vital_signs->patient_id    = $data['patient_id'];
		$vital_signs->appointment_id= $data['appointment_id'];
		$vital_signs->weight     	= $data['weight'];
		$vital_signs->height  		= $data['height'];
		$vital_signs->bp_systolic  	= $data['bp_systolic'];
		$vital_signs->bp_diastolic  = $data['bp_diastolic'];
		$vital_signs->blood_group  	= $data['blood_group'];
		$vital_signs->pulse_rate 	= $data['pulse_rate'];
		$vital_signs->respiration_rate	= $data['respiration_rate'];
		$vital_signs->temperature  	= $data['temperature'];
		$vital_signs->gait_speed    = $data['gait_speed'];
		$vital_signs->addiction  	= $data['addiction'];
		$vital_signs->communities   = $data['communities'];
		$vital_signs->note  		= $data['note'];

		$vital_signs->save();


		$response = ['success'=>true, 'error'=> false, 'message'=> 'Medicine has been saved successfully!'];
		return $response;
	}
}