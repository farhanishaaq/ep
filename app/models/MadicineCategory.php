<?php



class MedicineCategory extends \Eloquent {
	
	protected $fillable = ['name','parent_id','manufacturer_id','dosage_form','description','is_derived'];


	public function medicineStocks()
	{
		return $this->hasMany('MedicineStock');
	}

	public function menufacturer()
	{
		return $this->belongsTo('MedicineMenufacturer');
	}

}