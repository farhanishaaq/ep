<?php

class Company extends \Eloquent {

    /**
     * @var array
     */
	protected $fillable = ['name', 'city_id', 'address', 'phone', 'fax'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businessUnits(){
        return $this->hasMany('BusinessUnits');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees(){
        return $this->hasMany('Employee');
    }

    public function admin(){
        return $this->hasOne('Employee')->where('role', 'Administrator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(){
        return $this->belongsTo('City');
    }
}