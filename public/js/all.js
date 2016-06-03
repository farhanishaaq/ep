/**
 * Created by mrashid on 4/17/2016.
 */

function setRadioValInHidden(hiddenFieldId,clickedElement){
    //var nameSelector = 'rdo-'+hiddenFieldId;
    //var selectedRadioVal = $('[name="'+ nameSelector +'"]:checked').val();
    //console.log(clickedElement.attr('class'));

    var selectedRadio = clickedElement.children('input[type="radio"]');
    selectedRadio.prop('checked');
    var selectedRadioVal = selectedRadio.val();
    $('#'+hiddenFieldId).val(selectedRadioVal);
}

function showMsg(msg, fadeoutTime ){

    if ( typeof fadeoutTime == 'undefined' ) {
        fadeoutTime = 10000;
    }
    $('.userSuccMSG').html(msg);
    $('.userSuccMSG').css('display','block');
    $('.userSuccMSG').css("top", 320 + "px");
    $('.userSuccMSG').css("left", (($(window).width()/2-$('.userSuccMSG').width()/2)-38) + "px");
    $('.userSuccMSG').fadeOut( fadeoutTime );
}

function exportMsg(msg){
    $('.userSuccMSG').html(msg);
    $('.userSuccMSG').css('display','block');
    $('.userSuccMSG').css("top", 320 + "px");
    $('.userSuccMSG').css("left", (($(window).width()/2-$('.userSuccMSG').width()/2)-38) + "px");
}
function hideExportMsg(){
    $('.userSuccMSG').delay(500).fadeOut("slow");
}

function goTo(url){
    window.location.href = url;
}