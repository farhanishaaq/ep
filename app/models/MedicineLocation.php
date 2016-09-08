<?php



class MedicineLocation extends \Eloquent {
	
	protected $fillable = ['name'];

	public static $rules = [
		'name' => 'required'
	];

	public function medicineStocks()
	{
		return $this->hasMany('MedicineStock');
	}
}