<?php

class Question extends \Eloquent {
	protected $fillable = ['doctor_id','patient_id','question'];
}