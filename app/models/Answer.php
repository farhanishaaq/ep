<?php

class Answer extends \Eloquent {
	protected $fillable = ['question_id','user_id','answer'];

	public function user(){
        $this->belongsTo('User');

    }

    public function question(){

        $this->belongsTo('Question');
    }

    public function saveAnswer($data){


            $this->question_id=$data['questionId'];
            if (Auth::check()){
                $this->user_id=Auth::user()->id;
            }
            $this->answer= $data['answer'];
            $this->save();


    }



}