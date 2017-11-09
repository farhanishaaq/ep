<?php

class RatingLog extends \Eloquent {
	protected $fillable = ['patient_id','doctor_id','rating_count'];
}