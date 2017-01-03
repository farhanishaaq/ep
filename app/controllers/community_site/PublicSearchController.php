<?php

namespace App\Controllers\CommunitySite;
use \Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use \View;

class PublicSearchController extends \BaseController {

    public function index()
    {
        return View::make('community_site.publicsearch.index');
    }

    public function fetchDoctorsSpecialties()
    {
        $doctors_specialties_list = \MedicalSpecialty::all();

        return View::make('community_site.publicsearch.fetchDoctorsSpecialties', compact('doctors_specialties_list'));
    }

    public function fetchTopDoctors()
    {
        $doctors_list =\DB::table('doctors')
            ->join('doctor_medical_specialty', 'doctor_medical_specialty.doctor_id', '=', 'doctors.id')
            ->join('medical_specialties', 'medical_specialties.id', '=', 'doctor_medical_specialty.medical_specialty_id')
            ->join('users', 'users.id', '=', 'doctors.user_id')
            ->leftJoin('duty_days', 'duty_days.doctor_id', '=', 'doctors.id')
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->join('cities', 'cities.id', '=', 'users.city_id')
//            ->join('comments', 'comments.user_id', '=', 'users.id')
            ->orderBy('doctors.current_rating', 'DESC')
            ->select('medical_specialties.name','doctors.user_id','doctors.id','doctors.max_fee','doctors.min_fee','doctors.current_rating','users.full_name', 'users.gender', 'users.address', 'users.photo', 'duty_days.day', 'duty_days.start', 'duty_days.end')
            ->get();
        return View::make('community_site.publicsearch.fetchTopDoctors', compact('doctors_list'));
    }

    public function searchAllDoctors() {

        $data = Input::get("search");
        $doctors_info =$this->SearchingDoctorsInformation($data);
        return View::make('community_site.publicsearch.fetchDoctors',compact('doctors_info'));
    }

    public function fetchDoctorDetails($id)
    {
        $doctors_list =\DB::table('doctors')
            ->join('doctor_medical_specialty', 'doctor_medical_specialty.doctor_id', '=', 'doctors.id')
            ->join('medical_specialties', 'medical_specialties.id', '=', 'doctor_medical_specialty.medical_specialty_id')
            ->join('users', 'users.id', '=', 'doctors.user_id')
            ->leftJoin('duty_days', 'duty_days.doctor_id', '=', 'doctors.id')
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->join('cities', 'cities.id', '=', 'users.city_id')
//            ->join('comments', 'comments.user_id', '=', 'users.id')
            ->Where('doctors.id', 'LIKE', "%$id%")
            ->orderBy('doctors.current_rating', 'DESC')
            ->select('medical_specialties.name','doctors.user_id','doctors.id','doctors.max_fee','doctors.min_fee','doctors.current_rating','users.full_name', 'users.gender', 'users.address', 'users.photo', 'duty_days.day', 'duty_days.start', 'duty_days.end')
            ->get();

        $doctors_comments =\DB::table('doctors')
            ->join('users', 'users.id', '=', 'doctors.user_id')
            ->join('comments', 'comments.user_id', '=', 'users.id')
            ->Where('doctors.id', 'LIKE', "%$id%")
            ->select('comments.status', 'users.full_name', 'users.photo')
            ->get();

        $doctors_duty_days =\DB::table('doctors')
            ->join('users', 'users.id', '=', 'doctors.user_id')
            ->join('duty_days', 'duty_days.doctor_id', '=', 'doctors.id')
            ->join('time_slots', 'time_slots.doctor_id', '=', 'doctors.id')
            ->Where('doctors.id', 'LIKE', "%$id%")
            ->select('duty_days.day', 'duty_days.start', 'duty_days.end', 'time_slots.slot')
            ->get();
        return View::make('community_site.publicsearch.fetchDoctorDetails', compact('doctors_list', 'doctors_comments', 'doctors_duty_days'));
    }

    public function commentOnDoctors() {


        $data = Input::all();
//        dd($data);
        $response = \Comment::saveComments($data);
        $doctors_list =$this->fetchTopDoctors();
        return View::make('community_site.publicsearch.fetchDoctorDetails', compact('doctors_list', 'response'));
//        return $response;
//        return View::make('community_site.publicsearch.fetchTopDoctors');
    }

    public function fetchDoctors($name)
    {
        $data = $name;
        $doctors_info =$this->SearchingDoctorsInformation($data);
        return View::make('community_site.publicsearch.fetchDoctors', compact('doctors_info'));
    }

    public function searchDoctors() {

        $data = Input::get("search");
        $doctors_info =$this->SearchingDoctorsInformation($data);
        return View::make('community_site.publicsearch.fetchDoctors',compact('doctors_info'));
    }

    public function SearchingDoctorsInformation($data)  {

    return    $doctors_info =\DB::table('doctors')
            ->join('users', 'users.id', '=', 'doctors.user_id')
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->join('cities', 'cities.id', '=', 'users.city_id')
    //        ->join('cities', 'cities.id', '=', 'companies.city_id')
            ->join('states', 'states.id', '=', 'cities.state_id')
            ->join('countries', 'countries.id', '=', 'states.country_id')
            ->join('doctor_medical_specialty', 'doctor_medical_specialty.doctor_id', '=', 'doctors.id')
            ->join('medical_specialties', 'medical_specialties.id', '=', 'doctor_medical_specialty.medical_specialty_id')
            ->leftJoin('duty_days', 'duty_days.doctor_id', '=', 'doctors.id')
//            ->join('doctor_qualification', 'doctor_qualification.doctor_id', '=', 'doctors.id')
//            ->join('qualifications', 'qualifications.id', '=', 'doctor_qualification.qualification_id')
            ->Where('medical_specialties.name', 'LIKE', "%$data%")
            ->orWhere('users.full_name', 'LIKE', "%$data%")
            ->orWhere('users.gender', 'LIKE', "%$data%")
            ->orWhere('cities.name', 'LIKE', "%$data%")
            ->orWhere('states.name', 'LIKE', "%$data%")
            ->orWhere('companies.name', 'LIKE', "%$data%")
            ->orWhere('doctors.max_fee', 'LIKE', "%$data%")
            ->orWhere('duty_days.day', 'LIKE', "%$data%")
            ->select('medical_specialties.name','doctors.user_id','doctors.max_fee','doctors.min_fee','users.full_name', 'users.gender', 'users.address', 'users.photo', 'duty_days.day', 'duty_days.start', 'duty_days.end')
//            ->select('medical_specialties.name','doctors.user_id','doctors.max_fee','doctors.min_fee','users.full_name', 'users.gender', 'users.address', 'users.photo', 'duty_days.day', 'duty_days.start', 'duty_days.end',\DB::raw('CONCAT(users.full_name,', ', qualifications.title,', ', medical_specialties.name) AS full_doctors_name'))
//            ->groupBy('doctor_medical_specialty.doctor_id')
            ->get();

    }

    public function giveRating() {

        $current_rating = Input::all();

       $response = \RatingLog::saveRatings($current_rating);
        $new_rating = \Doctor::saveNewRatings($current_rating);

//        return null;
        $doctors_list =$this->fetchTopDoctors();
        return Response::json($new_rating);
        return View::make('community_site.publicsearch.fetchTopDoctors', compact('doctors_list', 'response', 'response1'));

    }
}
