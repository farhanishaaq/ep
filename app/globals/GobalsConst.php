<?php
/**
 * Created by PhpStorm.
 * User: mrashid
 * Date: 4/13/2016
 * Time: 8:11 PM
 */

namespace App\Globals;


class GobalsConst {
    const STATUS_ON = "Active";
    const STATUS_OFF = "Inactive";
    const MALE = "Male";
    const FEMALE = "Female";
    const FORM_CREATE = 1;
    const FORM_EDIT = 2;


    //Roles
    const ADMINISTRATOR = "Administrator";
    public static $ROLES = ['Administrator'=>'Administrator',
                            'Doctor'=>'Doctor',
                            'Accountant'=>'Accountant',
                            'Receptionist'=>'Receptionist',
                            'Lab Manager'=>'Lab Manager'];

    //Branches
    const DHA = "DHA";
    const GULBERG = "Gulberg";
    const CANAL_VIEW = "Canal View";
    const GARDEN_TOWN = "Garden Town";
    const JOHAR_TOWN = "Johar Town";
    public static $BRANCHES = ['DHA'=>'DHA',
        'Gulberg'=>'Gulberg',
        'Canal View'=>'Canal View',
        'Garden Town'=>'Garden Town',
        'Johar Town'=>'Johar Town'];
}