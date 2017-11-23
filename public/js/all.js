/**
 * Created by mrashid on 4/17/2016.
 */
Array.prototype.max = function() {
    return Math.max.apply(null, this);
};

Array.prototype.min = function() {
    return Math.min.apply(null, this);
};


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

MyCookie = function () {
    var c = this;
    /**
     * setCookie
     * @param cname
     * @param cvalue
     * @param exdays
     */
    this.setCookie = function(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }

    /**
     * get cookie if exists
     * @param cname
     * @returns {*}
     */
    this.getCookie = function(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    /**
     * check cookie exists
     * @param cname
     * @returns {boolean}
     */
    this.checkCookie = function(cname) {
        var cookieVal = c.getCookie(cname);
        if (cookieVal != "") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * deleteCookie with provided name
     * @param cname
     */
    this.deleteCookie = function(cname) {
        var cvalue = '';
        //*** Just set expiry to old date for delete cookie
        var expires = "expires=Thu, 01 Jan 1970 00:00:00 UTC";
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }
};

function getDateIntoRequiredFormat(params) {
    var date = params.date || null;
    var cF = params.currentFormat || null;
    var rF = params.requiredFormat || null;

    var d,m,y;
    if(cF == 'dd-mm-yyyy'){
        d = date.substr(0,2);
        m = date.substr(3,2);
        y = date.substr(6);
    }

    //*****Make Required Date Format
    if(rF == 'yyyy-mm-dd'){
        return y+'-'+m+'-'+d;
    }
}
$(document).ready(function(){
    $(".caretForSpeciality").click(function(){
        $("#specialityCaret").toggleClass("caret-up caret");
    });

    $(".caretForCity").click(function(){
        $("#cityCaret").toggleClass("caret-up caret");
    });
});