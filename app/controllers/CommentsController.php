<?php
use App\Globals\GlobalsConst;
use Illuminate\Http\Request;



class CommentsController extends \BaseController {

    private $_comment;

    public function __construct(Comment $comment)
     {
         $this->_comment= $comment;
     }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
    {
        $data = $this->_comment->commentsList();
        return View::make('comments.index',compact('data'));
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
        $data = Input::all();
        return $this->_comment->saveComment($data);

	}



	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
        $data = Input::all();

        return Comment::fetechDoctorComments($data['id']);


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


}
