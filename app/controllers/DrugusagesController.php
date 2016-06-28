<?php

class DrugUsagesController extends \BaseController {

	/**
	 * Display a listing of drug_usages
	 *
	 * @return Response
	 */
	public function index()
	{
		$patient_id = Input::get('id');
        $patient = Patient::find($patient_id);
        $drugUsages = $patient->drugUsages()->paginate(1);
		return View::make('drug_usages.index', compact('patient', 'drugUsages'));
	}

	/**
	 * Show the form for creating a new drugusage
	 *
	 * @return Response
	 */
	public function create()
	{
		$patient_id = Input::get('id');
		return View::make('drug_usages.create', compact('patient_id'));
	}

	/**
	 * Store a newly created drugusage in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), array('drug_name' => 'required'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $data['company_id'] = Auth::user()->company_id;
		DrugUsage::create($data);

		return Redirect::to('drug_usages?id='.$data['patient_id']);
	}

	/**
	 * Display the specified drugusage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$drugusage = DrugUsage::findOrFail($id);

		return View::make('drug_usages.show', compact('drugusage'));
	}

	/**
	 * Show the form for editing the specified drugusage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$drugusage = DrugUsage::find($id);

		return View::make('drug_usages.edit', compact('drugusage'));
	}

	/**
	 * Update the specified drugusage in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$drugusage = DrugUsage::findOrFail($id);

		$validator = Validator::make($data = Input::all(), array('drug_name' => 'required'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$data['patient_id'] = $drugusage->patient_id;

		$drugusage->update($data);

		return Redirect::to('drug_usages?id='.$drugusage->patient_id);
	}

	/**
	 * Remove the specified drugusage from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		DrugUsage::destroy($id);

		return Redirect::route('drug_usages.index');
	}

}
