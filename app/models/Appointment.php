<?php
use \App\Globals\GlobalsConst;
class Appointment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'doctor_id' => 'required',
        'time_slot_id' => 'required',
        'patient_id' => 'required',
        'status' => 'required',
        'paid_fee' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['business_unit_id',
                            'doctor_id',
                            'patient_id',
                            'time_slot_id',
                            'title',
                            'date',
                            'time',
                            'payment_status',
                            'expected_fee',
                            'discount_amount',
                            'paid_fee',
                            'status',
                            'reason_type',
                            'checkup_detail',];


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

    public function timeSlot()
    {
        return $this->belongsTo('TimeSlot', 'time_slot_id');
    }

    public function vitalSign()
    {
        return $this->hasOne('VitalSign');
    }

    public static function fetchAppointmentsByDay($day){
        $qry = DB::table('appointments')
            ->select([
                    'appointments.id',
                    DB::raw('CONCAT(p.full_name," have appointment with Dr. ",dr.full_name) AS `title`'),
                    'appointments.date',
                    'time_slots.slot AS start',
                    DB::raw('ADDTIME(time_slots.slot,"00:'.GlobalsConst::TIME_SLOT_INTERVAL.':00") AS `end`'),
                    'duty_days.day',
                ]
            )
            ->join('patients', 'patients.id', '=', 'appointments.patient_id','inner')
            ->join('users As p', 'p.id', '=', 'patients.user_id','inner')
            ->join('users As dr', 'dr.id', '=', 'appointments.doctor_id','inner')
            ->join('time_slots', 'time_slots.id', '=', 'appointments.time_slot_id','inner')
            ->join('duty_days', 'duty_days.id', '=', 'time_slots.duty_day_id','inner')
            ->where('duty_days.day', '=', $day);
        return $qry->get();
    }

    public static function saveAppointment($data){
        $response = null;
        $validator = Validator::make($data, self::$rules);
        if ($validator->fails())
        {
            return $response = ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator];
        }
        Appointment::create($data);
        $response = ['success'=>true, 'error'=> false, 'message'=>'Appointment has been saved successfully!'];
        return $response;
    }
}