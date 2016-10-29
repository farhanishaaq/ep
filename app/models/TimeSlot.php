<?php
use \Illuminate\Support\Facades\DB;
class TimeSlot extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['doctor_id', 'duty_day_id', 'slot'];

    // Relationships
    public function dutyDay()
    {
        return $this->belongsTo('DutyDay');
    }

    public function appointments()
    {
        return $this->hasMany('Appointment', 'time_slot_id', 'id');
    }


    public static function fetchTimeSlotsByAppointmentDate(Appointment $appointment, $isList=false){
        $appointmentDay = date('l',strtotime($appointment->date));
        $dutyDayId = $appointment->doctor->dutyDays()->where('day','=',$appointmentDay)->first()->id;
        $timeSlot = self::where('doctor_id','=',$appointment->doctor_id)
            ->where('duty_day_id','=', $dutyDayId)
            ->get();
        if ($isList){
            return $timeSlot->lists('slot', 'id');
        }
        return $timeSlot;
    }


    /**
     * @param $doctorId
     * @param $day
     * @param bool $isLists
     * @return mixed
     */
    public static function fetchAvailableTimeSlots($doctorId,$day,$isLists=false){
        $qry = DB::table('time_slots')
            ->select(['time_slots.id','time_slots.slot'])
            ->join('duty_days', 'duty_days.id', '=', 'time_slots.duty_day_id','inner')
            ->where('duty_days.doctor_id', '=', $doctorId)
            ->where('duty_days.day', '=', $day)
            ->whereNotIn('time_slots.id', function($query)
            {
//                $query->select(DB::raw(1))
                $query->select('appointments.time_slot_id')
                    ->from('appointments')
                    ->join('time_slots AS ts2', 'ts2.id', '=', 'appointments.time_slot_id','inner');
//                    ->whereRaw('orders.user_id = users.id');
            });
//        $qry->toSql();
        if($isLists)
            return $qry->lists('slot','id');
        else
            return $qry->get();
    }
}