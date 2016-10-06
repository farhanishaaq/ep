<?php

use App\Globals\GlobalsConst;

class MedicinesController extends \BaseController {

	/**
	 * Display a listing of medicines
	 *
	 * @return Response
	 */
	public function index()
	{
		$medicines = Medicine::paginate(20);
		return View::make('medicines.index')->nest('_list','medicines.partials._list', compact('medicines'));

	}

	/**
	 * Show the form for creating a new medicine
	 *
	 * @return Response
	 */
	public function create()
	{
		$formMode = GlobalsConst::FORM_CREATE;

		return View::make('medicines.create')->nest('_form','medicines.partials._form', compact('formMode'));

	}

	/**
	 * Store a newly created medicine in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();

		$response = Medicine::saveMedicine($data);

		return $response;
		//return Redirect::route('medicines.index');
	}

	/**
	 * Display the specified medicine.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$medicine = Medicine::findOrFail($id);

		return View::make('medicines.show', compact('medicine'));
	}

	/**
	 * Show the form for editing the specified medicine.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$medicine = Medicine::find($id);

		return View::make('medicines.edit', compact('medicine'));
	}

	/**
	 * Update the specified medicine in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$medicine = Medicine::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Medicine::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$medicine->update($data);

		return Redirect::route('medicines.index');
	}

	/**
	 * Remove the specified medicine from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Medicine::destroy($id);

		return Redirect::route('medicines.index');
	}

}
