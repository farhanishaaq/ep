<?php
use \App\Globals\GlobalsConst;

class UsersController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
    private $_user;
    private $_image;
    private $_qualification;
    private $_doctor;


    public function __construct(User $user,Qualification $qualification,Doctor $doctor,Image $image)
    {
        $this->_user = $user;
        $this->_image = $image;
        $this->_doctor= $doctor;
        $this->_qualification = $qualification;

    }
	public function index()
	{
		$users = User::fetchUsers();
		return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new employee
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = null;
		$formMode = GlobalsConst::FORM_CREATE;
		return View::make('users.create')->nest('_form','users.partials._form',compact('formMode','user'));
	}

	/**
	 * Store a newly created employee in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data['company_id'] = Auth::user()->company_id;
		$data['status'] = Ep::getSwitchButtonVal(Input::get('status'),GlobalsConst::STATUS_ON,GlobalsConst::STATUS_OFF);
		$response = User::saveUser($data);
		return $response;

		$data = ['link' => URL::to('login'), 'name' => Input::get('name')];
		//******Send email to employee
		Mail::queue('emails.welcome', $data, function($message)
		{
			$message->to(Input::get('email'), Input::get('name'))->subject('Welcome to EP!');
		});
	}

	/**
	 * Display the specified employee.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
		return View::make('users.show')->nest('_view','users.partials._view', compact('user'));
	}

	/**
	 * Show the form for editing the specified employee.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$formMode = GlobalsConst::FORM_EDIT;
		$user = User::find($id);
		$roles=Role::all();
		return View::make('users.edit')->nest('_form','users.partials._form',compact('formMode','user','roles'));
	}

	/**
	 * Update the specified employee in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$employee = Employee::findOrFail($id);

		if (Input::get('email') !== $employee->email) {
			$input = array('email' => Input::get('email'));
			$validator = Validator::make($input, array('email' => 'unique:users'));

			if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)->withInput();
			}

		}

		$data = Input::all();

		$validator = Validator::make($data, array('status' => 'required', 'role' => 'required'));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['status'] = Ep::getSwitchButtonVal(Input::get('status'),GlobalsConst::STATUS_ON,GlobalsConst::STATUS_OFF);
//        $data['gender'] = Ep::getSwitchButtonVal(Input::get('gender'),GlobalsConst::MALE,GlobalsConst::FEMALE);
		$employee->update($data);

		return Redirect::route('users.index');
	}

	/**
	 * Remove the specified employee from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Employee::destroy($id);
		return Redirect::route('users.index');
	}

	
	public function uploadProfilePic(){
		$response = null;
		if (Input::hasFile('userPhoto')) {
			$file            = Input::file('userPhoto');
			$destinationPath = public_path(GlobalsConst::PROFILE_PHOTO_DIR);
			$filename        = str_random(4).'_'.$file->getClientOriginalName();
			$uploadSuccess   = $file->move($destinationPath, $filename);
//			$response = ['success'=>true,'error'=>false,'message'=>'Photo has been uploaded successfully!','uploadedFileName'=>$filename,'abc'=>$uploadSuccess];
			$response = ['success'=>true,'uploaded'=>$filename,'message'=>'Photo has been uploaded successfully!'];

		}else{
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
			$response = ['success'=>false,'error'=>'No files were processed.'];
		}
		return Response::json($response);
	}

    public function userProfile()
    {
//        For Public User if Come after Click on Profile form login drop down
        if (Auth::user()->user_type == "Portal User" || Auth::user()->user_type == "Admin") {
            $userId = Auth::user()->id;
            $dataResult = $this->_user->fetechUserRecord($userId);
            $data = array_map(function ($object) {
                return (array)$object;
            }, $dataResult);
            $data = $data[0];
            $cities = City::all();
            return View::make('doctors.doctorInfo', compact('data','cities'));

//            IF Portal Doctor Come after Click on profile from drop down login
        } elseif (Auth::user()->user_type == "Portal Doctor") {
            $user = $this->_user;
            $userId = Auth::user()->id;

                $dataResult = $this->_doctor->fetechDoctorRecord($userId);
                if(!$dataResult){
                    $dataResult = $this->_user->fetechUserRecord($userId);
                }
                    $data = array_map(function ($object) {
                    return (array)$object;
                }, $dataResult);
                $cities = City::all();
                $data = $data[0];

                return View::make('doctors.doctorInfo', compact('data', 'user', 'cities'));
//        return View::make('doctors.userProfileUpdate',compact('data','user'));
            }
        }

	public function userProfileUpdate(){
//        uploadProfilePic();
        $response = null;
        if (Input::hasFile('image')) {
//dd();
            $file = Input::file('image');
            $type = $file->getMimeType();
            $size = $file->getSize();
        $supportedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg'];
        if ($size > 4000){
            if (in_array($type, $supportedTypes)){
                $userId = Auth::user()->id;

                $destinationPath = public_path(GlobalsConst::PROFILE_PHOTO_DIR)."/".$userId;
                $filename = str_random(16) . '_' . $file->getClientOriginalName();
                $response = ['success' => true, 'uploaded' => $filename, 'message' => 'Photo has been uploaded successfully!'];
                $uploadSuccess = $file->move($destinationPath, $filename);
                $imageStatus=$this->_user->updateProfileImage ($filename,$userId);
//                $imageStatus = $this->_user->profilePhoto($filename);
            }
            else{
                $response = ['success' => false, 'error' => 'No files were processed.'] ;
                return View::make('doctors.doctorInfo', compact('response'));
            }
        }
    }
else {
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
$response = ['success' => false, 'error' => 'No files were processed.'];
}
        $userData = Input::all();
	    $data = User::updateProfileUser($userData);
        return Redirect::to('/');
    }



    public function doctorInfoForm()
    {

// Image Part
//        dd(Input::get('currentUserId'));
        if(Auth::check()){
            $currentUserId = Auth::user()->id;
//            If true then Ok Filter Pass
        }else{
            $currentUserId = Input::get('currentUserId');
            $credentials = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
            Auth::attempt($credentials);
        }
        $data = Input::all();
        if (!empty(Input::hasFile('image'))){


        $response = null;
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $type = $file->getMimeType();
            $size = $file->getSize();

//               After Sign Up Take Doctor To the Further Detail

            $credentials = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
//        Check For Additional Info Form: Fill First Time OR Update
            $formIteration = Doctor::findDoctorId($currentUserId);

            if ($formIteration == "Not Exist") {

                if (!empty($currentUserId)) {
//             Means Come For First Time
                    $resultUserData = $this->_user->updateProfileDoctor($data,$currentUserId);
                    $saveDoctorId = $this->_doctor->saveInDoctorTable($data, $currentUserId);
                    $this->_doctor->saveDoctorSpeciality($data, $saveDoctorId);
                    $this->_doctor->saveDoctorQualificaion($data, $saveDoctorId);
                }
            } else {
//            come for update
                    $resultUserData = $this->_user->updateProfileDoctor($data,$currentUserId);
                    $saveDoctorId = $this->_doctor->updateInDoctorTable($data,$currentUserId);


            }

            $supportedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg'];
            if ($size > 4000) {
                if (in_array($type, $supportedTypes)) {
                    $destinationPath = public_path(GlobalsConst::PROFILE_PHOTO_DIR) . "/" . $currentUserId;
                    $filename = str_random(16) . '_' . $file->getClientOriginalName();
                    $response = ['success' => true, 'uploaded' => $filename, 'message' => 'Photo has been uploaded successfully!'];
                    $uploadSuccess = $file->move($destinationPath, $filename);
                    $imageStatus = $this->_user->updateProfileImage($filename,$currentUserId);
                }
                else{
                        $response = ['success' => false, 'error' => 'No files were processed.'];
                        return View::make('doctors.doctorInfo', compact('response'));
                    }

//        return Response::json($response);
//        return Redirect::route('articlesList');
////dd($data);
//        $user= $this->_user;
//        return View::make('doctors.doctorInfo',compact('data','user'));

            }
        }
        else {
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
            $response = ['success' => false, 'error' => 'No files were processed.'];

            if(Auth::check()){
                return Redirect::to('/');

            }

        }
        }
        else{
            $resultUserData = $this->_user->updateProfileDoctor($data,$currentUserId);
            $saveDoctorId = $this->_doctor->updateInDoctorTable($data,$currentUserId);
        }
//        Auth::attempt($credentials);
        return Redirect::to('/');
    }

    public function doctorStatusList(){
        $action['condition'] = "Request";
        $data = $this->_user->getDoctorRequestRecords();
        return View::make('doctors.doctorStatus',compact('data','action'));
    }

    public function doctorAllRequest(){
        $action['condition'] = "All";
        $data = $this->_user->getDoctorAllRequest();
        return View::make('doctors.doctorStatus',compact('data','action'));
    }

    public function updateDoctorStatus(){
        $data['doctorAction'] = $_POST['doctor_action'];
        $data['userId'] =$_POST['user_id'];

        $result = $this->_doctor->UpdateStatus($data);
        echo $result;
    }

}