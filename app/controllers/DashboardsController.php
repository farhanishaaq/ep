<?php
use App\Globals\GlobalsConst;

class DashboardsController extends \BaseController
{


    public function showDashboard()
    {
        $roleId = 0;
        $userType = Auth::user()->user_type;
//		$roles = Auth::user()->roles;
//		if($user_types->count()){
//			foreach ($user_types as $t){
//				$roleId = $r->id;
//			}
//		}
        switch ($userType) {
            case GlobalsConst::SUPER_ADMIN:
                return View::make('dashboards.super_home');
            case GlobalsConst::ADMIN:
                return View::make('dashboards.admin');
            case GlobalsConst::EMPLOYEE:
                return View::make('dashboards.employee');
            default:
                echo 'default';
        }
    }
}