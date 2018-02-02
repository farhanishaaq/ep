<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use \App\Globals\GlobalsConst;
use \App\Globals\Ep;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	// Add your validation rules here
	protected $fillable = ['company_id',
		'business_unit_id',
		'city_id',
		'user_type',
		'fname',
		'lname',
		'full_name',
		'password',
		'email',
		'gender',
		'address',
		'dob',
		'photo',
		'cnic',
		'cell',
		'phone',
		'cnic',
		'additional_info',
		'status',];

	public static $rules = [
		'user_type' => 'required',
		'username' => 'required|unique:users',
		'password' => 'required|min:6',
		'email' => 'required|unique:users',
		'fname' => 'required|max:40',
		'lname' => 'required|max:40',
	];

	// Don't forget to fill this array


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function company(){
		return $this->belongsTo('Company');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function businessUnit()
	{
		return $this->belongsTo('BusinessUnit');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function city()
	{
		return $this->belongsTo('City');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany('Role','role_user','user_id','role_id');
	}

	public function patient(){
		return $this->hasOne('Patient');
	}

	public function employee(){
		return $this->hasOne('Employee');
	}

	public function doctor(){
		return $this->hasOne('Doctor');
	}
    public function article(){
        return $this->hasMany("Article");

    }
    public function question()
{

    return $this->hasMany('Question','doctor_id');
}

    public function getCurrentRoles()
	{
		try{
            $currentUser = Ep::currentUser();
			if($currentUser->roles->count()){
				
			}
			foreach($currentUser->roles as $role){

			}
		}catch (Throwable $t) {
			// Executed only in PHP 7, will not match in PHP 5.x
			dd($t->getMessage());
		}
		catch (Exception $e)
		{

		}
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function dutyDays()
	{
		return $this->hasManyThrough('DutyDay', 'Employee', 'user_id', 'employee_id');
	}
    public function ratings()
    {
        return $this->hasMany('Rating');
    }
	/**
	 * hasRole | This Function used to check that user has the role which is passed and collection
	 * @param \Illuminate\Database\Eloquent\Collection $userRoles
	 * @return bool
	 */
	public static function hasRole(\Illuminate\Database\Eloquent\Collection $userRoles){
		try{
            $currentUser = Ep::currentUser();
			if($currentUser->roles->count()){
				$rolesIds = $userRoles->lists('id');
				foreach ($currentUser->roles as $role){
					if(in_array($role->id , $rolesIds)){
						return true;
					}
				}
				return false;
			}else{
				return false;
			}
		}catch (Throwable $t) {
			// Executed only in PHP 7, will not match in PHP 5.x
			return false;
		}catch(Exception $e){
			return false;
		}
	}

	public static function check($controller,$action){

//	    foreach (Ep::currentUser()->roles as $role){
//
//	        print_r($role->name);
//        }
//
//        dd(Ep::currentUser()->roles);
//	    dd('wadksajkd');
		try{
		    $currentUser = Ep::currentUser();
			if($currentUser->roles->count()){
				foreach ($currentUser->roles as $role){
					if($role->id == GlobalsConst::SUPER_ADMIN_ID){
						return true;
					}else{
//						echo $role->resources->count();
						foreach($role->resources as $resource){
							if($resource->parent){
								/*if($resource->parent->name == 'DashboardsController' && $resource->name == 'showDashboard'){
                                    echo $resource->parent->id.'<br>';
                                    echo $resource->parent->name.'<br>';
                                    echo $resource->id.'<br>';
                                    echo $resource->name.'<br>';
                                    var_dump($resource->pivot->status).'<br>';
                                }*/
								if($resource->parent->name == $controller && $resource->name == $action && $resource->pivot->status == 'Allow'){
									return true;
								}


							}
						}
						return false;
					}
				}
				return false;
			}else{
				return false;
			}
		}catch (Throwable $t) {
			// Executed only in PHP 7, will not match in PHP 5.x
			return false;
		}catch(Exception $e){
			die('try and catch Error');
			return false;
		}
	}

	/**
	 * @param array|null $filterParams
	 * @param int $offset
	 * @param int $limit
	 * @return array|\Illuminate\Database\Eloquent\Collection|static[]
	 */
	public static function fetchUsers(array $filterParams = null,$offset=0,$limit=GlobalsConst::LIST_DATA_LIMIT){
		try{
			if(Auth::user()->user_type == GlobalsConst::SUPER_ADMIN){
				$users = User::all();
			}elseif(Ep::currentUserType() == GlobalsConst::ADMIN){
				$users = User::where('company_id', Ep::currentCompanyId());
			}else{
				$users = User::where('company_id', Ep::currentCompanyId())->where('user_type','!=',GlobalsConst::ADMIN);
			}
			if($filterParams){
				$searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'].'%' : '';
				$users->where('full_name','LIKE',$searchKey);
			}
			return $users->skip($offset)->take($limit)
				->orderBy('id','DESC')->get();
		}
		catch (Throwable $t) {
			// Executed only in PHP 7, will not match in PHP 5.x
			dd($t->getMessage());
		}
		catch (Exception $e){
			dd($e->getMessage());
		}

	}

	/**
	 * @param $data
	 * @param int $dataProcessType
	 * @return array|null
	 */
	public static function saveUser($data,$dataProcessType=GlobalsConst::DATA_SAVE){
		$response = null;
		$comeFrom = isset($data['comeFrom']) ? $data['comeFrom'] : 'User';
		$vRules = User::$rules;
		$userType = $data['user_type'];

		if($dataProcessType==GlobalsConst::DATA_SAVE){
			$user = new User();
			$user->password =  Hash::make($data['password']);
		}elseif($dataProcessType==GlobalsConst::DATA_UPDATE){
			$id = isset($data['userId']) ? $data['userId'] : '';
			$vRules['username'] = $vRules['username'] . ',id,' . $id;
			$vRules['email'] = $vRules['email'] . ',id,' . $id;
			$vRules['password'] = '';
			if($id != ''){
				$user = User::find($id);
			}else{
				return $response = ['success'=>false, 'error'=> true, 'message' => $comeFrom.' record did not find for updation! '];
			}
		}

		//*****Start Rules Validators
		$validator = Validator::make($data, $vRules);
		if ($validator->fails())
		{
//			return Redirect::back()->withErrors($validator)->withInput();
			return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
		}
		//*****End Rules Validators

		$cityId = isset($data['city_id']) ? $data['city_id'] : null;
		$dob = isset($data['dob']) ? date('Y-m-d',strtotime($data['dob'])) : null;
		$cnic = isset($data['cnic']) ? $data['cnic'] : null;
		$gender = isset($data['gender']) ? $data['gender'] : null;
		$address = isset($data['address']) ? $data['address'] : null;
		$cell = isset($data['cell']) ? $data['cell'] : null;
		$phone = isset($data['phone']) ? $data['phone'] : null;
		$additional_info = isset($data['additional_info']) ? $data['additional_info'] : null;
		$photo = isset($data['photo']) ? $data['photo'] : null;



		$user->company_id = $data['company_id'];
		$user->business_unit_id = $data['business_unit_id'];
		$user->city_id = $cityId;
		$user->fname = $data['fname'];
		$user->lname = $data['lname'];
		$user->full_name = $data['fname'].' '.$data['lname'];
		$user->username = $data['username'];
		$user->email = $data['email'];
		$user->photo = $photo;
		$user->user_type = $userType;
		$user->dob = $dob;
		$user->cnic = $cnic;
		$user->gender = $gender;
		$user->address = $address;
		$user->cell = $cell;
		$user->phone = $phone;
		$user->status = $data['status'];
		$user->additional_info = $additional_info;
		$user->save();

		if($user){
			$data['user_id'] = $user->id;
			switch ($userType){
				case GlobalsConst::ADMIN:
				case GlobalsConst::EMPLOYEE:
				case GlobalsConst::WORKER:
//					Employee::create($data);
				$data['user_id'] = $user->id;
				Employee::saveEmployee($data,$dataProcessType);
				break;
				case GlobalsConst::DOCTOR:
					$employeeResponse = Employee::saveEmployee($data,$dataProcessType);
					if(isset($employeeResponse['Employee'])){
						$employee = $employeeResponse['Employee'];
						$data['employee_id'] = $employee->id;
						$doctorResponse = Doctor::saveDoctor($data,$dataProcessType);
						if(isset($doctorResponse['Doctor'])){
							unset($doctorResponse['Doctor']);
						}
						return $doctorResponse;
					}else{
						return $employeeResponse;
					}
				break;
				case GlobalsConst::PATIENT:
					$patientResponse = Patient::savePatient($data,$dataProcessType);
					if(isset($patientResponse['Patient'])){
						unset($patientResponse['Patient']);
					}
					return $patientResponse;
				break;
			}
			$response = ['success'=>true, 'error'=> false, 'message'=>$comeFrom .' has been saved successfully!'];
		}
		return $response;
	}

    public function fetechUserRecord($id)
    {
        $data = DB::table('users')
            ->where('users.id', '=', $id)
            ->get();

        return $data;
    }


	public function getDoctorByNameForSelector($name){
	    $doctors = self::select('full_name')
                    ->where("user_type",'=','Doctor')
                    ->where('full_name','like','%'.$name.'%')->get();

	    return json_encode($doctors);
    }

    public  function savePublicUser(array $filterparams,$dataProcessType=GlobalsConst::DATA_SAVE){
//            Active Funtion For Sign Up
	    $this->company_id = "1";
        $this->business_unit_id = "1";
        $this->user_type = $filterparams['user_type'];
        $this->fname = $filterparams['fname'];
        $this->lname = $filterparams['lname'];
        $this->full_name = $filterparams['fname'] . " " . $filterparams['lname'];
        $this->email = $filterparams['email'];
        $this->username = $filterparams['username'];
        $this->city_id = $filterparams['city_id'];
        $this->password = Hash::make($filterparams['password']);
        $this->phone = $filterparams['phone'];
        $this->save();
        if($filterparams['user_type'] == "Portal User")
            $this->roles()->sync([3]);
            else
                $this->roles()->sync([4]);
        return "Success";

    }

    public  function savePublicInfo(array $filterparams,$dataProcessType=GlobalsConst::DATA_SAVE){
        $originalDate = $filterparams['dob'];
        $newDate = date("Y-m-d", strtotime($originalDate));
	    $this->gender = $filterparams['gender'];
	    $this->dob = $newDate;
	    $this->cnic= $filterparams['cnic'];
	    $this->address= $filterparams['address'];
        $this->save();
        return "Success";

    }
    public function savePublicDoctor(array $filterparams,$dataProcessType=GlobalsConst::DATA_SAVE){
//                    Not Use for Yet
        $this->company_id = "1";
        $this->business_unit_id = "1";
        $this->fname = $filterparams['fname'];
        $this->lname = $filterparams['lname'];
        $this->full_name = "Dr.".$filterparams['fname'] . " " . $filterparams['lname'];
        $this->user_type = GlobalsConst::PORTAL_DOCTOR;
        $this->email = $filterparams['email'];
        $this->username = $filterparams['username'];
        $this->password = Hash::make($filterparams['password']);
        $this->phone = $filterparams['phone'];
        $this->dob = $filterparams['dob'];
        $this->city_id = $filterparams['city_id'];
        $this->cnic = $filterparams['cnic'];
        $this->gender = $filterparams['gender'];
        $this->address = $filterparams['address'];

        if($this->save()){
            $this->roles()->sync([2]);
            return $this->id;
        }
    }

public function fetchemail($filterparams){
    $email=self::where('email','=','%'.$filterparams['q'].'%');
    return $email;
}

    public static function profileFetch($userId){


	    $data = DB::table('users')
        ->where('id','=', $userId )
         ->get();
        $datanew = array_map(function($object){
            return (array) $object;
        }, $data);
        return $datanew;
//
        }

        public static function updateProfileUser($filterparams){
            $originalDate = $filterparams['dob'];
            $newDate = date("Y-m-d", strtotime($originalDate));
            $userProfile = DB::table('users')
                ->where('id','=', Auth::user()->id )
                ->update(["fname"=>$filterparams['fname'],'lname'=>$filterparams['lname'],'full_name'=>$filterparams['fname'] . " " . $filterparams['lname'],'phone' => $filterparams['phone'],'address'=>$filterparams['address'],'dob'=> $newDate,'cnic'=>$filterparams['cnic'],'gender'=>$filterparams['gender'],'city_id'=>$filterparams['city_id']]);

                        return "Success";
}

    public static function updateProfileDoctor($filterparams,$currentUserId){
        $originalDate = $filterparams['dob'];
        $newDate = date("Y-m-d", strtotime($originalDate));
	    $userProfile = DB::table('users')

                ->where('id','=', $currentUserId )
                ->update(["fname"=>$filterparams['fname'],'lname'=>$filterparams['lname'],'full_name'=>"Dr.".$filterparams['fname'] . " " . $filterparams['lname'],'phone' => $filterparams['phone'],'address'=>$filterparams['address'],'dob'=>$newDate,'cnic'=>$filterparams['cnic'],'gender'=>$filterparams['gender']]);

                        return "Success";
        }
    public function updateProfileImage ($filename,$currentUserId){
//          dd($destinationPath,$filename);
        $imagePath = "profileImages/".$currentUserId."/".$filename;
        $queryBuilder = self::find($currentUserId);
        $queryBuilder->photo = $imagePath;
        $queryBuilder->update();

//        DB::table('users')
//            ->where('id','=', $userId)
//            ->update(['photo' => $imagePath]);
        return 'sucess';
    }

    public function updatePassword($password){
//$passwordStore = self::find(Auth::user()->id);
//    $passwordStore->update(['password'=>$password]);
        $userProfile = DB::table('users')
            ->where('id','=', Auth::user()->id )
            ->update(['password'=>$password]);
            return "Success";
    }

    public function getDoctorRequestRecords(){

        $queryBuilder = DB::table('users')
            ->leftJoin('doctors','users.id','=','doctors.user_id')
            ->where('doctors.status','Inactive')
            ->where('user_type', '=', "Portal Doctor")
            ->select('full_name','doctors.status AS doctorStatus','users.id AS userId','user_type','users.created_at AS doctorCreated_at')
            ->paginate(7);
        return $queryBuilder;
    }

    public function getDoctorAllRequest(){

        $queryBuilder = DB::table('users')
            ->leftJoin('doctors','users.id','=','doctors.user_id')
            ->where('user_type', '=', "Portal Doctor")
            ->select('full_name','doctors.status AS doctorStatus','users.id AS userId','user_type','users.created_at AS doctorCreated_at')
            ->paginate(7);
                return $queryBuilder;
    }


}
