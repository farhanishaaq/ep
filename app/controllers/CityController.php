<?php
use App\Globals\Ep;
use App\Globals\GlobalsConst;

class CityController extends \BaseController {


    private $_city;

    public function __construct(City $city)
    {
        $this->_city = $city;

    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	public function showCities()
	{
        $cities =$this->_city->citiesForSelect();
        return View::make('doctors.doctors_get_list',compact('cities'));
	}



}
