<?php
use \App\Globals\GlobalsConst;
use \App\Globals\Ep;


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
	protected $fillable = [ 'id',
        'business_unit_id',
                            'doctor_id',
                            'patient_id',
                            'time_slot_id',
                            'code',
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

    /**
     * @param null $params
     * @return array
     */
    public static function fetchAppointmentsCountStatusWise($params=null){
        $businessUnitId = isset($params['businessUnitId']) ? $params['businessUnitId']: Ep::currentBusinessUnitId();
        $query = 'SELECT
	s.`ChartLabel`,
	COUNT(a.id) AS AppointmentCount
FROM
	(
		SELECT
			1 AS `ChartLabel`
		UNION ALL
			SELECT
				2 AS `ChartLabel`
			UNION ALL
				SELECT
					3 AS `ChartLabel`
				UNION ALL
					SELECT
						4 AS `ChartLabel`
					UNION ALL
						SELECT
							5 AS `ChartLabel`
	) AS s
LEFT OUTER JOIN appointments AS a ON a.`status` = s.`ChartLabel` AND a.`business_unit_id` = ?
GROUP BY
	s.`ChartLabel`';
        $result = DB::select(DB::raw($query),[$businessUnitId]);
        return $result;
    }


    /**
     * @param null $params
     * @return array
     */
    public static function fetchAppointmentsCountWeekWise($params=null){
        //Note: 1=Monday,2=Tuesday,etc...
        //SUBSTR(DAYNAME(a.date),1 ,3)
        $businessUnitId = isset($params['businessUnitId']) ? $params['businessUnitId']: Ep::currentBusinessUnitId();
        $query = "SELECT
	d.ChartLabel,
	COUNT(a.id) AS AppointmentCount
FROM
	(
		SELECT
			'1' AS ChartLabel
		UNION ALL
			SELECT
				'2' AS ChartLabel
			UNION ALL
				SELECT
					'3' AS ChartLabel
				UNION ALL
					SELECT
						'4' AS ChartLabel
					UNION ALL
						SELECT
							'5' AS ChartLabel
						UNION ALL
							SELECT
								'6' AS ChartLabel
							UNION ALL
								SELECT
									'7' AS ChartLabel
	) AS d
LEFT OUTER JOIN appointments AS a ON (WEEKDAY(a.`date`)+1) = d.ChartLabel 
AND a.`business_unit_id` = ? AND a.`date` >= ( CURDATE() - INTERVAL ? DAY )

GROUP BY
	d.ChartLabel";
//        dd($query);
//        $result = DB::select(DB::raw($query),[$businessUnitId,GlobalsConst::COMPLETED]);
        $sevenDays = 7;
        $result = DB::select(DB::raw($query),[$businessUnitId,$sevenDays]);
        return $result;
    }


    public static function dailyFeeCollectionSummary($params=null){
        $businessUnitId = isset($params['businessUnitId']) ? $params['businessUnitId']: Ep::currentBusinessUnitId();
        $qryBuilder = DB::table('appointments')
            ->select(DB::raw('SUM(appointments.paid_fee) AS paid_fee'), DB::raw('SUM(appointments.expected_fee) AS expected_fee'))
            ->where('appointments.business_unit_id', $businessUnitId)
            ->whereRaw('appointments.`date` = "'.date('Y-m-d').'"')
            ->groupBy('appointments.date');


        /*$result = $qryBuilder->toSql();
        dd($result);*/
        $result = $qryBuilder->first();
//        dd($result);
        return $result;
    }
}