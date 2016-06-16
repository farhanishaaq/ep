<?php

class Medicine extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'name' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'quantity', 'description', 'company_id'];

	public function prescriptions()
	{
		return $this->belongsToMany('Prescription','medicine_prescriptions','medicine_id','prescription_id')->wherePivot('quantity');
	}
}