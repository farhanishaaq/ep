<?php

class SurgicalHistoriesController extends \BaseController {

	/**
	 * Display a listing of surgical_histories
	 *
	 * @return Response
	 */
	public function index()
	{
		$patient_id = Input::get('id');
        $patient = Patient::find($patient_id);
        $surgicalhistories = $patient->surgicalhistories()->paginate(10);

		return View::make('surgical_histories.index', compact('patient', 'surgicalhistories'));
	}

	/**
	 * Show the form for creating a new surgicalhistory
	 *
	 * @return Response
	 */
	public function create()
	{
		$patient_id = Input::get('id');
		return View::make('surgical_histories.create', compact('patient_id'));
	}

	/**
	 * Store a newly created surgicalhistory in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), array('surgery_name' => 'required', 'surgery_date' => 'date|required'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $data['company_id'] = Auth::user()->company_id;
		SurgicalHistory::create($data);

		return Redirect::to('surgical_histories?id='.$data['patient_id']);
	}

	/**
	 * Display the specified surgicalhistory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$surgicalhistory = SurgicalHistory::findOrFail($id);

		return View::make('surgical_histories.show', compact('surgicalhistory'));
	}

	/**
	 * Show the form for editing the specified surgicalhistory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$surgicalhistory = SurgicalHistory::find($id);

		return View::make('surgical_histories.edit', compact('surgicalhistory'));
	}

	/**
	 * Update the specified surgicalhistory in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$surgicalhistory = SurgicalHistory::findOrFail($id);

		$validator = Validator::make($data = Input::all(), array('surgery_name' => 'required', 'surgery_date' => 'date|required'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$data['patient_id'] = $surgicalhistory->patient_id;

		$surgicalhistory->update($data);

		return Redirect::to('surgical_histories?id='.$surgicalhistory->patient_id);
	}

	/**
	 * Remove the specified surgicalhistory from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		SurgicalHistory::destroy($id);

		return Redirect::route('surgical_histories.index');
	}

}
