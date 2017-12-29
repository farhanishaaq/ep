<?php

class Article extends \Eloquent {
	protected $fillable = ['patient_id','doctor_id','article_text','title'];





    public function saveArticle ($data){

        $doctor_id = Auth::user()->id;

        $text=$data['body'];
        $title = $data['title'];
        $this->doctor_id = $doctor_id;
        $this->article_text = $text;
        $this->title = $title;
        $this->save();
        return 'sucess';
    }



}