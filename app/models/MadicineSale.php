<?php



class MadicineSale extends \Eloquent {
	
	protected $fillable = ['patient_id','date'];

	public static $rules = [
		'sale_id' => 'required',

	];

	public function medicineSaleDetails()
	{
		return $this->hasMany('MedicineSaleDetail');
	}

	public function patient()
	{
		return $this->belongsTo('Patient');
	}
}