<?php

class Article extends \Eloquent {
	protected $fillable = ['patient_id','doctor_id','article_text'];

    public function user (){
        $this->belongsTo('User');

    }

    public  function question(){

        $this->hasMany('Question');
    }



}