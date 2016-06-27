<?php
use \App\Globals\GlobalsConst;

class UsersController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
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
		return View::make('users.edit')->nest('_form','users.partials._form',compact('formMode','user'));
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
			$filename        = str_random(6) . '_' . $file->getClientOriginalName();
			$uploadSuccess   = $file->move($destinationPath, $filename);
//			$response = ['success'=>true,'error'=>false,'message'=>'Photo has been uploaded successfully!','uploadedFileName'=>$filename,'abc'=>$uploadSuccess];
			$response = ['uploaded'=>$filename,'message'=>'Photo has been uploaded successfully!'];

		}else{
//			$response = ['success'=>false,'error'=>true,'message'=>'Photo upload has been failed!'];
			$response = ['error'=>'No files were processed.'];
		}
		return Response::json($response);
	}
}