<?php

class DrugUsage extends \Eloquent
{

    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['drug_name', 'usage_note', 'patient_id', 'company_id'];

    // Relationships
    public function patient()
    {
        return $this->belongsTo('Patient');
    }
}