<?php

class ArticlesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    private $_article;

    public function __construct(Article $article)
    {
        $this->_article= $article;
    }


	public function index()
	{

        return View::make('doctors.articlesEditer');
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function likeManage()
    {
//        $data['likeAction'] = $_POST['like_action'];
        $data['likeId'] =$_POST['like_id'];
        dd($data);
        $result = $this->_article->countLikes($data);
        return View::make('articles.index');
    }

    public function articleList()
    {
        $articles = $this->_article->getArticles();
        return View::make('articles.index',compact('articles'));
    }

    public function healthatricle()
    {
        return View::make('articles.article01');
    }

}
