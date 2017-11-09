<?php

class Answer extends \Eloquent {
	protected $fillable = ['question_id','doctor_id','patient_id','answer'];
}