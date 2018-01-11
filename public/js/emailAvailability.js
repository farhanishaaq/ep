$(document).ready(function() {
    $('#city').select2({
        placeholder: 'Select City'

    });
});
//For Doctor Sign Up
$(document).ready(function() {
    $('#doctorCity').select2({
        placeholder: 'Select City'

    });
});

function checkemail(id)
{
    var email=document.getElementById(id ).value;

    if(email)
    {
        $.ajax({
            type: 'post',
            url: 'checkEmail',
            data: {
                user_email:email
            },
            success: function (response) {
                $( '#status_'+id ).html(response).addClass('errorMsg');
                if(response =="")
                {

                    return false;
                }
                else
                {

                    return false;
                }
            }
        });
    }
    else
    {
        $( '#status_'+id ).html("Field is required").addClass('errorMsg');
        return false;
    }
}
function checkUserName(id)
{
    var userName =document.getElementById(id).value;

    if(userName)
    {
        $.ajax({
            type: 'post',
            url: 'checkUserName',
            data: {
                user_Name:userName
            },
            success: function (response) {
                $( '#status_'+id ).html(response).addClass('errorMsg');
                if(response == "")
                {

                    return false;
                }
                else
                {
                    return false;
                }
            }
        });
    }
    else
    {
        $( '#status_'+id ).html("Field is required").addClass('errorMsg');
        return false;
    }
}
//ON Submit Exeption Handler

    function checkError() {
        var email = document.getElementById('email_status').innerHTML;
        var userName = document.getElementById('userName_status').innerHTML;
        if (email == null || email == 0 || email == "0") {
        if (userName == null || userName == 0 || userName == "0") {
            document.form.submit();
                }
            }
        else
            return false;
    }









