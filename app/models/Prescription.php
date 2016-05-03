<?php

class Prescription extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['code', 'medicines', 'note', 'patient_id', 'appointment_id', 'procedure',
                            'clinic_id'];

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
        return $this->belongsToMany('Prescription','medicine_prescriptions','medicine_id','prescription_id');
    }

    
}