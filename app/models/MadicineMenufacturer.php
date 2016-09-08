<?php



class MadicineMenufacturer extends \Eloquent {
	
	protected $fillable = ['name','contact','email','address'];

	public static $rules = [

		'email' => 'required|unique:manufacturers',
		'name' => 'required',
	];

	public function medicinePurchases()
	{
		return $this->hasMany('MedicinePurchase');
	}

	public function medicines()
	{
		return $this->hasMany('Medicine');
	}

	public function medicineCategories()
	{
		return $this->hasMany('MedicineCategory');
	}
}