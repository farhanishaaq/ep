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
            return View::make('auth.login');
        } else
            echo "Error In Sign Up";
    }

    public function doctorInfoForm()
    {
//        After Sign Up Take Doctor To the Further Detail
        $data = Input::all();

        $response = null;
        if (Input::hasFile('image')) {
            $file = Input::file('image');

            $type = $file->getMimeType();
            $size = $file->getSize();


            $supportedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg'];
            if ($size > 6000){
                if (in_array($type, $supportedTypes)){




                    $this->_user->savePublicDoctor($data);
                    $userId = $this->_user->id;

                    $destinationPath = public_path(GlobalsConst::PORTAL_PROFILE_DIR)."/".$userId;
                    $filename = str_random(16) . '_' . $file->getClientOriginalName();
                    $response = ['success' => true, 'uploaded' => $filename, 'message' => 'Photo has been uploaded successfully!'];
                    $uploadSuccess = $file->move($destinationPath, $filename);


                    $this->_image->saveImage ($destinationPath,$filename, $doctorId, $destinationPath);
                    $this->_user->bannerpath($filename);
//                return View::make('doctors.articlesEditer', compact('response'));

                }
                else{
                    $response = ['success' => false, 'error' => 'No files were processed.'] ;


                    return View::make('doctors.articlesEditer', compact('response'));


                }

            }
            else{

                $response = ['success' => false, 'error' => 'No files were processed.'] ;


                return View::make('doctors.articlesEditer', compact('response'));

            }

        }

        else {
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
            $response = ['success' => false, 'error' => 'No files were processed.'];
        }
//        return Response::json($response);


        return Redirect::route('articlesList');





//dd($data);
        $user= $this->_user;
            return View::make('doctors.doctorInfo',compact('data','user'));
    }

    public function doSignUpDoctor()
    {
//        Just For Next Form For Filling Additional Detail
        $data = Input::all();
        $user= $this->_user;
            return View::make('doctors.doctorInfo',compact('data','user'));
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

    public function checkUserName()
    {
        $user = DB::table('users')->where('username',$_POST['user_Name']);
        if ($user->count()) {
            echo "User Name Already Exist";
        } else {
            echo "";
        }
    }
}
