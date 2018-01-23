<?php

class Rating extends \Eloquent
{
    protected $fillable = ['doctor_id', 'rating'];


    public function user()
    {
        return $this->belongsTo('User');
    }

// in rating table only
    public function setDoctorRating($doctorId, $rating)
    {

        $savedRating = self::select('rating')
            ->where('doctor_id',$doctorId)
            ->get();
//dd();
//        $savedRating = self::find($doctorId);
        if (empty($savedRating)) {
            $this->doctor_id = $doctorId;
            //dd('dsadsadasd');
            $this->rating = $rating;
            $this->save();

        } else {
            //dd('in else');
            $newRate = ($savedRating[0]->rating + $rating) / 2;
        //    dd($newRate);
            self::where('doctor_id',$doctorId)
                ->update(['rating'=>$newRate]);
        };


    }

    public function getDoctorRating($doctorId)
    {
        $rating = $this->select('rating')
            ->where('doctor_id', '=', $doctorId)
            ->get();

        if ($rating->isEmpty()) {
            return 'noRecord';

        } else {
            return $rating;
        }
    }


}