<?php

class Rating extends \Eloquent {
	protected $fillable = ['doctor_id','rating'];



    public function user()
    {
        return $this->belongsTo('User');
    }


    public function setDoctorRating ($doctorId,$rating){

        $savedRating=self::find($doctorId);
        if($savedRating===NULL){
            $this->doctor_id=$doctorId;
            $this->rating=$rating;
            $this->save();
        }else{
            $savedRating->rating=($savedRating->rating+$rating)/2;
            $savedRating->save();
        };
    }

    public function getDoctorRating($doctorId){
        $rating = $this->select('rating')
            ->where('doctor_id','=',$doctorId)
            ->get();

        if($rating->isEmpty()){
            return json_encode('noRecord');

        }else{
            return json_encode($rating) ;
        }
    }


}