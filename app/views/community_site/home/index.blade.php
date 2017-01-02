@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Home
@stop



<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_home")
class="active"
@stop



<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
<section id="content">
    <div class="container">
        <div class="row mT30">
            <div class="col-md-2">
                <div class="box_1">
                    <a href="fetchDoctorsSpecialties"><div class="icon_3"></div></a>
                    <h3 class="text_2 color_7 maxheight1"><a href="fetchDoctorsSpecialties">Find Doctor</a></h3>
                    <p class="text_3 color_2 maxheight">
                        Online see doctors anytime.

                    </p>
                </div>
            </div>

            <div class="col-md-2">
                <div class="box_1">
                    <div class="icon_1"></div>
                    <h3 class="text_2 color_7 maxheight1"><a href="#">Category</a></h3>
                    <p class="text_3 color_2 maxheight">
                        Online creation and generation of patient's Bills anywhere, anytime.

                    </p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box_1">
                    <a href="fetchTopDoctors"></h3><div class="icon_2"></div></a>
                    <h3 class="text_2 color_7 maxheight1"><a href="fetchTopDoctors">Top Doctors</a></h3>
                    <p class="text_3 color_2 maxheight">
                        Now Appointment reservation also is just ahead of a Phone Call, by Receptionist.
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box_1">
                    <div class="icon_3"></div>
                    <h3 class="text_2 color_7 maxheight1"><a href="#">Most Searched Doctors</a></h3>
                    <p class="text_3 color_2 maxheight">
                        Now Check your patients with much convinience by keeping medical records
                        Online.
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box_1">
                    <div class="icon_4"></div>
                    <h3 class="text_2 color_7 maxheight1"><a href="create">Online Appointment</a></h3>
                    <p class="text_3 color_2 maxheight">
                        Now administrator could manage everything in the system using his full access rights.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg_1 col-md-12">
        <div class="container">
            <div class="row">
                <div class="preffix_2 grid_8">
                    <h2 class="header_1 wrap_3 color_3">
                        The Best Medical Services, <br/>
                        Treatment & Analysis
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box_1">
                        <p class="text_3">
                            Now, clinical practices will become more accurate and
                             efficient by maintaining all data regarding Patients and Users online.
                            <br/>
                             As all users of the System can access information within Medical
                             Records of Patients more accurately, conveniently and in <br/> timely manner i.e. Anywhere, Anytime.
                            <br/>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="mB30">
                    <div class="box_2 h300">
                        <div class="put-left"><img src="images/index_img01.png" alt="Image 1"/></div>
                        <div class="caption">
                            <h3 class="text_2 color_7">
                                Save Your Time <br/>
                                with Us
                            </h3>
                            <p class="text_3" style="text-align: justify;">
                                Our biggest goal is to save your time by making all relavent information online and easily accessable
                                everywhere, anytime.
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                    <div class="mB30">
                        <div class="box_2 h300">
                            <div class="put-left"><img src="images/index_img02.png" alt="Image 2"/></div>
                            <div class="caption">
                                <h3 class="text_2 color_7">
                                    The Highest <br/>
                                    Quality Services
                                </h3>
                                <p class="text_3" style="text-align: justify;">
                                    Our goal is to retain all information regarding clinical practices online
                                    , so you can access your required information anytime around the clock.
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <div class="bg_1 col-md-12">
        <div class="container mB85">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="header_1 wrap_8 color_3">
                        Objectives of Application
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="grid_12">
                    <div id="owl">
                        <div class="item">
                            <p class="text_3">
                                This application automates the System of a Company.
                                This application could also be used in multiple branches (if any) of a Company </br>
                                that should be linked through Internet, so that application could share data
                                across all branches.
                                <br/>

                            </p>
                        </div>
                        <div class="item">
                            <p class="text_3">
                                The other most important objective of application is to maintain the Medical
                                Records of patients online, so that users could </br> access and analyze medical
                                records of the Patients whenever they want conviniently.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<div class="container">
    {{--<div class="row wrap_9 wrap_4 wrap_10">--}}
    @if(Auth::user())
    @else
        @include('includes.webSocialLinks')
    @endif
</div>
@stop
@section('scripts')
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <script type="text/javascript">

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 30, lng: 70},
                zoom: 15
            });

            //    google.maps.event.addListener(map, 'click', function(event) {
            // i add geocoder code next line code
            geocoder = new google.maps.Geocoder();
            var input = /** @type {!HTMLInputElement} */(
                    document.getElementById('pac-input'));
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });
            autocomplete.addListener('place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setIcon(/** @type {google.maps.Icon} */({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
            });

            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            function setupClickListener(id, types) {
                var radioButton = document.getElementById(id);
                radioButton.addEventListener('click', function () {
                    autocomplete.setTypes(types);
                });
            }

            setupClickListener('changetype-all', []);
            setupClickListener('changetype-address', ['address']);
            setupClickListener('changetype-establishment', ['establishment']);
            setupClickListener('changetype-geocode', ['geocode']);

            // Try HTML5 geolocation.

//            var address = $('#address').val();


            if (address) {
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                            map.setCenter(results[0].geometry.location);

                            var infowindow = new google.maps.InfoWindow(
                                    {
                                        content: '<b>' + address + '</b>',
                                        size: new google.maps.Size(150, 50)
                                    });

                            var marker = new google.maps.Marker({
                                position: results[0].geometry.location,
                                map: map,
                                title: address
                            });
                            google.maps.event.addListener(marker, 'click', function () {
                                infowindow.open(map, marker);
                            });

                        } else {
                            alert("No results found");
                        }
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
//                            }

                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function (position) {
                                var pos = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude
                                };

                                infoWindow.setPosition(pos);
                                infoWindow.setContent('You are here');
                                map.setCenter(pos);
                            }, function () {
                                handleLocationError(true, infoWindow, map.getCenter());
                            });
                        } else {
                            // Browser doesn't support Geolocation
                            handleLocationError(false, infoWindow, map.getCenter());
                        }
                    }
                });
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
        }
        //
        //                autocomplete.addListener('place_changed', function() {
        //                    infowindow.close();
        //                    marker.setVisible(false);
        //                    var place = autocomplete.getPlace();
        //                    if (!place.geometry) {
        //                        // User entered the name of a Place that was not suggested and
        //                        // pressed the Enter key, or the Place Details request failed.
        //                        window.alert("No details available for input: '" + place.name + "'");
        //                        return;
        //                    }
        //                });

        //                google.maps.event.addListener(map, 'click', function (event) {
        //                    $("#StoreLong").val(event.latLng.lng());
        //                    $("#StoreLat").val(event.latLng.lat());
        //                });

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZyzoPLBoiaG-wCoB38jawe_BA0zB1W3w&callback=initMap&libraries=places"></script>
@stop