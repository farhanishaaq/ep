/**
 * Created by mrashid on 4/17/2016.
 */
window.MESSAGE_TYPE_SUCCESS = 'Success';
window.MESSAGE_TYPE_ERROR = 'Error';

function setRadioValInHidden(hiddenFieldId,clickedElement){
    //var nameSelector = 'rdo-'+hiddenFieldId;
    //var selectedRadioVal = $('[name="'+ nameSelector +'"]:checked').val();
    //console.log(clickedElement.attr('class'));

    var selectedRadio = clickedElement.children('input[type="radio"]');
    selectedRadio.prop('checked');
    var selectedRadioVal = selectedRadio.val();
    $('#'+hiddenFieldId).val(selectedRadioVal);
}

function showMsg(msg, msgType,fadeoutTime ){

    if ( typeof msgType == 'undefined' ) {
        msgType = '';
    }
    if ( typeof fadeoutTime == 'undefined' ) {
        fadeoutTime = 10000;
    }
    $('.userSuccMSG').html(msg);
    $('.userSuccMSG').css('display','block')
    switch (msgType){
        case window.MESSAGE_TYPE_SUCCESS:
            $('.userSuccMSG').css('background','#32a214')
            break;
        case window.MESSAGE_TYPE_ERROR:
            $('.userSuccMSG').css('background','#ff0000')
            break;
        default:
            break;
    }
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

/** goTo used to open the Link
 * @author Muhammad Rashid Hussain
 * @params url
 * return void(0) open link
 */
function goTo(url){
    window.location.href = url;
}

function leftPad(str,pad) {
    var str = "" + str;
    var ans = pad.substring(0, pad.length - str.length) + str;
    return ans;
}

//*******Script For Tabs responsiveness
$.fn.responsiveTabs = function() {
    this.addClass('responsive-tabs');
    this.append($('<span class="glyphicon glyphicon-triangle-bottom"></span>'));
    this.append($('<span class="glyphicon glyphicon-triangle-top"></span>'));

    this.on('click', 'li.active > a, span.glyphicon', function() {
        this.toggleClass('open');
    }.bind(this));

    this.on('click', 'li:not(.active) > a', function() {
        this.removeClass('open');
    }.bind(this));
};

/**
 * String.format | This function(behave like plugin) used to format the string as same as c# does
 * @access global
 * @return string formated
 */
String.format = function () {
    var s = arguments[0];
    for (var i = 0; i < arguments.length - 1; i++) {
        var reg = new RegExp("\\{" + i + "\\}", "gm");
        s = s.replace(reg, arguments[i + 1]);
    }
    return s;
}


/**
 * zeroPad | This function for zero padding on left side
 * @access global
 * @access int num
 * @access int places
 * @return string formated
 * @example:
 *      zeroPad(5, 2); // "05"
 *      zeroPad(5, 4); // "0005"
 */
function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
}


//checks if the element is valid url and create error label
function isUrl(element) {
    var value = element.val();
    var name = element.data('name');
    var pattern = /^$|^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    if (!pattern.test(value)) {
//        createErrorLabel("The '" + name + "'  field is not formatted correctly");
        return false;
    }
    else {
        return true;
    }
}