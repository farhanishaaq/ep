<?php

class Article extends \Eloquent {
    protected $fillable = ['patient_id','doctor_id','article_text','title', 'bannar_image'];

    public function image(){
    return $this->hasMany("Image");

}

public function user(){

   return $this->belongsTo("User");
}

    public function question()
    {

        $this->hasMany('Question');
    }

    public function saveArticle ($data){

    $doctor_id = Auth::user()->id;

        $text=$data['body'];
        $title = $data['title'];
        $this->doctor_id = $doctor_id;
        $this->article_text = $text;
        $this->title = $title;
        $this->save();
        return 'sucess';
    }

    public function bannerpath($filename){

        $this->bannar_image = $filename;
        $this->save();
        return 'sucess';

    }

    public function getArticles(){

        try{
            $queryBuilder = DB::table('articles')
                ->leftJoin('likes','articles.id','=','likes.article_id')
                ->leftJoin('like_logs','articles.id','=','like_logs.patient_id')
                ->leftJoin('doctors','articles.doctor_id','=','doctors.id')
                ->leftJoin('users','doctors.user_id','=','users.id')
                ->select('articles.created_at AS articleCreate','like_logs.patient_id AS patientId','articles.id AS articleId','title','article_text','bannar_image','article_likes','full_name')
                ->orderBy('articleCreate', 'desc')->groupBy('articleId')->paginate(5);
            return $queryBuilder;
        }

        catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd("exeption");
            dd($e->getMessage());
        }

    }

    public function getLikesRecord($params)
    {
//      Getting Data for Check that Specific record has like record on this article or not
        $queryBuilder = DB::table('like_logs')
            ->where('article_id', '=', $params['articleId'])
            ->where('patient_id', '=', $params['patientId'])
            ->count();
        return $queryBuilder;
    }

    public function getLikesForList($params)
    {
//      Getting Data for Check that Specific record has like record on this article or not
        $queryBuilder = DB::table('like_logs')
        ->where('patient_id', '=', $params['patientId'])
            ->count();
        return $queryBuilder;
    }

    public function deleteRecord($params)
    {
//        Delete Record if specific user hit unlike
        $queryBuilder = DB::table('like_logs')
            ->where('article_id', '=', $params['articleId'])
            ->where('patient_id', '=', $params['patientId'])
            ->delete();

        return "Deleted";
    }

    public function decrementLike($params)
    {
//        Decrement Record if specific user hit unlike
            $queryBuilder = DB::table('likes')
            ->where('article_id', '=', $params['articleId'])
            ->decrement('article_likes',1);

        return "Decremented";
    }

    public function addRecordLog($params)
    {
//        Insert Record when user hit like
        $queryBuilder = DB::table('like_logs')
            ->insert(['article_id' => $params['articleId'], 'patient_id' => $params['patientId']]
            );
        return "inserted";
    }

    public function addRecordLikes($params)
    {
//        Insert Record when user hit like
        $queryBuilder = DB::table('likes')
            ->insert(['article_id' => $params['articleId'], 'article_likes' => "0"]
            );
        return "inserted";
    }

    public function IncrementLike($params)
    {
//        Increment Record when user hit like
        $queryBuilder = DB::table('likes')
            ->where('article_id', '=', $params['articleId'])
            ->increment('article_likes',1);
        return "incremented";
    }

    public function newLikes($params)
    {
//        Decrement Record if specific user hit unlike
        $queryBuilder = DB::table('likes')
            ->where('article_id', '=', $params['articleId'])
            ->select('article_likes')
            ->get();

        return $queryBuilder ;
    }

//    public function countLikes($params,$likes)
//    {
//        //Save like when hit!
//        $queryBuilder = DB::table('like_logs')
//            ->where('id', '=', $params['likeId'])
////            ->$likes('like_count');
//            ->update(array('like_count' => $likes));
//        return "update";
//
//    }


//    public function countLikes($params){





//        $comment = DB::table('likes_logs')
//            ->where('id','=',$params['commentId']);
//        if($params['commentAction']=='checked'){
//            $comment->update(array('status'=>'Approved'));
//            return "Approved";
//        }
//        else{
//            $comment->update(array('status'=>'Request'));
//            return "Request";
//        }
//    }


 public function displayarticle($id){


     $articles =  DB::table('articles')->where('id', $id)
         ->where('status',1)
         ->first();

     //dd($articles);
     if($articles!= NULL){

         return $articles;

     }
     elseif (Auth::check()){
        if (Auth::user()->user_type == 'Admin'){
            $articles =  DB::table('articles')->where('id', $id)
                ->first();
            if($articles != NULL){


                return $articles;
            }
        }


     }



 }

 public function articlestatus(){

     $articlestatus = DB::table('articles')->paginate(7);


    return $articlestatus;

 }
 public function articlesupdate($data){

     $status=$data['article_action'];
     $article_id = $data['id'];

     DB::table('articles')
         ->where('id', $article_id)
         ->update(array('status' => $status));

     $this->update();



 }

public function editarticle($id){

    $articles =  DB::table('articles')->where('id', $id)
        ->first();


    return $articles ;
}

public function restore($data){


    $doctor_id = Auth::user()->id;
    $id = $data['id'];
    $text=$data['body'];
    $title = $data['title'];


    DB::table('articles')
        ->where('id', $id)
        ->update(array('doctor_id' => $doctor_id, 'article_text' => $text, 'title' => $title));

    $this->update();
    return 'sucess';


}

    public function bannerupdate($filename,$data){

          $id = $data['id'];

        DB::table('articles')
            ->where('id', $id)
            ->update(array('bannar_image' => $filename));

        $this->update();

        return 'sucess';

    }

     public function deletearticle($id){

         DB::table('articles')->where('id', $id)->delete();


         return 'sucess';

     }



}