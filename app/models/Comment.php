<?php


class Comment extends \Eloquent
{
    protected $fillable = ['patient_id', 'doctor_id', 'comments'];

    public static function fetechDoctorComments($id){

//             $users = Comment::all();
        $users = Comment::where('doctor_id', '=', $id)->get();

        return  $users;
}
}
