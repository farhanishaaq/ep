<?php

class ArticlesController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $_article;
    private $_image;

    public function __construct(Article $article, Image $image)
    {
        $this->_article = $article;
        $this->_image = $image;
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

//       $id = $data['image']->id;
//       dd($id);


        $response = null;
        if (Input::hasFile('image')) {
            $file = Input::file('image');

            $type = $file->getMimeType();
            $size = $file->getSize();


            $supportedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg'];
            if ($size > 6000){
            if (in_array($type, $supportedTypes)){




                $this->_article->saveArticle($data);
               $articleid = $this->_article->id;

                $destinationPath = public_path(GlobalsConst::ARTICLE_PHOTO_DIR)."/".$articleid;
                $filename = str_random(16) . '_' . $file->getClientOriginalName();
                $response = ['success' => true, 'uploaded' => $filename, 'message' => 'Photo has been uploaded successfully!'];
                $uploadSuccess = $file->move($destinationPath, $filename);


            $this->_image->saveImage ($destinationPath,$filename, $articleid, $destinationPath);
               $this->_article->bannerpath($filename);
//                return View::make('doctors.articlesEditer', compact('response'));

            }
            else{
                $response = ['success' => false, 'error' => 'No files were processed.'] ;


                return View::make('doctors.articlesEditer', compact('response'));


            }

        }
        else{

            $response = ['success' => false, 'error' => 'No files were processed.'] ;


            return View::make('doctors.articlesEditer', compact('response'));

        }

        }

        else {
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
            $response = ['success' => false, 'error' => 'No files were processed.'];
        }
//        return Response::json($response);


        return Redirect::back();

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

        $articles=Article::displayarticle($id);
if ($articles != NULL){


    return View::make ("articles.article", compact('articles'));

}    else {

    return View::make('auth.unauthorized');
}







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
        $data['likeId'] = $_POST['like_id'];
        $data['likeData'] = $_POST['like_data'];
//        $likes = $this->_article->getLikes($data);

        $result = $this->_article->countLikes($data);
        return $result;
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

        public function status(){

            $articlestatus = Article::articlestatus();


            return View::make('articles.articlestatus', compact('articlestatus'));
        }

        public function statusupdate(){

            $data = Input::all();

            $this->_article->articlesupdate($data);



        }



}