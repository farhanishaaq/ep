<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use \App\Globals\GlobalsConst;
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
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array

	protected $fillable = ['company_id', 'business_unit_id', 'role_id', 'city_id', 'name', 'password', 'email', 'gender', 'age', 'city', 'country', 'address', 'phone', 'cnic', 'branch', 'note', 'status', 'role', 'company_id'];


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

	public function getCurrentRoles()
	{
		try{
			if(Auth::user()->roles->count()){
				
			}
			foreach(Auth::user()->roles as $role){

			}
		}catch (Exception $e)
		{

		}
	}

	/**
	 * hasRole | This Function used to check that user has the role which is passed and collection
	 * @param \Illuminate\Database\Eloquent\Collection $userRoles
	 * @return bool
	 */
	public static function hasRole(\Illuminate\Database\Eloquent\Collection $userRoles){
		try{
			if(Auth::user()->roles->count()){
				$rolesIds = $userRoles->lists('id');
				foreach (Auth::user()->roles as $role){
					if(in_array($role->id , $rolesIds)){
						return true;
					}
				}
				return false;
			}else{
				return false;
			}
		}catch(Exception $e){
			return false;
		}
	}

	public static function check($controller,$action){
//		try{
			if(Auth::user()->roles->count()){
				foreach (Auth::user()->roles as $role){
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
						die('JJJJ');
						return false;
					}
				}
				return false;
			}else{

				return false;
			}
//		}catch(Exception $e){
//			die('try error');
//			return false;
//		}
	}
}
