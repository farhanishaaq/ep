<?php

class Medicine extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'name' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'quantity', 'description', 'company_id'];

	public function menufacturer()
	{
		return $this->belongsTo('MedicineMenufacturer');
	}

	public function prescriptions()
	{
		return $this->belongsToMany('Prescription','medicine_prescription','medicine_id','prescription_id')->wherePivot('quantity');
	}

	public function medicineStocks(){
		return $this->hasMany('MedicineStock');
	}

	public function medicinePurchaseDetails(){
		return $this->hasMany('MedicinePurchaseDetail');
	}

	public function medicineSaleDetails(){
		return $this->hasMany('MedicineSaleDetail');
	}

}