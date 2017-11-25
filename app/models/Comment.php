<?php


class Comment extends \Eloquent
{
    protected $fillable = ['patient_id', 'doctor_id', 'comments'];

    public static function fetechDoctorComments($id){
        $users = Comment::where('doctor_id', '=', $id)->get();
        return  json_encode($users)  ;
}

    public function saveComment ($data){
        $dr_id=$data['id'];
        $user_id=$data['user_id'];
        $content = $data['comment'];


        $this->doctor_id =$dr_id;
        $this->patient_id =$user_id;
        $this->comments = $content;
        $this->save();
        return 'sucess';
    }

}
