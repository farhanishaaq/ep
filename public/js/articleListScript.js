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

    //Like Toggle Slected class
    $(document).ready(function(){
        $("#" +likeId).click(function(){
            $("#" + likeId).toggleClass("selectedClass");
        });
    });
    //$('#'+likeId).click(function(){
    //    $('#'+likeId).toggleClass("selectedClass");
    //});

    //Take LikeCount span Id for getting Existing Likes
    var setArticleId = "article_"+ $.trim(articleId);
    var existCount = $("#"+setArticleId).text();
    $(document).ready(function() {
        if ($("#" + likeId).hasClass("selectedClass"))
        {       existCount++;
        alert(existCount)
    }
        else{
            existCount--;
        alert(existCount)}
    });
    //
    //if(likeId && existCount)
    //{

        //$.ajax({
        //    type: 'post',
        //    url: 'likePerform',
        //    data: {
        //        like_id: likeId,
        //        like_data : existCount
        //    },
        //    success: function (response) {
        //        alert(response);
        //        if(response == "update")
        //            $('#likesCount').text(existCount);
        //        else
        //            alert("error");
        //    }
        //});
    //}
}



//--------------------------------------------------