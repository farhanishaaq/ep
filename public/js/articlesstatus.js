function articlestatus(patientId)
{
    if($('#'+patientId).prop('checked')) {
        var status = 1;
    }
    else {
        status = 0;
    }
    if(patientId)
    {
        $.ajax({
            type: 'post',
            url: 'updateArticles',
            data: {
                id:patientId,
                article_action:status
            },
            success: function (response) {
                alert(response);
            }
        });
    }
}