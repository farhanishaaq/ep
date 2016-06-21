<?php

class Patient extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
        'name' => 'required',
        'gender' => 'required',
        'age' => 'required',
        'city' => 'required',
        'country' => 'required',
        'address' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'dob', 'gender', 'age', 'email', 'city', 'country', 'address',
    'phone', 'cnic', 'note', 'company_id'];

//  Relationships
    public function allergies()
    {
        return $this->hasMany('Allergy');
    }

    public function drugUsages()
    {
        return $this->hasMany('DrugUsage');
    }

    public function familyHistories()
    {
        return $this->hasMany('FamilyHistory');
    }

    public function previousDiseases()
    {
        return $this->hasMany('PreviousDisease');
    }

    public function surgicalhistories()
    {
        return $this->hasMany('SurgicalHistory');
    }

    public function diagonosticprocedures()
    {
        return $this->hasMany('Diagonosticprocedure');
    }

    public function vitalSigns()
    {
        return $this->hasMany('VitalSign');
    }

    public function labtests()
    {
        return $this->hasMany('Labtest');
    }

    public function appointments()
    {
        return $this->hasMany('Appointment');
    }

    public function prescriptions()
    {
        return $this->hasMany('Prescription');
    }

    public function checkupfees()
    {
        return $this->hasMany('Checkupfee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }
}