<?php

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

	public function showReceptionistHome()
	{
		return View::make('home.receptionist_home');
	}

	public function showLabManagerHome()
	{
		return View::make('home.labmanager_home');
	}

	public function showAccountantHome()
	{
		return View::make('home.accountant_home');
	}

	public function showAdminHome()
	{
		return View::make('home.admin_home');
	}

    public function showSuperHome(){
        return View::make('home.super_home');
    }

	public function showUserRegistrationForm(){

		return View::make('admin.register_user');
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
