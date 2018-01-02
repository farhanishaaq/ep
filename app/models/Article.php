<?php

class Article extends \Eloquent
{
    protected $fillable = ['patient_id', 'doctor_id', 'article_text'];

    public function user()
    {
        $this->belongsTo('User');

    }

    public function question()
    {

        $this->hasMany('Question');
    }


    public function saveArticle($data)
    {

        $doctor_id = Auth::user()->id;

        $text = $data['body'];
        $title = $data['title'];
        $this->doctor_id = $doctor_id;
        $this->article_text = $text;
        $this->title = $title;
        $this->save();
        return 'sucess';
    }


    public function getArticles()
    {

        try {
            $queryBuilder = DB::table('articles')
                ->leftJoin('like_logs', 'articles.id', '=', 'like_logs.article_id')
                ->select('like_logs.id As likeId', 'articles.id AS articleId', 'like_count')
                ->get();
            return $queryBuilder;
        } catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd("exeption");
            dd($e->getMessage());
        }

    }

    public function getLikes($params)
    {
        $queryBuilder = DB::table('like_logs')
            ->where('id', '=', $params['likeId'])
            ->select('like_count');
        return $queryBuilder;
    }

    public function countLikes($params)
    {
        //Save like when hit!


        $queryBuilder = DB::table('like_logs')
            ->where('id', '=', $params['likeId'])
            ->update(array('like_count' => $params['likeData']));
        return "update";

    }

}