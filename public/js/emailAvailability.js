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
        var email = document.getElementById('status_email').innerHTML;
        var userName = document.getElementById('status_userName').innerHTML;
        if (email == null || email == 0 || email == "0") {
        if (userName == null || userName == 0 || userName == "0") {
            document.form.submit();
                }
            }
        else
            return false;
    }

function checkDoctorError() {
        var email = document.getElementById('status_doctorEmail').innerHTML;
        var userName = document.getElementById('status_doctorUserName').innerHTML;
        if (email == null || email == 0 || email == "0") {
        if (userName == null || userName == 0 || userName == "0") {
            document.form.submit();
                }
            }
        else
            return false;
    }

//    Check Old Password
function checkOldPassword(id)
{

    var oldPassword =document.getElementById(id).value;

    if(oldPassword)
    {
        $.ajax({
            type: 'get',
            url: 'checkOldPassword',
            data: {
                oldPassword:oldPassword
            },
            success: function (response) {

                if(response == "Match")
                {
                    $( '#'+id).css({"border": "2px solid Green"});
                    $( '#status_'+id ).html("");
                    return true;
                }
                else
                {
                    $( '#'+id).css({"border": "1px solid red"})
                    $( '#status_'+id ).html("Wrong Password").addClass('errorMsg');
                    return false;
                }
            }
        });
    }
    else
    {
        $( '#status_'+id ).html("Field is Required").addClass('errorMsg');
        return false;
    }
}
//Confirm password

function checkConfirmPassword(id) {

    var newPassword = document.getElementById("newPassword").value;
    var confirmPassword = document.getElementById(id).value;
    if (newPassword !=  '') {
        if (newPassword == confirmPassword) {
            $("#newPassword").css({"border": "2px solid Green"});
            $("#confirmPassword").css({"border": "2px solid Green"});
            $('#status_' + id).html("");
            return true;
        }
        else {
            $("#newPassword").css({"border": "1px solid red"});
            $("#confirmPassword").css({"border": "1px solid red"});
            $('#status_' + id).html("New Password Not Match").addClass('errorMsg');
            return false;
        }
    }
    else
        {
            $('#status_' + id).html("Field Is Requeired").addClass('errorMsg');
            return false;
        }
}







