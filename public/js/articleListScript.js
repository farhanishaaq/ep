/**
 * Created by bc140202163 on 1/2/2018.
 */
//10 length
$(document).ready(function(){
    var maxLength = 100;
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
//function hitLikes(takeId)
//function hitLikes(likeId,articleId)
function hitLikes(userId,articleId,patientId)
{
     var actionDo;
    var setLikeId = "like_" +userId ;
    $('#'+setLikeId).toggleClass("selectedClass");

    //Take LikeCount span Id for getting Existing Likes

    var setArticleId = $.trim(articleId);
    //var setArticleId = "article_"+ $.trim(articleId);
    //var existCount = $("#"+setArticleId).text();

        if ($("#like_" + likeId).hasClass("selectedClass"))
               actionDo = "add";
        else
             actionDo = "sub";
    if(likeId)
    {
        alert(likeId)
        $.ajax({
            type: 'POST',
            url: 'likePerform',
            data: {
                like_id: userId,
                like_data : actionDo,
                article_id : setArticleId,
                patient_id : patientId
            },
            success: function (response) {
                if(response == "update")
                    $(setArticleId).html(response);
                else
                    alert("error hei dalne mein value");
            }
        });
    }
}



//--------------------------------------------------