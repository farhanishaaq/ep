<?php

class ArticlesController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $_article;

    public function __construct(Article $article)
    {
        $this->_article = $article;
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
        $data = Input::all();
//        dd($data);
        $response = null;
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destinationPath = public_path(GlobalsConst::ARTICLE_PHOTO_DIR);
            $filename = str_random(16) . '_' . $file->getClientOriginalName();

            $uploadSuccess = $file->move($destinationPath, $filename);

//			$response = ['success'=>true,'error'=>false,'message'=>'Photo has been uploaded successfully!','uploadedFileName'=>$filename,'abc'=>$uploadSuccess];
            $response = ['success' => true, 'uploaded' => $filename, 'message' => 'Photo has been uploaded successfully!'];

        } else {
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
            $response = ['success' => false, 'error' => 'No files were processed.'];
        }
//        return Response::json($response);


        return $this->_article->saveArticle($data);


    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function likeManage()
    {
//        $data['likeAction'] = $_POST['like_action'];
        $data['likeId'] = $_POST['like_id'];
        dd($data);
        $result = $this->_article->countLikes($data);
    }


    public function articleList()
    {
        $articles = $this->_article->getArticles();
        return View::make('articles.index', compact('articles'));
    }

        public function healthatricle()
        {

            return View::make('articles.article01');

        }



}