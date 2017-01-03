<?php
use App\Globals\GlobalsConst;
use \App\Globals\Ep;

class RatingLog extends \Eloquent {

    // Add your validation rules here
//    public static $rules = [
//
//        'rating' => 'required',
//        'doctor_id' => 'required',
//        'user_id' => 'required',
//    ];


    protected $fillable = ['user_id', 'doctor_id', 'rating'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function doctor()
    {
        return $this->belongsTo('Doctor');
    }

    public static function saveRatings($data,$dataProcessType=GlobalsConst::DATA_SAVE){
//        $vRules = RatingLog::$rules;
//        if($dataProcessType==GlobalsConst::DATA_SAVE){
//            $rating = new RatingLog();
//        }elseif($dataProcessType==GlobalsConst::DATA_UPDATE){
//
//            $id = isset($data['rating']) ? $data['rating'] : '';
//            if($rating != ''){
//                $rating = RatingLog::find($rating);
//            }else{
//                return $response = ['success'=>false, 'error'=> true, 'message' => ' record did not find for updation! '];
//            }
//        }
//        dd($data);

//        //*****Start Rules Validators
//        $validator = Validator::make($data, $vRules);
//        if ($validator->fails())
//        {
//            return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
//        }
//        //*****End Rules Validators

        $rating = new RatingLog();

        $ratingOfDoctor = explode(" ",$data['rating']);
        $ratings = $ratingOfDoctor['0'];

        $rating->user_id      = $data['user_id'];
        $rating->doctor_id    = $data['doctor_id'];
        $rating->rating    = $ratings;
        $rating->title      = $data['title'];
        $rating->description      = $data['description'];

        $rating->save();

        $response = ['success'=>true, 'error'=> false, 'message'=> 'Comments has been saved successfully!'];
        return $response;
    }

}