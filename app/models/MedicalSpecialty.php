<?php

class MedicalSpecialty extends \Eloquent {

	protected $fillable = ['parent_id','name','description'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function doctors()
	{
		return $this->belongsToMany('Doctor','doctor_medical_specialty', 'medical_specialty_id', 'doctor_id');
	}
}