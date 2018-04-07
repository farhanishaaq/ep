<?php

class QuestionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private $_question;
	public function __construct(Question $question)
    {
        $this->_question = $question;
    }

    public function index()
	{
        $questions =$this->_question->getQuestions();

        return View::make('question.questionlist',compact('questions'));
        //	dd($questions);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{


	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data =Input::get();
        $this->_question->createQuestion($data);
        return Redirect::back();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

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


	public function updateStatus(){
	    $id= Input::get('id');

	    $status= $this->_question->updateStatus($id,'declined');

	    return Redirect::back();
    }

    public function viewHistory(){
        if(Auth::check()){
            $currentId = Auth::user()->id;
        }
	    $questions = DB::table('questions')
                    ->where('doctor_id',$currentId)
                    ->paginate('8');

        return View::make('question.questionHistory',compact('questions'));

    }

    public function viewPublicHistory(){
//dd('ksfjsd');
	    $questions = DB::table('questions')
            ->leftjoin('answers','questions.id','=','answers.question_id')
            ->where('questions.patient_id',Auth::user()->id)
//                    ->paginate('8');
            ->get();
        return View::make('question.questionPublicHistory',compact('questions'));

    }

}
