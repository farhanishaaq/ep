<?php

class RatingLog extends \Eloquent
{
    protected $fillable = ['patient_id', 'doctor_id', 'rating_count'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * @param $doctorId
     */
    public function getDoctorRating($doctorId)
    {
        $doctorRating = self::where('doctor_id', '=', $doctorId)
            ->avg('rating_count');
        return $doctorRating;
    }


    /**
     * @param $doctorId
     * @param $userId
     * @param $rating
     */
    function setRatingOfDoctor(array $data)
    {
        //		$data['user_id'] = Input::get('userId');
//		$data['rating'] = Input::get('rating');
            if (Auth::check()){


                    $check = self::select()
                        ->where('patient_id', '=', Auth::user()->id)
                        ->where('doctor_id', '=', $data["doctorId"])
                        ->get();
                    if ($check->isEmpty()) {
                        $this->patient_id = Auth::user()->id;
                        $this->doctor_id = $data['doctorId'];
                        $this->rating_count = $data['rating'];
                        $rating = new Rating();
                        $rating->setDoctorRating($data['doctorId'], $data['rating']);
                        $this->save();
                        return $check;
                    } else {
                        return $this->getDoctorRating($data["doctorId"]);
                    }


            } else return false;

    }

}