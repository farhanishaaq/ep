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
function hitLikes(likeId)
{
    var existCount = $('#likesCount').text();
    alert(existCount);
    //var existCount = parseInt(existNum);
    //var likeId = parseInt(takeId);
    $(document).ready(function(){
        if($("."+likeId).hasClass("selectedClass"))
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