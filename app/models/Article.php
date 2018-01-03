<?php

class Article extends \Eloquent {
	protected $fillable = ['patient_id','doctor_id','article_text','title'];

public function image(){
    return $this->hasMany("Image");


}

public function user(){

   return $this->belongsTo("User");
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






    public function getArticles(){

        try{
            $queryBuilder = DB::table('articles')
                ->leftJoin('like_logs','articles.id','=','like_logs.article_id')
                ->select('like_logs.id As likeId','articles.id AS articleId','like_count')
                ->get();
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

    public function countLikes($params){





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
    }


}