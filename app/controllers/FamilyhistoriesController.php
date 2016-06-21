<?php

class FamilyHistoriesController extends \BaseController {

	/**
	 * Display a listing of family_histories
	 *
	 * @return Response
	 */
	public function index()
	{
        $patient_id = Input::get('id');
        $patient = Patient::find($patient_id);
        $familyHistories = $patient->familyHistories()->paginate(10);

		return View::make('family_histories.index', compact('patient', 'familyHistories'));
	}

	/**
	 * Show the form for creating a new familyhistory
	 *
	 * @return Response
	 */
	public function create()
	{
        $patient_id = Input::get('id');
		return View::make('family_histories.create', compact('patient_id'));
	}

	/**
	 * Store a newly created familyhistory in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$data = Input::all();
        $validator = Validator::make($data, array('f_member_name' => 'required', 'patient_relation' => 'required', 'gender' => 'required', 'age' => 'required'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        $data['company_id'] = Auth::user()->company_id;

		FamilyHistory::create($data);

		return Redirect::to('familyHistories?id='.$data['patient_id']);
	}

	/**
	 * Display the specified familyhistory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$familyhistory = FamilyHistory::findOrFail($id);

		return View::make('family_histories.show', compact('familyhistory'));
	}

	/**
	 * Show the form for editing the specified familyhistory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$familyhistory = FamilyHistory::find($id);

		return View::make('family_histories.edit', compact('familyhistory'));
	}

	/**
	 * Update the specified familyhistory in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$familyhistory = FamilyHistory::findOrFail($id);

		$data = Input::all();
        $validator = Validator::make($data, array('f_member_name' => 'required', 'patient_relation' => 'required', 'gender' => 'required', 'age' => 'required'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$data['patient_id'] = $familyhistory->patient_id;

		$familyhistory->update($data);

		return Redirect::to('familyHistories?id='.$familyhistory->patient_id);
	}

	/**
	 * Remove the specified familyhistory from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		FamilyHistory::destroy($id);

		return Redirect::route('familyHistories.index');
	}

}
