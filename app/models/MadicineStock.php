<?php



class MadicineStock extends \Eloquent {

	protected $fillable = ['medicine_id','location_id','business_id','minimum_stock','quantity'];

	public static $rules = [
		'business_unit_id' => 'required',
		'quantity' => 'required',

	];

	public function businessUnit()
	{
		return $this->belongsTo('BusinessUnit');
	}

	public function medicine()
	{
		return $this->belongsTo('Medicine');
	}

	public function location()
	{
		return $this->belongsTo('MedicineLocation');
	}
}