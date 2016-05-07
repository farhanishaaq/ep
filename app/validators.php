<?php

/**
 * File Used to create Custom Validate Rules for laravel forms
 * @author: Waqas Ahmad
 */

/**
 * validator for image size validation by calling extend function of Validator Class
 * @param string : Custom validator name
 * @param clousre fucntion: @attribute = Input element, $tmpPath = temp path of uplaoded file, $parameters = passed params
 * @author: Waqas Ahmad
 *
 */
Validator::extend('image_size', function ($attribute, $tmpPath, $parameters) {

    if (function_exists('getimagesize')) {
        $file = Input::file($attribute);
        $image_info = getimagesize($file);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        if ($image_width == $parameters[0] && (!empty($parameters[1]) ? $image_height == $parameters[1] : true)) {
            return true;
        } else {
            return false;
        }
    }
});


Validator::extend('min_image_size', function ($attribute, $tmpPath, $parameters) {

    if (function_exists('getimagesize')) {
        $file = Input::file($attribute);
        $image_info = getimagesize($file);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        if ($image_width >= $parameters[0] && (!empty($parameters[1]) ? $image_height >= $parameters[1] : true)) {
            return true;
        } else {
            return false;
        }
    }
});

Validator::extend('file_type', function ($attribute, $tmpPath, $parameters) {

    $file = Input::file($attribute);
    $ext = implode(array_slice(explode(".", $file->getClientOriginalName()), -1, 1), ".");
    $mime_type = mime_content_type($file->getRealPath());

    if (($mime_type == 'application/zip' && $ext == 'docx') || ($mime_type == 'text/plain' && $ext == 'txt') || ($mime_type == 'application/msword' && $ext == 'doc') || ($mime_type == 'application/pdf' && $ext == 'pdf') || ($mime_type == 'audio/mpeg' && $ext == 'mp3')) {
        return true;
    } else {
        return false;
    }
});

Validator::extend('allow_file_type', function ($attribute, $tmpPath, $parameters) {
    $file = Input::file($attribute);
    $fileName = $file->getClientOriginalName();
    $extStr = pathinfo($fileName, PATHINFO_EXTENSION);
    $ext = strtolower($extStr);
    if (!in_array($ext, $parameters)) {
        return false;
    } else {
        return true;
    }
});

Validator::extend('is_valid_num', function ($attribute, $tmpPath, $parameters) {
    $atrb = trim(str_replace(range(0, 9), '', $attribute));
    $input = Input::all();
    $expr3 = '/^[0-9]{3}$/';
    $expr4 = '/^[0-9]{4}$/';
    if ((!empty($input[$atrb]) && preg_match($expr3, $input[$atrb])) && (!empty($input[$atrb . '1']) && preg_match($expr3, $input[$atrb . '1'])) && (!empty($input[$atrb . '2']) && preg_match($expr4, $input[$atrb . '2']))) {
        return true;
    } else {
        return false;
    }
});
/**
 * This validator allows only Alpha charactors and (-),('),(,) and (&).
 * This validator is used for validating organization name.
 */
Validator::extend('org_name_validator', function ($attribute, $value) {
    return preg_match("/^[\pL\s\-',&]+$/u", $value);
});
/**
 * This validator allows only Alpha charactors and Apostrophe(').
 * This validator is used for validating user names.
 */
Validator::extend('name_validator', function ($attribute, $value) {
    return preg_match("/^[\pL\s\']+$/u", $value);
});
Validator::extend('alpha_spaces', function ($attribute, $value) {
    return preg_match('/^[\pL\s\-]+$/u', $value);
});

Validator::extend('alpha_num_spaces', function ($attribute, $value) {
    return preg_match('/^([a-z0-9\s\-])+$/i', $value);
});
Validator::extend('match_password', function ($attribute, $value) {
    if (preg_match('/\d/', $value) == false || preg_match('/[A-Z]/', $value) == false || preg_match('/[a-z]/', $value) == false) {
        return false;
    } else {
        return true;
    }
});

Validator::extend('end_date_wrt_start_date', function ($attribute, $value) {
    $input = Input::all();
//            if (strtotime($input['end_date']) < strtotime(date('m/d/Y'))) {
    if (strtotime($input['end_date']) < strtotime($input['start_date'])) {
        return false;
    } else {
        return true;
    }
});

Validator::extend('webex_meeting_validator', function ($attribute, $value) {
    $input = Input::all();
    if (($input['event_type'] === 'Virtual Conference' ||
            $input['event_type'] === 'Webinar' ||
            $input['event_type'] === 'Roundable') && ($input['webex_meeting_id'] === '' || $input['webex_meeting_id'] === null)
    ) {
        return false;
    } else {
        return true;
    }
});
Validator::extend('webex_member_link_validator', function ($attribute, $value) {
    $input = Input::all();
    if (($input['event_type'] === 'Virtual Conference' ||
            $input['event_type'] === 'Webinar' ||
            $input['event_type'] === 'Roundable') && ($input['member_link'] === '' || $input['member_link'] === null)
    ) {
        return false;
    } else {
        return true;
    }
});
Validator::extend('webex_panalist_link_validator', function ($attribute, $value) {
    $input = Input::all();
    if (($input['event_type'] === 'Virtual Conference' ||
            $input['event_type'] === 'Webinar' ||
            $input['event_type'] === 'Roundable') && ($input['panalist_link'] === '' || $input['panalist_link'] === null)
    ) {
        return false;
    } else {
        return true;
    }
});

Validator::extend('webex_link_type_validator', function ($attribute, $value) {
    $input = Input::all();
    // var_dump($input['link_type']);die(' LLL');
    // if (($input['event_type'] === 'Private') &&  ($input['link_type'][0] === '' || $input['link_type'][0] === null || $input['link_type'][0] == 'Select') ) {
    if (($input['event_type'] === 'Private') && ($input['link_type'] === '' || $input['link_type'] === null || $input['link_type'] == 'Select')) {
        return false;
    } else {
        return true;
    }
});

Validator::extend('webex_link_validator', function ($attribute, $value) {
    $input = Input::all();
    // if (($input['event_type'] === 'Private') &&  ($input['link'][0] === '' || $input['link'][0] === null) ) {
    if (($input['event_type'] === 'Private') && ($input['link'] === '' || $input['link'] === null)) {
        return false;
    } else {
        return true;
    }
});

Validator::extend('duration', function ($attribute, $value) {
    $minutsIn24Hours = (float)(24 * 60);

    $startTime = Input::get('start_time');
    $endTime = Input::get('end_time');

    $sTimeHourPart = intval(substr($startTime, 0, 2));
    $sTimeMintPart = intval(substr($startTime, 3, 2));

    $eTimeHourPart = intval(substr($endTime, 0, 2));
    $eTimeMintPart = intval(substr($endTime, 3, 2));

    if (!($sTimeHourPart < 1 || $sTimeHourPart > 12) &&
        !($sTimeMintPart < 0 || $sTimeMintPart > 59) &&
        !($eTimeHourPart < 1 || $eTimeHourPart > 12) &&
        !($eTimeMintPart < 0 || $eTimeMintPart > 59)
    ) {

        $startDateTimeStr = Input::get('start_date') . ' ' . Input::get('start_time') . ' ' . Input::get('start_time_ampm');
        $endDateTimeStr = Input::get('end_date') . ' ' . Input::get('end_time') . ' ' . Input::get('end_time_ampm');
        $input['duration'] = (AppUtility::getDurationIntoHours($startDateTimeStr, $endDateTimeStr) * 60); //minutes required into api
        $duration = (float)$input['duration'];
        if ($duration > $minutsIn24Hours) {
            return false;
        } else {
            return true;
        }
    }

});

Validator::extend('retreat_website_link_validator', function ($attribute, $value) {
    $input = Input::all();
    if (($input['event_type'] === 'Retreat') && ($input['retreat_website_link'] === '' || $input['retreat_website_link'] === null)) {
        return false;
    } else {
        return true;
    }
});

Validator::extend('my_url_validator', function ($attribute, $value) {
    // $req = '/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/';
    $req = '|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i';
    if (!filter_var($value, FILTER_VALIDATE_URL)) {
        // if(!preg_match($req, $value)){
        return false;
    } else {
        return true;
    }
});

Validator::extend('end_time_wrt_start_time', function ($attribute, $value) {
    $input = Input::all();
    $startDateTime = $input['start_date'] . ' ' . $input['start_time'] . ' ' . $input['start_time_ampm'];
    $endDateTime = $input['end_date'] . ' ' . $input['end_time'] . ' ' . $input['end_time_ampm'];
//    var_dump(date('H:s A',strtotime($input['end_time'].' '.$input['end_time_ampm'])) <= date('H:s A',strtotime($input['start_time'].' '.$input['start_time_ampm'])));die;
//            if (strtotime($input['end_date']) < strtotime(date('m/d/Y'))) {
    if (strtotime($endDateTime) <= strtotime($startDateTime)) {
        return false;
    } else {
        return true;
    }
});

Validator::extend('check_time_format', function ($attribute, $value) {
    $timeHourPart = intval(substr($value, 0, 2));
    $timeMintPart = intval(substr($value, 3, 2));

    if ($timeHourPart < 1 || $timeHourPart > 12) {
        // var_dump($timeHourPart);die('KK');
        return false;
    }
    if ($timeMintPart < 0 || $timeMintPart > 59) {
        return false;
    } else {
        return true;
    }
});

Validator::extend('community_required', function ($attribute, $value) {
    $input = Input::all();
    if ($input['event_type'] != 'Private' && $input['academy_id'] == '') {
        return false;
    } else {
        return true;
    }
});

Validator::extend('dial_instructions_required', function ($attribute, $value) {
    $input = Input::all();
    if ($input['event_type'] == 'Private' && $input['dial_instructions'] == '') {
        return false;
    } else {
        return true;
    }
});

Validator::extend('job_level_required', function ($attribute, $value) {
    $input = Input::all();
//            if (strtotime($input['end_date']) < strtotime(date('m/d/Y'))) {

    if ($input['event_type'] !== 'Private' && empty($input['job_level'])) {
        return false;
    } else {
        return true;
    }
});
Validator::extend('validate_unique', function ($attribute, $value, $parameters) {
    if (isset($parameters[2])) {
        $count = DB::table($parameters[0])->where($parameters[1], '=', $value)->where('status', '!=', 'Deleted')->where('id', '!=', $parameters[2])->count();
    } else {
        $count = DB::table($parameters[0])->where($parameters[1], '=', $value)->where('status', '!=', 'Deleted')->count();
    }
    if ($count > 0) {
        return false;
    }
    return true;
});

Validator::extend('title_unique', function ($attribute, $value, $parameters) {
    if (isset($parameters[2])) {
        $count = DB::table($parameters[0])->where($parameters[1], '=', $value)->whereNull('deleted_at')->where('id', '!=', $parameters[2])->count();
    } else {
        $count = DB::table($parameters[0])->where($parameters[1], '=', $value)->where('deleted_at')->count();
    }
    if ($count > 0) {
        return false;
    }
    return true;
});

Validator::extend('validate_end_date', function ($attribute, $value) {
    $input = Input::all();
    if ($input['status'] == 'Open Enrollment' && strtotime($input['end_date']) < strtotime(date('m/d/Y'))) {
        return false;
    } else {
        return true;
    }
});



/**
 * validator for Unique with multiple columns validation by calling extend function of Validator Class
 * @param string : Custom validator name
 * @param clousre fucntion: @attribute = Input element, $value = value of input
 * @author: Waqas Ahmad
 *
 */
Validator::extend('unique_with', function ($attribute, $value,$parameters) {
    die($attribute);
});
?>
