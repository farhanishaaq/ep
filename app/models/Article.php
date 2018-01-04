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
                ->leftJoin('like_logs','articles.id','=','like_logs.article_id')
                ->leftJoin('likes','articles.id','=','likes.article_id')
                ->select('articles.patient_id AS patientId','like_logs.id As likeId','articles.id AS articleId','title','article_text','bannar_image','article_likes')
                ->paginate(5);
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

    public function getLikes($params)
    {
//      Getting Data for Check that Specific record has like record on this article or not
        $queryBuilder = DB::table('like_logs')
            ->where('article_id', '=', $params['articleId'])
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

    public function addRecord($params)
    {
//        Insert Record when user hit like
        $queryBuilder = DB::table('like_logs')
            ->insert(['article_id' => $params['articleId'], 'patient_id' => $params['patientId']]
            );
        return "inserted";
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


}