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

    
}