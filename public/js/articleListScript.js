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
function hitLikes(likeId,articleId)
{
        var setLikeId = "like_" +likeId ;
        $('#'+setLikeId).toggleClass("selectedClass");

    //Take LikeCount span Id for getting Existing Likes
    var setArticleId = "article_"+ $.trim(articleId);
    var existCount = $("#"+setArticleId).text();
        if ($("#like_" + likeId).hasClass("selectedClass"))
               existCount++;
        else
            existCount--;

    if(likeId)
    {
        $.ajax({
            type: 'POST',
            url: 'likePerform',
            data: {
                like_id: likeId,
                like_data : existCount
            },
            success: function (response) {
                if(response == "update")
                    $('#'+setArticleId).html(existCount);
                else
                    alert("error hei dalne mein value");
            }
        });
    }
}



//--------------------------------------------------