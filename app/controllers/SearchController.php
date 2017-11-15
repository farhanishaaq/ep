<?php

class SearchController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    private $_city;
    private $_user;
	public function __construct(City $city,User $user)
    {
        $this->_city=$city;
        $this->_user=$user;
    }

    public function index()
	{
		//
        $cities = $this->_city->citiesForSelect();

        return View::make('doctor_search.search',compact('cities'));
	}
	public function getDoctorNamesForSelector(){

	    if (Request::ajax()){

            $users = $this ->_user->getDoctorByNameForSelector('o');
        //    dd($users);
            return $users;
        }

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
		//
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

	public function getSelectData(){


    }

}
