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
            $supportedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg'];
            if (in_array($type, $supportedTypes)){

//            $destinationPath = public_path(GlobalsConst::ARTICLE_PHOTO_DIR)."/35";
//            $filename = str_random(16) . '_' . $file->getClientOriginalName();
//
//            $uploadSuccess = $file->move($destinationPath, $filename);
//
////			$response = ['success'=>true,'error'=>false,'message'=>'Photo has been uploaded successfully!','uploadedFileName'=>$filename,'abc'=>$uploadSuccess];
//            $response = ['success' => true, 'uploaded' => $filename, 'message' => 'Photo has been uploaded successfully!'];

             $this->_article->saveArticle($data);

           $articleid = $this->_article->id;
                $destinationPath = public_path(GlobalsConst::ARTICLE_PHOTO_DIR)."/".$articleid;
                $filename = str_random(16) . '_' . $file->getClientOriginalName();
                $response = ['success' => true, 'uploaded' => $filename, 'message' => 'Photo has been uploaded successfully!'];
                $uploadSuccess = $file->move($destinationPath, $filename);


            $this->_image->saveImage ($destinationPath,$filename, $articleid);

//                return View::make('doctors.articlesEditer', compact('response'));

            }
            else{
                $response = ['success' => false, 'error' => 'No files were processed.'] ;


                return View::make('doctors.articlesEditer', compact('response'));

            }

        } else {
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
            $response = ['success' => false, 'error' => 'No files were processed.'];
        }
//        return Response::json($response);




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

        $data['likeData'] = $_POST['like_data'];
        $data['likeId'] = $_POST['like_id'];

        $likes = $this->_article->getLikes($data);
        $result = $this->_article->countLikes($likes);
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



}