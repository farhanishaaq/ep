<?php

class LikeLog extends \Eloquent {
	protected $fillable = ['patient_id','article_id','like_count'];
}