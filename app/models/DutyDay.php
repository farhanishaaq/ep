<?php
use \App\Globals\GlobalsConst;
class DutyDay extends \Eloquent {

	// Add your validation rules here

	public static $rules = [
        'doctor_id' => 'required',
        'day' => 'required|unique:duty_days,day,NULL,id,doctor_id,3',
        'start' => 'required',
        'end' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['day', 'start', 'end', 'doctor_id'];

    public static function makeSlots($start_time, $end_time, $day_id, $emp_id){
        $timeSlot  = GlobalsConst::TIME_SLOT_INTERVAL * 60;

        $start = strtotime($start_time);
        $end = strtotime($end_time);


        while($start <= $end){
            $timeslot = new TimeSlot();
            $timeslot->slot = date("H:i:s", $start);
            $timeslot->save();
            $timeslot->duty_day_id = $day_id;
            $timeslot->save();
            $timeslot->doctor_id = $emp_id;
            $timeslot->save();
            $start += $timeSlot;
        }
    }

    public static function updateSlots($start_time, $end_time, $day_id){
        $fifteen_mins  = 15 * 60;
        $start = strtotime($start_time);
        $end = strtotime($end_time);

        TimeSlot::where('duty_day_id', '=', $day_id)->delete();

        while($start <= $end){
            $timeslot = new TimeSlot();
            $timeslot->slot = date("H:i:s", $start);
            $timeslot->save();
            $timeslot->duty_day_id = $day_id;
            $timeslot->save();
            $start += $fifteen_mins;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo('Doctor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timeSlots()
    {
        return $this->hasMany('TimeSlot');
    }

    /**
     * @param array|null $columns
     * @return mixed
     */
    public function user(array $columns = null)
    {
        return $this->employee()->first(["id", "user_id"])->user()->first($columns);
    }

    public static function saveDutyDays($data,$dataProcessType=GlobalsConst::DATA_SAVE){
        $doctorId = $data['doctor_id'];
        $response = ['success'=>true,'error'=>false,'message' => 'Duty Days has been saved successfully'];
        foreach (GlobalsConst::$DAYS as $d){
            if(isset($data[$d]) && $data[$d] != ''){
//                dd($d);
//                dd($dutyDayData['start']);
                $dutyDayData = (array)json_decode($data[$d]);
                $dutyDayData['doctor_id'] = $doctorId;
                self::$rules['day'] = 'required|unique:duty_days,day,NULL,id,doctor_id,'.$data['doctor_id'];
                $validator = Validator::make($dutyDayData, self::$rules);
                if($validator->fails()) {
                    $response = ['success'=>false,'error'=>true,'message' => $validator->errors()];
                    break;
                }
                $dutyDayData['start'] = date("H:i", strtotime($dutyDayData['start']));
                $dutyDayData['end'] = date("H:i", strtotime($dutyDayData['end']));
//                dd($dutyDayData);
                $dutyDay = DutyDay::create($dutyDayData);
                DutyDay::makeSlots($dutyDayData['start'], $dutyDayData['end'], $dutyDay->id, $dutyDayData['doctor_id']);
            }
        }
        return $response;
    }
}