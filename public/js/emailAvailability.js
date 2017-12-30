$(document).ready(function() {
    $('#city').select2({
        placeholder: 'Select City'

    });
});

function checkemail()
{
    var email=document.getElementById( "email" ).value;

    if(email)
    {
        $.ajax({
            type: 'post',
            url: 'checkEmail',
            data: {
                user_email:email
            },
            success: function (response) {
                $( '#email_status' ).html(response).addClass('errorMsg');
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
        $( '#email_status' ).html("Field is required").addClass('errorMsg');
        return false;
    }
}
function checkUserName()
{
    var userName =document.getElementById( "userName" ).value;

    if(userName)
    {
        $.ajax({
            type: 'post',
            url: 'checkUserName',
            data: {
                user_Name:userName,
            },
            success: function (response) {
                $( '#userName_status' ).html(response).addClass('errorMsg');
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
        $( '#userName_status' ).html("Field is required").addClass('errorMsg');
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

// Comment Status Approve Or Decline
function statusUpdate(patientId)
{
    if($('#'+patientId).prop('checked')) {
        var status = 'checked';
    }
    else {
        status = 'unchecked';
    }
    if(patientId)
    {
        $.ajax({
            type: 'post',
            url: 'updateComment',
            data: {
                comment_id:patientId,
                comment_action:status
            },
            success: function (response) {
                alert(response);
            }
        });
    }
}
// end Jquery of Comment

//likes add or remove zone
//Toggle Class
$(document).ready(function(){
    $("#articleLike").click(function() {
        $("#articleLike").toggleClass("selectedClass");
    });
});
//Update Likes
//function hitLikes(takeId)
function hitLikes(likeId)
{
    var existCount = $('#likesCount').text();
    //var existCount = parseInt(existNum);
    //var likeId = parseInt(takeId);
    $(document).ready(function(){
        if($("#articleLike").hasClass("selectedClass"))
            existCount++ ;

        else
            existCount--;
        });

    if(likeId)
    {
        $.ajax({
            type: 'post',
            url: 'likePerform',
            data: {
                like_id: likeId,
                like_data : existCount
            },
            success: function (response) {
                if(response == "update")
                    $('#likesCount').text(existCount);
                else
                alert("error");
            }
        });
    }
}

//--------------------------------------------------












