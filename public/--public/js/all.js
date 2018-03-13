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
//test start

/**
 * jQuery geolocation.edit plugin
 * Copyright (c) 2012 Milos Popovic <the.elephant@gmail.com>
 *
 * Freely distributable under the MIT license.
 *
 * @version 0.0.16 (2015-10-16)
 * @see http://github.com/miloss/jquery-geolocation-edit
 */
(function ($) {
    var loadScript;

    // Queued initializations
    var inits = [];

    // Methods container object
    var methods = {};


    // Plugin methods

    /**
     * Main execution method
     * @param {Object}  options  Passed plugin options
     */
    methods.main = function (options) {
        var selector = this;

        // Check for required fields
        if (typeof options.lat === 'undefined' || typeof options.lng === 'undefined') {
            $.error("Please provide 'lat' and 'lng' options for jQuery.geolocate");
            return;
        }

        // If GoogleMaps not loaded - push init to queue and go on
        if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
            inits.push(function () {
                $(selector).geolocate(options);
            });
            loadScript();
            return;
        }

        // Extend default options
        var opts = $.extend(true, {
            address: [],
            changeOnEdit: false,
            readOnlyMap: false, // Don't allow pin movement on click
            mapOptions: {
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                streetViewControl: false
            },
            markerOptions: {
                draggable:true,
                animation: google.maps.Animation.DROP
            },
            geoCallback: function(){}
        }, options);

        $(this).data('opts', opts);

        // Init map and marker - per coordinates
        var llat = parseFloat( $( opts.lat ).val() );
        var llng = parseFloat( $( opts.lng ).val() );
        if (isNaN(llat)) {
            llat = 0;
        }
        if (isNaN(llng)) {
            llng = 0;
        }

        var llocation = new google.maps.LatLng(llat, llng);
        $(this).geolocate({}, 'initMap', llocation);

        // Bind actions - coordinates fields
        if ( opts.changeOnEdit ) {
            $( opts.lat ).change(function () { $(selector).geolocate({}, 'updateLatLng', opts); });
            $( opts.lng ).change(function () { $(selector).geolocate({}, 'updateLatLng', opts); });
        }

        // Bind  actions - address field
        var addrlen = opts.address.length;
        for (var i = 0; i < addrlen; i++) {
            $( opts.address[i] ).change(function () {
                $(selector).geolocate({}, 'callGeocoding');
            });
        }
    };


    /**
     * Initialize GoogleMaps Map on page
     * @param {LatLng} location  GoogleMaps object
     */
    methods.initMap = function (location) {
        var self = $(this).get(0);
        var gmaps = google.maps;
        var opts = $.data(self, 'opts');

        var map = new gmaps.Map(self, $.extend({
            center: location
        }, opts.mapOptions));

        var markerOptions = $.extend({
            map: map,
            position: location
        }, opts.markerOptions);

        var marker = new gmaps.Marker(markerOptions);

        $.data(self, 'map', map);
        $.data(self, 'marker', marker);

        gmaps.event.addListener(marker, 'dragend', function () {
            $(self).geolocate({}, 'getMarkerLocation');
        });

        // Move the marker to the location user clicks
        if (!opts.readOnlyMap) {
            gmaps.event.addListener(map, 'click', function (event) {
                marker.setPosition(event.latLng);
                $(self).geolocate({}, 'getMarkerLocation');
            });
        }
    };


    /**
     * Make Google Geocoding call with provided address
     */
    methods.callGeocoding = function () {
        var self = $(this).get(0);
        var opts = $.data(self, 'opts');
        var len = opts.address.length;
        var cbfunc = opts.geoCallback;

        // Get address
        var addr = '';
        while (len--) {
            addr += $( opts.address[len] ).val();
        }

        // Make request
        var geo = new google.maps.Geocoder();

        // Geocoder response
        geo.geocode({
            address: addr
        }, function (data, status) {
            var loc, first, map, marker;

            cbfunc(data, status);

            first = data[0];
            if (typeof first === 'undefined') return;

            map = $.data(self, 'map');
            marker = $.data(self, 'marker');

            loc = first.geometry.location;
            map.panToBounds( first.geometry.viewport );
            map.panTo( loc );
            marker.setPosition( loc );
            $(self).geolocate({}, 'getMarkerLocation');
        });
    };


    /**
     * Copy marker position to coordinates fields
     */
    methods.getMarkerLocation = function () {
        var marker = $.data($(this).get(0), 'marker');
        var opts = $.data($(this).get(0), 'opts');
        var pos = marker.getPosition();;

        $( opts.lat ).val( pos.lat() );
        $( opts.lng ).val( pos.lng() );
    };


    /**
     * Move to the current settings for lat & lng
     * @param {Object} opts
     */
    methods.updateLatLng = function (opts) {
        var self = $(this).get(0);
        var lat = $( opts.lat ).val();
        var lng = $( opts.lng ).val();
        var loc = new google.maps.LatLng(lat, lng);
        var map = $.data(self, 'map');
        var marker = $.data(self, 'marker');
        map.panTo(loc);
        marker.setPosition(loc);
    };


    // Main plugin function
    // Call appropriate method, or execute 'main'
    $.fn.geolocate = function (os, method) {
        var pslice = Array.prototype.slice;
        if ( typeof method === 'undefined' ) { // Only method passed (as 1st parameter)
            if ( typeof os === 'string' && typeof methods[os] !== 'undefined' ) {
                return methods[ os ].apply( this, pslice.call( arguments, 1 ));
            } else {
                $(this).geolocate({}, 'main', os);
            }
        } else if ( methods[method] ) {
            return methods[ method ].apply( this, pslice.call( arguments, 2 ));
        } else {
            $.error("Method " +  method + " does not exist on jQuery.geolocate");
        }
        return this;
    };


    // Callback to GoogleMaps async loading
    // FIXME find non-jQuery.fn-polluting solution
    $.fn.geolocateGMapsLoaded = function () {
        while (inits.length) {
            inits.shift()();
        }
    };


    // Private functions

    // Load GoogleMaps, we want to do it only once
    loadScript = (function () {
        var ran = false;

        return function () {
            var script;
            if (ran) return;
            ran = true;

            script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = ( window.location.protocol == 'https:' ? 'https' : 'http' ) + '://maps.googleapis.com/maps/api/js?sensor=false&callback=jQuery.fn.geolocateGMapsLoaded';
            document.body.appendChild(script);
        };
    })();

})(jQuery);


//End
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

