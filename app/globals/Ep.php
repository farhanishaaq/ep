<?php
/**
 * Created by PhpStorm.
 * User: mrashid
 * Date: 4/13/2016
 * Time: 8:01 PM
 */

namespace App\Globals;


use Illuminate\Support\Facades\Input;

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
} 