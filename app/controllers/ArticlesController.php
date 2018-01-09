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

        $articles=Article::editarticle($id);

        return View::make('articles.articleupdate', compact('articles'));
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
        $data['likeData'] = $_POST['like_data'];
        $data['articleId'] = $_POST['article_id'];
        $data['patientId'] = $_POST['patient_id'];

        $likes = $this->_article->getLikesRecord($data);
//        dd($likes);
        if($likes == "1") {
            $result = $this->_article->deleteRecord($data);
            $decrementResult = $this->_article->decrementLike($data);
        }
        else {
            $result = $this->_article->addRecordLog($data);
            $result = $this->_article->addRecordLikes($data);
            $incrementResult = $this->_article->IncrementLike($data);
        }
        $newLikes = $this->_article->newLikes($data);

        return json_encode($newLikes);
    }

    public function articleList()
    {
//       $data['userId'] = Auth::patient()->id;
//        $status = $this->_article->getLikes($data);
        if(Auth::check()){
            if(Auth::user()->id) {
                $data['patientId'] = Auth::user()->id;
                $likes = $this->_article->getLikesForList($data);
                if($likes == "1")
                    $articles['status'] = "ON";
                else
                    $articles['status'] = "OFF";
            }
        }

//        dd($likes);
        $articles = $this->_article->getArticles();
//        dd($articles);
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
        public function replace(){

            $data = Input::all();


            $response = null;
            if (Input::hasFile('image')) {
                $file = Input::file('image');

                $type = $file->getMimeType();
                $size = $file->getSize();


                $supportedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg'];
                if ($size > 6000){
                    if (in_array($type, $supportedTypes)){




                        $this->_article->restore($data);
                        $articleid = $data['id'];


                        $destinationPath = public_path(GlobalsConst::ARTICLE_PHOTO_DIR)."/".$articleid;
                        $filename = str_random(16) . '_' . $file->getClientOriginalName();
                        $response = ['success' => true, 'uploaded' => $filename, 'message' => 'Photo has been uploaded successfully!'];
                        $uploadSuccess = $file->move($destinationPath, $filename);


                        $this->_image->updateImage($filename, $articleid, $destinationPath);
                        $this->_article->bannerupdate($filename,$data);
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



}