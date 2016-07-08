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
                $companyId = Ep::currentCompanyId();
                $PaitentsData = DB::table('appointments')
                    ->select(DB::raw('DAYNAME(appointments.date) AS pDay'), DB::raw('COUNT(patients.id) as totalPatients'))
                    ->join('patients', 'patients.id', '=', 'appointments.patient_id')
                    ->where('patients.company_id', $companyId)
                    ->where('appointments.status', GlobalsConst::COMPLETED)
                    ->groupBy(DB::raw('DAYNAME(appointments.date)'))->get();
                //***************************//
                $AppointmentsFees = DB::table('appointments')
                    ->select(DB::raw('SUM(appointments.paid_fee) AS total_fee'), DB::raw('COUNT(appointments.id) AS totalAppointments'), DB::raw('appointments.status'))
                    ->join('patients', 'patients.id', '=', 'appointments.patient_id')
                    ->where('patients.company_id', $companyId)
                    ->groupBy(DB::raw('appointments.status'))->get();
                $dataSetDays = array();
                $dataSetTotalPatients = array();
                $dataSetFee = array();
                $dataSetAppointments = array();
                $dataSetStatus = array();
                $count = 0;
                $count1 = 0;
                $count2 = 0;
                //***************************//
                $Fees = DB::table('appointments')
                    ->select(DB::raw('SUM(appointments.paid_fee) AS total_recieved'))
                    ->join('patients', 'patients.id', '=', 'appointments.patient_id')
                    ->where('patients.company_id', $companyId)
                    ->where('appointments.status', GlobalsConst::COMPLETED)->first();
                $dataSetTotalRecieved = array();

                //*****************************//
//                foreach ($Fees as $Fee) {
//                    $dataSetTotalRecieved['total_recieved'][$count] = $Fee->total_recieved;
//                    $count++;
//                }
                //*****************************//
                foreach ($PaitentsData as $Paitent) {
                    $dataSetDays['days'][$count1] = $Paitent->pDay;
                    $dataSetTotalPatients['totalPatients'][$count] = $Paitent->totalPatients;
                    $count++;
                }

                //**/*************************//
                foreach ($AppointmentsFees as $AppointmentsFee) {
                    $dataSetFee['total_fee'][$count] = $AppointmentsFee->total_fee;
                    $dataSetAppointments['totalAppointments'][$count] = $AppointmentsFee->totalAppointments;
                    $dataSetStatus['status'][$count2] = $AppointmentsFee->status;
                    $count++;
                }
                //**/*************************//
                $totalPatients = json_encode($dataSetTotalPatients);
                $days = json_encode($dataSetDays);
                $total_fee = json_encode($dataSetFee);
                $appointments = json_encode($dataSetAppointments);
                $status = json_encode($dataSetStatus);
                $totalRecieved = ($Fees->total_recieved != null) ? $Fees->total_recieved : 0;
                //**/*************************//
                return View::make('dashboards.admin', compact('totalPatients', "days", 'total_fee', 'appointments', 'status', 'totalRecieved'));
            case GlobalsConst::EMPLOYEE:
                return View::make('dashboards.employee', compact('appointments', 'dataSet', '', '', ''));
            default:
                echo 'default';
        }
    }
}