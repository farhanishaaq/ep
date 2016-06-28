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
 * role_drop_down | This function is used to make role dropdown
 * @return mixed
 */
function user_type_drop_down(){
    $userTypeData = GlobalsConst::$USER_TYPES;
    switch (Auth::user()->user_type){
        case GlobalsConst::SUPER_ADMIN:
            break;
        case GlobalsConst::ADMIN:
            unset($userTypeData[GlobalsConst::SUPER_ADMIN]);
            unset($userTypeData[GlobalsConst::PATIENT]);
            unset($userTypeData[GlobalsConst::PORTAL_USER]);
            break;
        default:
            $userTypeData = [GlobalsConst::DOCTOR => GlobalsConst::DOCTOR ];
            break;
    }
    $userTypeData[""] = "Select User Type";
    ksort($userTypeData);
    return Form::select('user_type',$userTypeData, Form::getValueAttribute('user_type', null),['id'=>"user_type",'required'=>'true']);
}

/**
 * company_drop_down | This function is used to make company dropdown
 * @return mixed
 */
function company_drop_down(){
    $companiesData = Company::all();
    $companiesData[""] = "Select Company";
    ksort($companiesData);
    return Form::select('company_id',$companiesData,Form::getValueAttribute('company_id', null),['id'=>"Company",'required'=>'true']);
}

/**
 * @param null $companyId
 * @return mixed
 */
function business_unit_drop_down($companyId = null){
    if($companyId == null){
        $companyId = Auth::user()->company_id;
    }
    $businessUnitsData = Company::find($companyId)->businessUnits->lists('name','id');
    $businessUnitsData[""] = "Select Branch";
    ksort($businessUnitsData);
    return Form::select('business_unit_id',$businessUnitsData,Form::getValueAttribute('business_unit_id', Auth::user()->business_unit_id),['id'=>"branch",'required'=>'true']);
}

/**
 * country_drop_down | This function is used to make branch dropdown
 * @return mixed
 */
function country_drop_down(){
    $dataset = GlobalsConst::$COUNTRIES;
    $dataset[""] = "Select Country";
    ksort($dataset);
    return Form::select('country',$dataset,Form::getValueAttribute('country', null),['id'=>"country",'required'=>'true']);
}

/**
 * city_drop_down | This function is used to make branch dropdown
 * @return mixed
 */
function city_drop_down(){
    $dataset = DB::table('cities')->select('cities.id',DB::raw("CONCAT(cities.name,', ', states.name,', ', countries.name) AS full_city_name"))->join('states','states.id','=','cities.state_id')
        ->join('countries','countries.id','=','states.country_id')
        ->lists('full_city_name','id');

    $dataset[""] = "Select City";
    ksort($dataset);
    return Form::select('city_id',$dataset,Form::getValueAttribute('city_id', null),['id'=>"city_id"]);
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
<<<<<<< HEAD
 * get_appointment_status_name | This function is used to get appointment status name by status id
 * @return string
 */
function retrieve_date_for_input($inputName,$format='d-m-Y'){
    return Form::getValueAttribute($inputName, null) != null ? date($format, strtotime(Form::getValueAttribute($inputName, null) ) ): '';
=======
 * @param User|null $model
 * @return mixed
 */
function medical_specialty_drop_down(User $model = null){
    $selectedData = null;
    $doctorCategoryData = MedicalSpecialty::all()->lists('name', 'id');
//    $doctorCategoryData[""] = "Select Medical Specialties";
    ksort($doctorCategoryData);
    if($model == null){
        $selectedData = Form::getValueAttribute('medical_specialty_id', null);
    }else{
        if($model->doctor->medicalSpecialties){
            $selectedData = $model->doctor->medicalSpecialties->lists('id');
        }
    }
    return Form::select('medical_specialty_id[]',$doctorCategoryData, $selectedData,['id'=>"medical_specialty_id", 'multiple'=>true,]);
}


/**
 * @param User|null $model
 * @return mixed
 */
function qualifications_drop_down(User $model = null){
    $selectedData = null;
    $doctorCategoryData = Qualification::all()->lists('code', 'id');
//    $doctorCategoryData[""] = "Select Qualifications & Skills";
    ksort($doctorCategoryData);
    if($model==null){
        $selectedData = Form::getValueAttribute('qualification_id', null);
    }else{
        if($model->doctor->qualifications){
            $selectedData = $model->doctor->qualifications->lists('id');
        }
    }
    return Form::select('qualification_id[]',$doctorCategoryData, $selectedData,['id'=>"qualification_id", 'multiple'=>true]);
}

/**
 * @param $fileName
 * @return string
 */
function get_profile_photo_url($fileName){
    $fileUrl = asset('images/profile-dumy.png');

    $filePath = public_path(GlobalsConst::PROFILE_PHOTO_DIR.'/'.$fileName);

    if($fileName != '' && file_exists($filePath)){
        $fileUrl = asset(GlobalsConst::PROFILE_PHOTO_DIR.'/'.$fileName);
    }
    return $fileUrl;
}

/**
 * @param \Illuminate\Database\Eloquent\Collection|null $collection
 * @param string $col
 * @return string
 */
function get_collection_col_as_str(\Illuminate\Database\Eloquent\Collection $collection=null, $col='name'){
    if($collection != null){
        if($collection->count()){
            foreach($collection as $c){
                $arr[] = $c->{$col};
            }
            return join(', ', $arr);
        }
        else
            return '';
    }
    else
        return '';
}

function get_age_from_dob($dob){
    $age = (int)(date('Y') - date('Y',strtotime($dob)));
    return $age;
}

function get_display_date($date){
    return date('d-m-Y',strtotime($date));
>>>>>>> 49c7b4c09959875d6be4f4a233fe3876cf7648f8
}