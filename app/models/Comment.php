<?php
use App\Globals\GlobalsConst;
use \App\Globals\Ep;

class Comment extends \Eloquent {

    // Add your validation rules here
//    public static $rules = [
//
//        'status' => 'required',
//        'doctor_id' => 'required',
//        'user_id' => 'required',
//    ];


    protected $fillable = ['user_id', 'doctor_id', 'status'];


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

    public static function saveComments($data,$dataProcessType=GlobalsConst::DATA_SAVE){
//        $vRules = Comment::$rules;
//        if($dataProcessType==GlobalsConst::DATA_SAVE){
//            $comment = new Comment();
//        }elseif($dataProcessType==GlobalsConst::DATA_UPDATE){
//
//            $id = isset($data['comment']) ? $data['comment'] : '';
//            if($comment != ''){
//                $comment = Comment::find($comment);
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

        $comment = new Comment();

        $comment->status    = $data['comment'];
        $comment->doctor_id    = $data['doctor_id'];
        $comment->user_id      = $data['user_id'];

        $comment->save();


        $response = ['success'=>true, 'error'=> false, 'message'=> 'Comments has been saved successfully!'];
        return $response;
    }

}