<?php

class ClinicController extends \BaseController {
    /**
     * @var Clinic
     */
    private $clinic;

    /**
     * ClinicController constructor.
     * @param Clinic $clinic
     */
    public function __construct(Clinic $clinic)
    {

        $this->clinic = $clinic;
    }

    /**
	 * Display a listing of the resource.
	 * GET /clinic
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /clinic/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /clinic
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /clinic/{id}
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
	 * GET /clinic/{id}/edit
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
	 * PUT /clinic/{id}
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
	 * DELETE /clinic/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getClinicForSelector(){

	    $data=$this->clinic->getClinicForSelector(Input::all());
	    return $data;

    }

}