<?php
use \Illuminate\Support\Facades\DB;
class Timeslot extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['slot', 'reserved', 'duty_day_id', 'employee_id', 'company_id'];

    // Relationships
    public function dutyday()
    {
        return $this->belongsTo('Dutyday');
    }

    public function appointments()
    {
        return $this->hasMany('Appointment', 'time_slot_id', 'id');
    }

    public static function fetchAvailableTimeSlots($doctorId,$day){
        $qry = DB::table('timeslots')
            ->select(['timeslots.id','timeslots.slot'])
            ->join('dutydays', 'dutydays.id', '=', 'timeslots.duty_day_id','inner')
            ->where('dutydays.employee_id', '=', $doctorId)
            ->where('dutydays.day', '=', $day)
            ->whereNotIn('timeslots.id', function($query)
            {
//                $query->select(DB::raw(1))
                $query->select('appointments.time_slot_id')
                    ->from('appointments')
                    ->join('timeslots AS ts2', 'ts2.id', '=', 'appointments.time_slot_id','inner');
//                    ->whereRaw('orders.user_id = users.id');
            });
//        $qry->toSql();
        return $qry->get();
    }
}