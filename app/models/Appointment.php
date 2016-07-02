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
    public function doctor()
    {
        return $this->belongsTo('Doctor');
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
        return $this->hasOne('VitalSign');
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
                    'time_slots.slot AS start',
                    DB::raw('ADDTIME(time_slots.slot,"00:'.GlobalsConst::TIME_SLOT_INTERVAL.':00") AS `end`'),
                    'duty_days.day',
                ]
            )
            ->join('patients', 'patients.id', '=', 'appointments.patient_id','inner')
            ->join('time_slots', 'time_slots.id', '=', 'appointments.time_slot_id','inner')
            ->join('duty_days', 'duty_days.id', '=', 'time_slots.duty_day_id','inner')
            ->where('duty_days.day', '=', $day);
        return $qry->get();
    }
}