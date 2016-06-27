<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use \App\Globals\GlobalsConst;
class Employee extends \Eloquent{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array

	protected $fillable = ['company_id',
                            'business_unit_id',
                            'user_id',
                            'joining_date',
                            'quite_date',
                            'joining_salary',
                            'current_salary'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companies()
    {
        return $this->hasMany('Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businessUnits()
    {
        return $this->hasMany('BusinessUnit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dutyDays()
    {
        return $this->hasMany('DutyDay');
    }

    public function appointments()
    {
        return $this->hasMany('Appointment');
    }

    public function prescriptions()
    {
        return $this->hasMany('Prescription');
    }

    public function company(){
        return $this->belongsTo('Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor()
    {
        return $this->hasOne('Doctor');
    }

    /**
     * @param $data
     * @param int $dataProcessType
     * @return array|null
     */
    public static function saveEmployee($data,$dataProcessType=GlobalsConst::DATA_SAVE){
        $response = null;
        if($dataProcessType==GlobalsConst::DATA_SAVE){
            $employee = new Employee();
        }else{
            $id = isset($data['employeeId']) ? $data['employeeId'] : '';
            if($id != ''){
                $employee = Employee::find($id);
            }else{
                return $response = ['success'=>false, 'error'=> true, 'message' => 'Employee record did not find for updation! '];
            }
        }
        $employee->company_id = isset($data['company_id']) ? $data['company_id'] : null;
        $employee->business_unit_id = isset($data['business_unit_id']) ? $data['business_unit_id'] : null;
        $employee->user_id = isset($data['user_id']) ? $data['user_id'] : null;
        $employee->joining_date = $data['joining_date'];
        $employee->quite_date = $data['quite_date'];
        $employee->joining_salary = $data['joining_salary'];
        $employee->current_salary = $data['current_salary'];
        $employee->save();
        $response = ['success'=>true, 'error'=> false, 'message'=>'Employee has been saved successfully!','Employee'=>$employee];
        return $response;
    }
}