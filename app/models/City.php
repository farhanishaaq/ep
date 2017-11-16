<?php

class City extends \Eloquent {
	/**
	 * @var array
	 */
	protected $fillable = ['name','state_id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function state(){
		return $this->belongsTo('State');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function companies(){
		return $this->hasMany('Companies');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function businessUnits(){
		return $this->hasMany('BusinessUnits');
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function users(){
		return $this->hasMany('User');
	}

    public function citiesForSelect(){
	    $cities = self::select('name','id')

            ->get();
	    return $cities;
    }
}