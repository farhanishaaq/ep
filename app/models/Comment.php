<?php


class Comment extends \Eloquent
{
    protected $fillable = ['user_id', 'doctor_id', 'comments'];

    public static function fetechDoctorComments($data)
    {
        $users = Comment::where('target_id', '=', $data['id'])
            ->leftJoin('users','comments.user_id','=', 'users.id')
            ->where("type",$data['type'])
            ->where('comments.status', 'Approved')
            ->get();
        return json_encode($users);
    }

    public function saveComment($data)
    {

        $this->target_id = $data['target_Id'];
        $this->user_id = Auth::user()->id;
        $this->comments = $data['comment'];
        $this->type = $data['type'];
        $this->save();
        return 'sucess';
    }

    public function commentsList()
    {
        /*
         * For Approve of Decline Comments on Doctor Profile By Admin
         */
        try {
            $queryBuilder = DB::table('comments')
            ->select('id AS commentId', 'user_id','target_id' ,'type', 'comments', 'status', 'created_at')
//            if($params['condition'] == "Approved")
            ->where('status', '!=', 'Approved')
            ->paginate(5);


            return $queryBuilder;
        } catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd("exeption");
            dd($e->getMessage());
        }

    }

    public function commentApproved($params)
    {
        $comment = DB::table('comments')
            ->where('id', '=', $params['commentId']);
        if ($params['commentAction'] == 'checked') {
            $comment->update(array('status' => 'Approved'));
            return "Approved";
        } else {
            $comment->update(array('status' => 'Request'));
            return "Request";
        }
    }
    public function allComments(){

        try {
            $queryBuilder = DB::table('comments')
                ->select('id AS commentId', 'user_id', 'type','target_id', 'comments', 'status', 'created_at')
                ->paginate(7);
            return $queryBuilder;
        } catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd("exeption");
            dd($e->getMessage());
        }

    }

}
