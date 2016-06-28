<?php

class BusinessUnit extends \Eloquent {

	/**
	 * @var string
	 */
	protected $table = 'business_units';

	/**
	 * @var array
	 */
	protected $fillable = ['name', 'company_id', 'city_id', 'address', 'phone', 'fax'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function company(){
		return $this->belongsTo('Company');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function city(){
		return $this->belongsTo('City');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function appointments(){
		return $this->hasMany('Appointment');
	}
}