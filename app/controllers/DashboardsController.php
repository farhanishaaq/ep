<?php
use App\Globals\GlobalsConst;
use \App\Globals\Ep;
class DashboardsController extends \BaseController
{


    public function showDashboard()
    {
        $userType = Ep::currentUserType();
        switch ($userType) {
            case GlobalsConst::SUPER_ADMIN:
                return View::make('dashboards.super_home');
            case GlobalsConst::ADMIN:
                //**/*************************//
                $appointmentPieChartDataset = null;
                $appointmentLineChartDataset = null;
                $dailyFeeCollectionDataset = null;
                $appointmentDataset = [];
                $companyId = Ep::currentCompanyId();
                //*************************** Daily Fee Collection Summary (Box 1)
                $dailyFeeCollectionData = Appointment::dailyFeeCollectionSummary();
                if($dailyFeeCollectionData){
                    $dailyFeeCollectionDataset['paidFee'] = $dailyFeeCollectionData->paid_fee;
                    $dailyFeeCollectionDataset['expectedFee'] = $dailyFeeCollectionData->expected_fee;
                }else{
                    $dailyFeeCollectionDataset['paidFee'] = 0;
                    $dailyFeeCollectionDataset['expectedFee'] = 0;
                }
                //**************************END (Box 1)


                //*******AppointmentsCountStatusWise Into Pie Chart (Box 2)
                $appointmentsCountStatusWise = Appointment::fetchAppointmentsCountStatusWise();
                foreach ($appointmentsCountStatusWise as $a) {
                    $appointmentPieChartDataset['data'][] = $a->AppointmentCount;
                    $appointmentPieChartDataset['labels'][] = GlobalsConst::$APPOINTMENT_STATUSES[$a->ChartLabel];
                    $appointmentPieChartDataset['backgroundColor'][] = GlobalsConst::$APPOINTMENT_STATUSES_COLORS[$a->ChartLabel];
                }
                $appointmentPieChartDatasetJson = json_encode($appointmentPieChartDataset);
                //*******END (Box 2)



                //*******AppointmentsCountStatusWise Into Pie Chart (Box 3)
                $appointmentsCountWeekWise = Appointment::fetchAppointmentsCountWeekWise();
                foreach ($appointmentsCountWeekWise as $a) {
                    $appointmentLineChartDataset['data'][] = $a->AppointmentCount;
                    $appointmentLineChartDataset['labels'][] = substr(GlobalsConst::$DAYS_WITH_NUM_KEYS[$a->ChartLabel],0,3) ;
//                    $appointmentLineChartDataset['backgroundColor'][] = GlobalsConst::$APPOINTMENT_STATUSES_COLORS[$a->status];
                }
                $appointmentLineChartDatasetJson = json_encode($appointmentLineChartDataset);
                //*******END (Box 3)


                //*******AppointmentsCountStatusWise Into Pie Chart (Box 3)
                $appointments = Appointment::whereRaw('MONTH(date) = "'.date('m').'"')->get();
                if($appointments !== null){
                    if(count($appointments)){
                        foreach($appointments as $k=>$a){
//                    $doctors = $a->employee;
                            $startTime = $a->timeSlot->slot;
                            $endTimeStr = strtotime("+".GlobalsConst::TIME_SLOT_INTERVAL." minutes", strtotime($startTime));
                            $endTime = date('h:i:s', $endTimeStr);
                            $title = $a->patient->user->full_name . " have appointment with Dr. ".$a->doctor->user->full_name.' at '. $startTime;
                            $aDate = $a->date;
                            $dpDay = array_search($a->day, GlobalsConst::$DP_DAYS);
                            $appointmentDataset[$k]['start'] =  $aDate.'T'. $startTime;
                            $appointmentDataset[$k]['end'] =  $aDate.'T'. $endTime;
                            $appointmentDataset[$k]['id'] =  $a->id;
                            $appointmentDataset[$k]['text'] =  $title;
                        }

                    }
                }
                $appointmentJson = json_encode($appointmentDataset);
                return View::make('dashboards.admin', compact('appointmentPieChartDatasetJson','appointmentLineChartDatasetJson', 'dailyFeeCollectionDataset', 'appointmentJson'));
           // case GlobalsConst::EMPLOYEE:
            case "Doctor":
                return View::make('dashboards.employee', compact('appointments', 'dataSet', '', '', ''));
            default:
                echo 'default';
        }
    }
}