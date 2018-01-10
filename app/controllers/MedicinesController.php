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
		$medicine = null;
		return View::make('medicines.create')->nest('_form','medicines.partials._form', compact('formMode', 'medicine'));

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
		return View::make('medicines.show')->nest('_view','medicines.partials._view', compact('medicine'));
	}

	/**
	 * Show the form for editing the specified medicine.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$formMode = GlobalsConst::FORM_EDIT;
		$medicine = Medicine::find($id);
		return View::make('medicines.edit')->nest('_form','medicines.partials._form',compact('formMode','medicine'));

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
		$data = Input::all();
		$validator = Validator::make($data , Medicine::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$medicine->update($data);

		$response = ['success'=>true, 'error'=> false, 'message'=> 'Medicine has been Update successfully!'];
		return $response;
	}

    public function medicineSearch(){

        return View::make('medicines.medicineSearch');
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
