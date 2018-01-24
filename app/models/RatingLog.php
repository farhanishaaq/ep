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

                $check = $this->testRatingExist($data["doctorId"]);
//dd($check);
//                    $check = self::select()
//                    ->where('patient_id', '=', Auth::user()->id)
//                    ->where('doctor_id', '=', $data["doctorId"])
//                    ->get();
                    if ($check) {
                        $this->patient_id = Auth::user()->id;
                        $this->doctor_id = $data['doctorId'];
                        $this->rating_count = $data['rating'];
//dd($this);
                        //in only rating table
                        $rating = new Rating();
                        $rating->setDoctorRating($data['doctorId'], $data['rating']);
                        $this->save();

                        return $check;

                    } else {
                        return $this->getDoctorRating($data["doctorId"]);
                    }


            } else return false;

    }

    public function testRatingExist($data){
        $check = self::select()
                    ->where('patient_id', '=', Auth::user()->id)
                    ->where('doctor_id', '=', $data)
                    ->get();

        if($check->isEmpty()){
            return true;

        }else{

            return false;

        }


    }


}