<?php

class Article extends \Eloquent {
	protected $fillable = ['patient_id','doctor_id','article_text'];
}