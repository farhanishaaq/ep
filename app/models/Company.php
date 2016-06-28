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
        return $this->hasMany('BusinessUnit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(){
        return $this->hasMany('User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees(){
        return $this->hasMany('Employee');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(){
        return $this->belongsTo('City');
    }
}