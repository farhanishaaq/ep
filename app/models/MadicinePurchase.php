<?php



class MadicinePurchase extends \Eloquent {
	
	protected $fillable = ['business_unit_id','manufacturer_id','unit_price','date'];

	public static $rules = [
		'business_unit_id' => 'required',
		'unit_price' => 'required',
	];

	public function purchaseDetails()
	{
		return $this->hasMany('MedicinePurchaseDetail');
	}

	public function businessUnit()
	{
		return $this->belongsTo('BusinessUnit');
	}

	public function manufacturer(){
		return $this->belongsTo('MedicineManufacturer');
	}

}