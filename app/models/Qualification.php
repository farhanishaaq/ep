<?php

class Qualification extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function doctors()
    {
        return $this->belongsToMany('Doctor', 'doctor_qualification', 'qualification_id', 'doctor_id')->withPivot(['institute', 'start_date', 'end_date']);
    }



}