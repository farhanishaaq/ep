<?php
use \App\Globals\GlobalsConst;
class Appointment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'employee_id' => 'required',
        'time_slot_id' => 'required',
        'patient_id' => 'required',
        'status' => 'required'

        

	];

	// Don't forget to fill this array
	protected $fillable = ['checkup_reason', 'time', 'date', 'status', 'checkup_fee', 'fee_note',
    'time_slot_id', 'patient_id', 'employee_id', 'company_id', 'fee'];


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
    public function employee()
    {
        return $this->belongsTo('Employee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('Patient');
    }

    public function prescription()
    {
        return $this->hasOne('Prescription');
    }

    public function timeslot()
    {
        return $this->belongsTo('Timeslot', 'time_slot_id');
    }

    public function vitalsign()
    {
        return $this->hasOne('Vitalsign');
    }

    public function diagonosticprocedure()
    {
        return $this->hasOne('Diagonosticprocedure');
    }

    public function labtests()
    {
        return $this->hasMany('Labtest');
    }

    public function checkupfee()
    {
        return $this->hasOne('CheckupFee');
    }

    public static function fetchAppointmentsByDay($day){
        $qry = DB::table('appointments')
            ->select([
                    'appointments.id',
                    'patients.name',
                    'appointments.date',
                    'timeslots.slot AS start',
                    DB::raw('ADDTIME(timeslots.slot,"00:'.GlobalsConst::TIME_SLOT_INTERVAL.':00") AS `end`'),
                    'dutydays.day',
                ]
            )
            ->join('patients', 'patients.id', '=', 'appointments.patient_id','inner')
            ->join('timeslots', 'timeslots.id', '=', 'appointments.time_slot_id','inner')
            ->join('dutydays', 'dutydays.id', '=', 'timeslots.duty_day_id','inner')
            ->where('dutydays.day', '=', $day);
        return $qry->get();
    }
}