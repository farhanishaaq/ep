<?php
use App\Globals\GlobalsConst;

/**
 * role_drop_down | This function is used to make role dropdown
 * @return mixed
 */
function role_drop_down(){
    $rolesData = GlobalsConst::$ROLES;
    unset($rolesData[GlobalsConst::ADMINISTRATOR]);
    $rolesData[""] = "Select Role";
    ksort($rolesData);
    return Form::select('role',$rolesData,Form::getValueAttribute('role', null),['id'=>"role",'required'=>'true']);
}


/**
 * branch_drop_down | This function is used to make branch dropdown
 * @return mixed
 */
function branch_drop_down(){
    $branchesData = GlobalsConst::$BRANCHES;
    $branchesData[""] = "Select Branch";
    ksort($branchesData);
    return Form::select('branch',$branchesData,Form::getValueAttribute('branch', null),['id'=>"branch",'required'=>'true']);
}

/**
 * branch_drop_down | This function is used to make branch dropdown
 * @return mixed
 */
function country_drop_down(){
    $dataset = GlobalsConst::$COUNTRIES;
    $dataset[""] = "Select Country";
    ksort($dataset);
    return Form::select('country',$dataset,Form::getValueAttribute('country', null),['id'=>"country",'required'=>'true']);
}


/**
 * radio_btn_group | This function is used to make radio button as a selection boxes
 * @param array $rdoVals
 * @param string $fieldName
 * @return string
 * @usageExample radio_btn_group(array( 'Male' => 'Male', 'None' => '' , 'Female' => 'Female' ),'gender')
 */
function radio_btn_group($rdoVals,$fieldName)
{
    $selectedVal = Form::getValueAttribute($fieldName, null);
    $html = '';
    $html .= '<div class="btn-group btn-toggle" data-toggle="buttons">
                    <input type="hidden" id="' . $fieldName . '" name="' . $fieldName . '" value="'.$selectedVal.'">';
    foreach ($rdoVals as $k => $v) {
        $checked = '';
        $active = '';

        if($v == $selectedVal)
        {
            $active = 'active ';
            $checked = 'checked="checked"';
        }
        $html .= '<label class="btn btn-primary-2 '. $active .' '.$fieldName.'">
                    <input type="radio" name="rdo-' . $fieldName . '" value="' . $v . '" '. $checked .'> ' . $k . '
                  </label>';
    }
    $html .= '</div>';
    $html .= '<span id="error'.ucfirst($fieldName).'" class="field-validation-msg"></span>';
    return $html;
}


/**
 * switch_btn_group | This function used to make switch button
 * @param array $params
 * @return string
 * @usageExample switch_btn_group(['fieldName'=>'status','onVal'=>'Active','offVal'=>'Inactive'])
 */
function switch_btn_group(array $params)
{
    $html = '';
    $checked = '';
    $fieldName = $params['fieldName'] ? $params['fieldName'] : '';
    $onVal = $params['onVal'] ? $params['onVal'] : '';
    $offVal = $params['offVal'] ? $params['offVal'] : '';
    $statusVal = Form::getValueAttribute($fieldName, null);
    if($statusVal == 'on' || 'Active'){
        $checked = 'checked="checked"';
    }
    $html .= '<label class="switch switch-green">
                    <input type="checkbox" id="'.$fieldName.'" name="'.$fieldName.'" '.$checked.' class="switch-input" >
                    <span class="switch-label" data-on="'.$onVal.'" data-off="'.$offVal.'"></span>
                    <span class="switch-handle"></span>
              </label>
              <span id="errorStatus" class="field-validation-msg"></span>';
    return $html;
}


/**
 * days_drop_down | This function is used to draw days select  box
 * @return mixed
 */
function days_drop_down()
{
    $dataset = GlobalsConst::$DAYS;
    $dataset[""] = "Select Branch";
//    ksort($dataset);
    return Form::select('day',$dataset,Form::getValueAttribute('day', null),['id'=>"day",'required'=>'true']);
}


/**
 * get_appointment_status_name | This function is used to get appointment status name by status id
 * @return string
 */
function get_appointment_status_name($appointmentStatusId){
    return isset(GlobalsConst::$APPOINTMENT_STATUSES[$appointmentStatusId]) ? GlobalsConst::$APPOINTMENT_STATUSES[$appointmentStatusId] : '';
}

/**
 * get_appointment_status_name | This function is used to get appointment status name by status id
 * @return string
 */
function retrieve_date_for_input($inputName,$format='d-m-Y'){
    return Form::getValueAttribute($inputName, null) != null ? date($format, strtotime(Form::getValueAttribute($inputName, null) ) ): '';
}