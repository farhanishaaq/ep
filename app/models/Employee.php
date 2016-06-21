<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Employee extends \Eloquent{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array

	protected $fillable = ['company_id', 'business_unit_id', 'user_id', 'fname', 'lname', 'joining_date', 'quite_date', 'joining_salary', 'current_salary'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companies()
    {
        return $this->hasMany('Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businessUnits()
    {
        return $this->hasMany('BusinessUnit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dutyDays()
    {
        return $this->hasMany('DutyDay');
    }

    public function appointments()
    {
        return $this->hasMany('Appointment');
    }

    public function prescriptions()
    {
        return $this->hasMany('Prescription');
    }

    public function company(){
        return $this->belongsTo('Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }
}