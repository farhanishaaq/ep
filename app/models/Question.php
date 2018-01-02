<?php

class Question extends \Eloquent
{
    protected $fillable = ['doctor_id', 'patient_id', 'question'];

    public function user()
    {
        $this->belongsTo('User');

    }

    public function article()
    {
        $this->belongsTo('Article');

    }


    public function createQuestion($data)
    {
        $doctor_id = $data['doctor_id'];
        $user_id = Auth::user()->id;
        $question = $data['question'];


        $this->doctor_id = $doctor_id;
        $this->patient_id = $user_id;
        $this->question = $question;
        $this->status = 'inProcess';
        $this->save();

        return true;
    }

    public function getQuestions($id)
    {

        if (Auth::user()->id = $id) {
            $questions = $this
                //->where('status','inProcess')
                ->where('doctor_id', $id)
                ->get();
            return $questions;

        } else {

            return false;
        }


    }

}

