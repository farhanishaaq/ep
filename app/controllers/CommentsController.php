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
        $action['condition'] = "Request";
        $data = $this->_comment->commentsList();
//        dd($action);
//        dd($data);
        return View::make('comments.index',compact('action','data'));
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

        return Comment::fetechDoctorComments($data);


	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showHistory()
	{
        $action['condition'] = "All";
        $data = $this->_comment->allComments();
        return View::make('comments.index',compact('data','action'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateCommentStatus()
	{
        $data['commentAction'] = $_POST['comment_action'];
        $data['commentId'] =$_POST['comment_id'];

        $result = $this->_comment->commentApproved($data);
        if ($result == "Approved") {
            echo "Comment Approved";
        } else {
            echo "Comment Not Approved";
        }
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
