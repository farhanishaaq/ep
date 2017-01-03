<?php

use App\Globals\GlobalsConst;
use \App\Globals\Ep;
use Illuminate\Database\Eloquent\Model;
use User;                   //based on name, email, cel number
use MedicalSpecialty;       // based on medical speciality
use Qualification;          //based on qualification
use Doctor;                 // based on doctor fees
use Company;                //based on hospital name
use City;                   //based on city name
use State;                  //based on state name
use Country;                //based on country name

class AdvanceSearch extends \Eloquent {

    public static function fetchDoctorsData(){

    }

}