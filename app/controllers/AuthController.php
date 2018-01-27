<?php
use App\Globals\GlobalsConst;
use App\Globals\Ep;

class AuthController extends \BaseController
{

    private $_user;
    private $_city;

    public function __construct(User $user, City $city)
    {
        $this->_user = $user;
        $this->_city = $city;
    }

    public function showLogin()
    {
        return View::make('auth.login');
    }

    public function showSignUp()
    {
        $cities = $this->_city->citiesForSelect();
        return View::make('auth.signUp', compact('cities'));
    }

    public function doLogin()
    {
        $auth = false;
        $email = Input::get('email');
        $password = Input::get('password');
        $rememberMe = Input::get('remember_me');
        $rememberMe == ($rememberMe == null ? false : true);

        if (Auth::attempt(array('email' => $email, 'password' => $password), $rememberMe)) {
            $auth = true;
        } elseif (Auth::attempt(array('username' => $email, 'password' => $password), true)) {
            $auth = true;
        }

        if ($auth == true) {
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
            if (Auth::user()->status == 'Active') {
                return Redirect::route('showDashboard');
            } else {
                return Redirect::to('login')->withErrors('You are not Activated!');
            }
        } else {
            $validator = Validator::make(Input::all(), array('email' => 'exists:users', 'password' => 'exists:users'));
            if ($validator->fails()) {
                return Redirect::to('login')->withErrors($validator);
            }
        }

    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');
//        \Illuminate\Support\Facades\Session::flush();
    }

    public function unauthorized()
    {
        return View::make('auth.unauthorized');
    }

    public function doSignUp()
    {

        $data = Input::all();
        $massage = $this->_user->savePublicUser($data);
        if ($massage == "Success") {
            $credentials = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
            if (Auth::attempt($credentials)) {
                if(Auth::user()->user_type == "Portal User")
                return Redirect::to('/');
                elseif(Auth::user()->user_type == "Portal Doctor") {
                    $user = $this->_user;
                    return View::make('doctors.doctorInfo', compact('data', 'user'));
                }
            }
        } else
            echo "Error In Sign Up";
    }


    public function checkEmail()
    {
        $user = DB::table('users')->where('email', $_POST['user_email']);
        if ($user->count()) {
            echo "Email Already Exist";
        } else {
            echo "";
        }
    }

    public function checkOldPassword()
    {
         if(Hash::check(Input::get('oldPassword'),Auth::user()->password))
        echo "Match";
        else
            echo  "Oops";
    }

    public function checkUserName()
    {
        $user = DB::table('users')->where('username',$_POST['user_Name']);
        if ($user->count()) {
            echo "User Name Already Exist";
        } else {
            echo "";
        }
    }

    public function showPasswordChange(){

        return View::make('auth.changePassword');
    }

    public function userPasswordChange(){
        $data = Input::get('oldPassword');
        $data = Hash::make($data);
        $result = $this->_user->updatePassword($data);
        return Redirect::to("/");

    }


}
