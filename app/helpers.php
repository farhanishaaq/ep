<?php
use App\Globals\GobalsConst;

/**
 * role_drop_down | This function is used to make role dropdown
 * @return mixed
 */
function role_drop_down(){
    $rolesData = GobalsConst::$ROLES;
    unset($rolesData[GobalsConst::ADMINISTRATOR]);
    $rolesData[""] = "Select Role";
    ksort($rolesData);
    return Form::select('role',$rolesData,Form::getValueAttribute('role', null),['id'=>"role",'required'=>'true']);
}

/**
 * branch_drop_down | This function is used to make branch dropdown
 * @return mixed
 */
function branch_drop_down(){
    $branchesData = GobalsConst::$BRANCHES;
    $branchesData[""] = "Select Branch";
    ksort($branchesData);
    return Form::select('branch',$branchesData,Form::getValueAttribute('branch', null),['id'=>"branch",'required'=>'true']);
}