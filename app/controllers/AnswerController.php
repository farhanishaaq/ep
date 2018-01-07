<?php

class AnswerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private $_question;
	private $_answer;
	public function __construct(Answer $answer,Question $question)
    {
        $this->_question= $question;
        $this->_answer= $answer;
    }

    public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create()
    {
        $questionId= Input::get('questionId');
        $question=$this->_question->getQuestionById($questionId)->question;
        return View::make('answer.answer')->with(compact('questionId','question'));
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return \Illuminate\Http\RedirectResponse
     */
	public function store()
	{

	    if(strlen(Input::get('answer'))>5){

             $this->_answer->saveAnswer(Input::all());
             $this->_question->updateStatus(Input::get('questionId'),'replied');
             return Redirect::route('question.index');
	    } else {
            return Redirect::route('question.index');
        }

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


}
