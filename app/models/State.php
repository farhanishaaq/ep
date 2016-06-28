<?php

class State extends \Eloquent {

	/**
	 * @var array
	 */
	protected $fillable = ['name','country_id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function country(){
		return $this->belongsTo('Country');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cities(){
		return $this->hasMany('City');
	}
}