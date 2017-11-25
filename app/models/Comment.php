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
        $content = $data['comment'];


        $this->doctor_id =$dr_id;
        $this->comments = $content;
        $this->save();
        return 'sucess';
    }

    public function commentsListPatient(){
    /*
     * For Approve of Decline Comments on Doctor Profile By Admin
     */
    try{
        $queryBuilder = DB::table('comments')
            ->leftJoin('patients','comments.patient_id','=','patients.id')
            ->leftJoin('users','patients.user_id','=','users.id')
            ->select('full_name AS patientName','comments','patients.id AS patientId')
            ->get();
        return $queryBuilder   ;
    }
    catch (Throwable $t) {
        // Executed only in PHP 7, will not match in PHP 5.x
        dd($t->getMessage());
    } catch (Exception $e) {
        dd("exeption");
        dd($e->getMessage());
    }

    }
    public function commentsListDoctor(){
    /*
     * For Approve of Decline Comments on Doctor Profile By Admin
     */
    try{
        $queryBuilder = DB::table('comments')
            ->leftJoin('doctors','comments.doctor_id','=','doctors.id')
            ->leftJoin('users','doctors.user_id','=','users.id')
            ->select('full_name AS doctorName','doctors.id AS doctorId')
            ->get();
        return $queryBuilder   ;
    }
    catch (Throwable $t) {
        // Executed only in PHP 7, will not match in PHP 5.x
        dd($t->getMessage());
    } catch (Exception $e) {
        dd("exeption");
        dd($e->getMessage());
    }

    }

}
