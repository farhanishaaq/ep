<?php
/**
 * Created by PhpStorm.
 * User: mrashid
 * Date: 4/13/2016
 * Time: 8:01 PM
 */

namespace App\Globals;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class Ep {

    const CHECKED = "on";//frontend switch-button via using html-input(checkbox) providing 'on' that's why we use it

    /**
     * getSwitchButtonVal | This function is used to override the Switched-fancy-Button value, coz Switched-fancy-Button always return on on checked case,
     * @param string $inputVal
     * @param string $trueVal
     * @param string $falseVal
     * @return string
     */
    public static function  getSwitchButtonVal($inputVal,$trueVal="Yes",$falseVal="No"){

        if($inputVal === self::CHECKED){
            return $trueVal;
        }else{
            return $falseVal;
        }
    }

    /**
     * @return array
     */
    public static function getAllEpControllers(){
        $controllers = [];
        foreach (Route::getRoutes()->getRoutes() as $route)
        {
            $action = $route->getAction();
            if (array_key_exists('controller', $action))
            {
                // You can also use explode('@', $action['controller']); here
                // to separate the class name from the method
                $controllerArr = explode('@', $action['controller']) ;
                $controllers[] = $controllerArr[0] ;
            }
        }
        return array_unique($controllers);
    }

    public static function currentUser(){
        return \Auth::user();
    }

    public static function currentUserType(){
        return self::currentUser()->user_type;
    }

    public static function currentCompany(){
        return self::currentUser()->company;
    }

    public static function currentCompanyId(){
        return self::currentUser()->company_id;
    }

    public static function currentCompanyName(){
        return self::currentCompany()->name;
    }

    public static function currentBusinessUnit(){
        return self::currentUser()->businessUnit;
    }

    public static function currentBusinessUnitId(){
        return self::currentUser()->business_unit_id;
    }

    public static function currentBusinessUnitName(){
        return self::currentBusinessUnit()->name;
    }

    public static function currentEmployee(){
        return self::currentUser()->employee;
    }

    public static function currentEmployeeId(){
        return self::currentUser()->employee->id;
    }
} 