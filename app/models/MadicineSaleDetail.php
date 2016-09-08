<?php



class MadicineSaleDetail extends \Eloquent {
	
	protected $fillable = ['medicine_id','sale_id','quantity'];

	public static $rules = [
		'medicine_id' => 'required',
		'sale_id' => 'required',
		'quantity' => 'required',

	];
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function medicineSale()
	{
		return $this->belongsTo('MedicineSale');
	}

	public function medicine()
	{
		return $this->belongsTo('Medicine');
	}


}