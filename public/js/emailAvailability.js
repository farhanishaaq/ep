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
                response = $.trim(response);
                if(response === "Match")
                {

                    $( '#'+id).css({"border": "2px solid Green"});
                    $( '#status_'+id ).html("");
                    return true;
                }
                else
                {
                    $( '#success').css("display","none");
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

    var newPassword = $("#newPassword").val();
    var confirmPassword = $("#confirmPassword").val();
    var input = $("#"+id).val();
    var length = input.length;
    var error = "";
    if (input !=  "" && newPassword != "") {
        if (newPassword.length > "5") {
            var newPasswordStatus = "fine";
            $("#newPassword").css({"border": "2px solid Green"});
        }
        if (length > "5" && newPassword.length > "5") {
            if (confirmPassword != '') {
                if (newPassword === confirmPassword) {
                    $("#newPassword").css({"border": "2px solid Green"});
                    $("#confirmPassword").css({"border": "2px solid Green"});
                    $('#status_' + id).html("");
                    return true;
                }
                else{
                    error = "New Password Not Match";
                    newPasswordStatus = "No";
                }
            }
        }
        else
            error = "Min length 6";
    }
    else
        error = "Field is Required";
  if(error != ""){
      if(newPasswordStatus != "fine")
      $("#newPassword").css({"border": "1px solid red"});
      $("#confirmPassword").css({"border": "1px solid red"});
      $('#status_confirmPassword').html(error).addClass('errorMsg');
      $( '#success').css("display","none");
      return false;
  }
}

function checkPasswordError() {
    var oldPassword = document.getElementById('status_oldPassword').innerHTML;
    var newConfirmPassword = document.getElementById('status_confirmPassword').innerHTML;
    if (oldPassword == null || oldPassword == 0 || oldPassword == "0") {
        if (newConfirmPassword == null || newConfirmPassword == 0 || newConfirmPassword == "0") {
            document.form.submit();
        }
        else
            return false;
    }
    else
        return false;
}






