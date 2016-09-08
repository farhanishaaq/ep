<?php



class MedicinePurchaseDetail extends \Eloquent {
	
	protected $fillable = ['medicine_id','purchase_id','unit_price','quantity'];

	public static $rules = [
		'medicine_id' => 'required',
		'purchase_id' => 'required',
		'unit_price' => 'required',
		'quantity' => 'required',

	];

	public function medicineSale()
	{
		return $this->belongsTo('MedicineSale');
	}

	public function medicinePurchases()
	{
		return $this->hasMany('MedicinePurchase');
	}

}