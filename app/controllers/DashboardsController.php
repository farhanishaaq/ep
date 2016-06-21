<?php
use App\Globals\GlobalsConst;
class DashboardsController extends \BaseController {


	public function showDashboard(){
		$roleId = 0;
		$roles = Auth::user()->roles;
		if($roles->count()){
			foreach ($roles as $r){
				$roleId = $r->id;
			}
		}
		switch($roleId){
			case GlobalsConst::SUPER_ADMIN_ID:
				return View::make('dashboards.super_home');
			case GlobalsConst::COMPANY_ADMIN_ID:
				return View::make('dashboards.super_home');
			default:
				echo 'default';
		}
	}
}