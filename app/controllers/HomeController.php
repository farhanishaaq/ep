<?php

use \App\Globals\GlobalsConst;

class HomeController extends BaseController {

	public function index()
	{
//		echo Route::getCurrentRoute()->getPrefix();die('KKKK');
        return View::make('home.index');
	}

	public function showAbout()
	{
		return View::make('home.about');
	}
	public function showServices()
	{
		return View::make('home.services');
	}

	public function showContacts()
	{
		return View::make('home.contacts');
	}

	public function showDoctorHome()
	{
		$appointments = Auth::user()->appointments()->where('date', date('Y-m-d'))->get();
		return View::make('home.doctor_home', compact('appointments'));
	}

    /**
     * @param $companyName
     * @param $companyId
     * @return \Illuminate\Contracts\View\View
     */
    public function showCompanyHomePage($companyDomain)
    {
        $object = 'Company';
        $errorView = View::make('errors.notFound', compact('object'));

        $Company = Company::where('domain','=',$companyDomain)->first();
        if($Company){
            if($Company->count() > GlobalsConst::ZERO_INDEX){
                $doctors = Doctor::fetchDoctorsByCompanyId($companyDomain);
                return View::make('home.companyHomePage', compact('Company','doctors'));
            }else{
                return $errorView;
            }
        }else{
            return $errorView;
        }
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function fetchDoctorDutyAndFeeInfo()
    {
        $doctorId = Input::get('doctorId', null);
        if($doctorId){
            $DoctorDutyAndFeeInfos = Doctor::fetchDoctorDutyAndFeeInfoByDoctorId($doctorId);
            return View::make('home.partials._doctorInfo', compact('DoctorDutyAndFeeInfos'));
        }else{
            return 'error';
        }
    }

    public function sendContactUsMail(){
        $data = [
            'text' => Input::get('message'),
            'phone' => Input::get('phone'),
            'name' => Input::get('name'),
            'email' => Input::get('email')
            ];
        //***Send email to employee
        $superAdmin = Employee::where('user_id', SUPER_ADMIN_ID)->first();
        Mail::queue('emails.contact_message', $data, function($message) use($superAdmin)
        {
            $message->to($superAdmin->user->email, $superAdmin->name)->subject('EMR Contact Message!');
        });

        return 'You message has been received. We will contact you back soon!';
    }
}
