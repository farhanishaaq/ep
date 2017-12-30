<?php

class Question extends \Eloquent {
	protected $fillable = ['doctor_id','patient_id','question'];

	public function user (){
	    $this->belongsTo('User');

    }

    public function article(){
	    $this->belongsTo('Article');

    }


    public function createQuestion($data){
        $doctor_id=$data['doctor_id'];
        if(Auth::check()){
            $user_id=Auth::user()->id;
        }else return false;

        $question = $data['question'];


        $this->doctor_id =$doctor_id;
        $this->patient_id =$user_id;
        $this->question = $question;
        $this->status='inProcess';
        $this->save();

        return true;
    }

    public function getQuestions(){

        if(Auth::check()){
            $questions=$this
                ->where('status','inProcess')
                ->orWhere('status','')
              //  ->where('doctor_id',Auth::user()->id)//must be uncommented on end
                ->where('doctor_id',1)
                ->get();
                 return $questions;

        }else {

            return false;
        }

    }

    public function updateStatus($id,$status){
        return $this->where('id', $id)
                    ->update(['status' => $status]);

    }

    public  function getQuestionById($id){
        return $this->findOrFail($id);
    }
}

