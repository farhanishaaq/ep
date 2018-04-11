/**
 * Created by bc140202163 on 1/2/2018.
 */

path = "/ep/public/";
//10 length
$(document).ready(function(){
    var maxLength = 200;
    $(".show-read-more").each(function(){
        var myStr = $(this).text();
        if($.trim(myStr).length > maxLength){
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append('....');
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function(){
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });
});

//Update Likes
function hitLikes(articleId,patientId)
{
    var actionDo;
    var setTotalLikes = "totalLike_"+ $.trim(articleId);
    var setlikeId = "like_"+ $.trim(articleId);
    $('#'+setlikeId).toggleClass("selectedClass");

        if ($("#"+ setlikeId).hasClass("selectedClass"))
               actionDo = "add";
        else
             actionDo = "sub";
    if(articleId)

    {

        $.ajax({
            type: 'POST',
            url: path+'likePerform',
            data: {
                like_data : actionDo,
                article_id : articleId,
                patient_id : patientId
            },
            dataType : "json",
            success: function (response) {
                    $('#'+setTotalLikes).html(response[0].article_likes);
            }
        });
    }
}

//--------------------------------------------------


$("#imageCheck").click(function () {
//                $("#newImage").toggleClass("addImage");
    if($("#newImage").hasClass("noneClass")) {
        $("#newImage").removeClass("noneClass");
        $("#newImage").css("display",'block');
        $("#existImage").slideUp("slow");
        $("#imageCheck").val("Chose Old Image");

    }
    else {
        $("#newImage").addClass("noneClass");
        $("#newImage").css("display",'none');
        $("#existImage").slideDown("slow");
        $("#imageCheck").val("Chose New Image");
    }

});
//-------------------
//Submit Form and reset field
//function submitForm() {
//    $("#commentForm")[0].reset();
//}