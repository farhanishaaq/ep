<?php
use App\Globals\GlobalsConst;
use App\Globals\Ep;

class AuthController extends \BaseController {

    private $_user;
    public function __construct(User $user)
    {
        $this->_user = $user;
    }

	public function showLogin()
	{
		return View::make('auth.login');
	}
	public function showSignUp()
	{
		return View::make('auth.signUp');
	}



	public function doSignUp()
	{
        $data = Input::all();
        $massage = $this->_user->savePublicUser($data);
        if($massage == "Success"){
            return View::make('auth.login');
        }
        else
           echo "Error In Sign Up";
	}

    public function doLogin()
	{
		$auth = false;
		$email = Input::get('email');
		$password = Input::get('password');
		$rememberMe = Input::get('remember_me');
		$rememberMe == ($rememberMe == null ? false : true);

		if (Auth::attempt(array('email' => $email, 'password' => $password), $rememberMe))
		{
			$auth = true;
		}elseif (Auth::attempt(array('username' => $email, 'password' => $password), true)){
			$auth = true;
		}

		if ($auth == true)
		{
			/*if(Auth::user()->status == 'Active' && Auth::user()->role == 'Doctor' && Auth::user()->company->admin->status == 'Active'){
                 return Redirect::to('doctorHome');
            }else if(Auth::user()->status == 'Active' && Auth::user()->role == 'Administrator'){
                return Redirect::to('adminHome');
            }
            else if(Auth::user()->status == 'Active' && Auth::user()->role == 'Receptionist' && Auth::user()->company->admin->status == 'Active'){
                return Redirect::to('receptionistHome');
            }
            else if(Auth::user()->status == 'Active' && Auth::user()->role == 'Lab Manager' && Auth::user()->company->admin->status == 'Active'){
                return Redirect::to('labManagerHome');
            }
            else if(Auth::user()->status == 'Active' && Auth::user()->role == 'Accountant' && Auth::user()->company->admin->status == 'Active'){
                return Redirect::to('accountantHome');
            }
            else if(Auth::user()->status == 'Active' && Auth::user()->role == 'Super User'){
                return Redirect::to('superHome');
            }else{
                Auth::logout();
                return Redirect::to('login')->withErrors('You are not Activated!');
            }*/
			if(Auth::user()->status == 'Active' ){
				return Redirect::route('showDashboard');
			}else{
				return Redirect::to('login')->withErrors('You are not Activated!');
			}
		}else{
			$validator = Validator::make(Input::all(), array('email' => 'exists:users', 'password' => 'exists:users'));
			if ($validator->fails())
			{
				return Redirect::to('login')->withErrors($validator);
			}
		}

	}

	public function logout(){
		Auth::logout();
		return Redirect::route('login');
//        \Illuminate\Support\Facades\Session::flush();
	}

	public function unauthorized(){
		return View::make('auth.unauthorized');
	}
}