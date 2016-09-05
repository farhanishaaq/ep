<?php

class PreviousDiseasesController extends \BaseController {

	/**
	 * Display a listing of previousDiseases
	 *
	 * @return Response
	 */
	public function index()
	{
		$patient_id = Input::get('id');
        $patient = Patient::find($patient_id);
        $previousDiseases = $patient->previousDiseases()->paginate(1);

		return View::make('previous_diseases.index', compact('patient', 'previousDiseases'));
	}

	/**
	 * Show the form for creating a new previousdisease
	 *
	 * @return Response
	 */
	public function create()
	{
		$patient_id = Input::get('id');
		return View::make('previous_diseases.create', compact('patient_id'));
	}

	/**
	 * Store a newly created previousdisease in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), array('disease_name' => 'required'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $data['company_id'] = Auth::user()->company_id;
		PreviousDisease::create($data);

		return Redirect::to('previousDiseases?id='.$data['patient_id']);
	}

	/**
	 * Display the specified previousdisease.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$previousDisease = PreviousDisease::findOrFail($id);

		return View::make('previous_diseases.show', compact('previousDisease'));
	}

	/**
	 * Show the form for editing the specified previousdisease.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$previousDisease = PreviousDisease::find($id);

		return View::make('previous_diseases.edit', compact('previousDisease'));
	}

	/**
	 * Update the specified previousdisease in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$previousDisease = PreviousDisease::findOrFail($id);

		$validator = Validator::make($data = Input::all(), array('disease_name' => 'required'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		$data['patient_id'] = $previousDisease->patient_id;

		$previousDisease->update($data);

		return Redirect::to('previousDiseases?id='.$previousDisease->patient_id);
	}

	/**
	 * Remove the specified previousdisease from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PreviousDisease::destroy($id);

		return Redirect::route('previousDiseases.index');
	}

}
