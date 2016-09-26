<?php
use App\Globals\GlobalsConst;

/**
 * role_drop_down | This function is used to make role dropdown
 * @return mixed
 */
function role_drop_down(){
    /*$rolesData = GlobalsConst::$ROLES;
    unset($rolesData[GlobalsConst::ADMINISTRATOR]);
    $rolesData[""] = "Select Role";
    ksort($rolesData);
    return Form::select('role',$rolesData,Form::getValueAttribute('role', null),['id'=>"role",'required'=>'true']);*/
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
//            unset($userTypeData[GlobalsConst::PATIENT]);
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
    return Form::select('business_unit_id',$businessUnitsData,Form::getValueAttribute('business_unit_id', Auth::user()->business_unit_id),['id'=>"business_unit_id",'required'=>'true']);
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
function city_drop_down($params=['name'=>'city_id']){
    $name = $params['name'];
    $dataset = DB::table('cities')->select('cities.id',DB::raw("CONCAT(cities.name,', ', states.name,', ', countries.name) AS full_city_name"))->join('states','states.id','=','cities.state_id')
        ->join('countries','countries.id','=','states.country_id')
        ->lists('full_city_name','id');

    $dataset[""] = "Select City";
    ksort($dataset);
    return Form::select($name,$dataset,Form::getValueAttribute('city_id', null),['id'=>$name]);
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

function retrieve_date_for_input($inputName,$format='d-m-Y'){
    return Form::getValueAttribute($inputName, null) != null ? date($format, strtotime(Form::getValueAttribute($inputName, null) ) ): '';
}

/**
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
        if($model->doctor){
            if($model->doctor->medicalSpecialties){
                $selectedData = $model->doctor->medicalSpecialties->lists('id');
            }
        }else{
            $selectedData = Form::getValueAttribute('medical_specialty_id', null);
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
        if($model->doctor){
            if($model->doctor->qualifications){
                $selectedData = $model->doctor->qualifications->lists('id');
            }
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

    $filePath = public_path(GlobalsConst::UPLOADED_DATA_DIR.'/'.$fileName);

    if($fileName != '' && file_exists($filePath)){
        $fileUrl = asset(GlobalsConst::UPLOADED_DATA_DIR.'/'.$fileName);
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
}

function get_doctor_name($docId){

}

function current_user(){
    return \App\Globals\Ep::currentUser();
}

function current_user_type(){
    return \App\Globals\Ep::currentUserType();
}

function current_company(){
    return \App\Globals\Ep::currentCompany();
}

function current_company_id(){
    return \App\Globals\Ep::currentCompanyId();
}

function current_business_unit(){
    return \App\Globals\Ep::currentBusinessUnit();
}

function current_business_unit_id(){
    return \App\Globals\Ep::currentBusinessUnitId();
}

function current_employee(){
    return \App\Globals\Ep::currentEmployee();
}

function current_employee_id(){
    return \App\Globals\Ep::currentEmployeeId();
}

function is_dr_duty_days_exists($drId){
    return DutyDay::where('doctor_id','=',$drId)->count();
}

function make_doctor_drop_down($doctors,$selectedVal=null){
    $html = '<select id="doctor_id" name="doctor_id" required="true">';
    $html .= '<option value="">Select Doctor</option>';
    foreach ($doctors as $d){
        if($selectedVal != null && $selectedVal == $d->id){
            $selected = 'selected="selected"';
        }else{
            $selected = '';
        }
        $html .= '<option value="'.$d->id.'" max-fee="'. $d->max_fee.'" '.$selected.' >'.$d->full_name.'</option>';
    }
    $html .= '</select>';
    return $html;
//    {{ Form::select('doctor_id', ["" => 'Select Doctor'] + $doctors->lists('full_name', 'id'), null, ['required' => 'true', 'id' => 'doctor_id'] ); }}
}


function make_company_type_drop_down(){
    $dataset = GlobalsConst::$COMPANY_TYPES;
    $dataset[""] = "Select Type";
//    ksort($dataset);
    return Form::select('company_type',$dataset,Form::getValueAttribute('company_type', null),['id'=>"company_type",'required'=>'true']);
}

/**
 * follow_up_prescription__drop_down | This function is used to show patient prescription detail
 * @return mixed
 */
function follow_up_prescription_drop_down($id)
{
    $patientData = Prescription::fetchPrescriptionOfPatient($id);
    $patientData[""] = "Select Prescription";
    ksort($patientData);
    return Form::select('Prescription_id',$patientData,Form::getValueAttribute('Prescription_id', null),['id'=>"follow_up_pres"]);
}

/**
 * dosage_form_drop_down | This function is used to draw days select  box
 * @return mixed
 */
function dosage_form_drop_down($i=0)
{

    $dataset = GlobalsConst::$DOSAGE_FORMS;
    $dataset[""] = "Select Dosage Form";
    ksort($dataset);

    $attrs = ['id'=>"dosage_form", 'required'=>'true'];
    if($i == -1){
        $attrs = ['id'=>"dosage_form",];
    }
    return Form::select('dosage_form['.$i.']',$dataset,Form::getValueAttribute('dosage_form', null),$attrs);
}

/**
 * dosage_form_drop_down | This function is used to draw days select  box
 * @return mixed
 */

function dosage_strength_form_drop_down($i=0)
{
    $dataset = GlobalsConst::$DOSAGE_STRENGTHS;
    $dataset[""] = "Strength Unit";
    ksort($dataset);
//
    if($i==-1){

        $required = "";
        return Form::select('dosage_strength['.$i.']',$dataset,Form::getValueAttribute('dosage_strength', null),['id'=>"dosage_strength", $required,'class'=>'fL']);

    }else{

        return Form::select('dosage_strength['.$i.']',$dataset,Form::getValueAttribute('dosage_strength', null),['id'=>"dosage_strength", 'required'=>'true','class'=>'fL']);
    }


}

function medicine_drop_down($i=0)
{
    //$dataset = GlobalsConst::$MEDICINE;
    $dataset = Medicine::all()->lists('name','id');
    $dataset[""] = "Select Medicine";
    ksort($dataset);
    if($i==-1){

        $required = "";
        return Form::select('medicine_id['.$i.']',$dataset,Form::getValueAttribute('medicine_id', null),['id'=>"medicine_id", $required,'class'=>'fL']);

    }else{

        return Form::select('medicine_id['.$i.']',$dataset,Form::getValueAttribute('medicine_id', null),['id'=>"medicine_id", 'required'=>'true','class'=>'fL']);

    }

}


/**
 * @param int $i
 * @return mixed
 */
function frequency_drop_down($i=0){
    $dataset = GlobalsConst::$USAGE_FREQUENCIES;
//    $dataset[""] = "Select Frequencies";
    ksort($dataset);
    $selectedData = Form::getValueAttribute('medical_specialty_id', null);
    return Form::select('frequencies_dd['.$i.']',$dataset, $selectedData,['id'=>"frequencies_dd", 'multiple'=>true,]);


}

/**
 * @param int $i
 * @return mixed
 */
function usage_type_drop_down($i=0){
    $dataset = GlobalsConst::$USAGE_TYPES;
    $dataset[""] = "Usage Type";
    ksort($dataset);
    $selectedData = Form::getValueAttribute('medical_specialty_id', null);
    return Form::select('usage_type['.$i.']',$dataset, $selectedData,['id'=>"usage_type",'required'=>'true']);
}

/**
 * @param int $i
 * @return mixed
 */
function dosage_qty_unit_drop_down($i=0){
    $dataset = GlobalsConst::$DOSE_QTY_UNIT;
    $dataset[""] = "Qty Unit";
    ksort($dataset);
    $selectedData = Form::getValueAttribute('medical_specialty_id', null);
    return Form::select('quantity_unit['.$i.']',$dataset, $selectedData,['id'=>"quantity_unit",]);
}
