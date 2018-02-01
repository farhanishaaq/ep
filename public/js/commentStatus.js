/**
 * Created by bc140202163 on 1/10/2018.
 */
function statusUpdate(patientId) {
    if ($('#' + patientId).prop('checked')) {
        var status = 'checked';
    }
    else {
        status = 'unchecked';
    }
    if (patientId) {
        $.ajax({
            type: 'post',
            url: 'updateComment',
            data: {
                comment_id: patientId,
                comment_action: status
            },
            success: function (response) {
            }
        });
    }
}

function doctorStatusUpdate(doctorId) {

    if($('#'+doctorId).prop('checked')) {
        var status = 'checked';
    }
    else {
        status = 'unchecked';
    }
    if(doctorId)
    {
        $.ajax({
            type: 'post',
            url: 'updateDoctorStatus',
            data: {
                user_id:doctorId,
                doctor_action:status
            },
            success: function (response) {

            }
        });
    }
}