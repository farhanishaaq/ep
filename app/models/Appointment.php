<?php
use \App\Globals\GlobalsConst;
class Appointment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'employee_id' => 'required',
        'timeslot_id' => 'required',
        'patient_id' => 'required',
        'status' => 'required'

        

	];

	// Don't forget to fill this array
	protected $fillable = ['checkup_reason', 'time', 'date', 'status', 'checkup_fee', 'fee_note',
    'timeslot_id', 'patient_id', 'employee_id', 'clinic_id', 'fee'];

    // Relationships
    public function patient()
    {
        return $this->belongsTo('Patient');
    }

    public function employee()
    {
        return $this->belongsTo('Employee');
    }

    public function prescription()
    {
        return $this->hasOne('Prescription');
    }

    public function timeslot()
    {
        return $this->belongsTo('Timeslot', 'timeslot_id');
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
            ->join('timeslots', 'timeslots.id', '=', 'appointments.timeslot_id','inner')
            ->join('dutydays', 'dutydays.id', '=', 'timeslots.dutyday_id','inner')
            ->where('dutydays.day', '=', $day);
        return $qry->get();
    }
}