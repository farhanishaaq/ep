@extends('layouts.master')
<style>
    #map {
        width: 350px;
        height: 250px;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }
</style>
<!--========================================================
                  TITLE
=========================================================-->
@section('title')
    Doctor Details
    @stop

    @section('sliderContent')
    @stop
            <!--========================================================
                          CONTENT
=========================================================-->
@section('content')
    <section id="content">
        <div class="container">
            <div class="row mT30">
                <div class="container mT20">
                    <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Doctor Details Are:</h1>
                    {{ link_to_route('fetchTopDoctors', 'Top Doctors Page', '', ['class' => 'btn btn-info btn-lg','style'=>'float:right; margin-right:10%;'])}}
                    <div class="brief-info">
                        @if($doctors_list != NULL)
                            @foreach($doctors_list as $user_info)

                                <div class="col-md-9 col-sm-9" style="float: left; padding: 10px;">
                                    <div class="col-md-3 col-sm-3" style="float: left;">
                                        <a href=""><img style="height: 100px; width: 100px;" itemprop="image"
                                                        style="min-height:40px;min-width:40px"
                                                        src="{{ URL::to('/') }}/images/{{$user_info->photo}}"
                                                        alt="Sorry, image failed to load"></a>
                                    </div>

                                    <a style="text-decoration: none;" href=""><h2
                                                itemprop="name">{{ $user_info->full_name }}</h2></a>
                                    <div class="ratingOfDoctor" style="float: right;">

                                        <input class="rating" name="rating" value="{{ $user_info->current_rating }}"
                                               data-stars="5" data-step="0.1" readonly="readonly"/>

                                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                                data-target="#myModal">Rate Here
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Add New Rating</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <input class="rating" name="modal_rating" data-stars="5"
                                                               data-step="0.1" data-value="data-stars"/>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">Title</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="title" name="title" value=""
                                                                       class="form-control" placeholder="title">
                                                                <span id="error_title"
                                                                      class="field-validation-msg"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label asterisk">Description</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="description" name="description"
                                                                       value="" class="form-control"
                                                                       placeholder="description">
                                                                <span id="error_description"
                                                                      class="field-validation-msg"></span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            {{--<input type="hidden" id="doctor_id" name="doctor_id" value="{{ $user_info->id }}" class="submit btn btn-default" />--}}
                                            {{--<input type="hidden" id="user_id" name="user_id" value="{{ $user_info->user_id }}" class="submit btn btn-default" />--}}
                                        </div>
                                    </div>

                                    <p class="degrees">{{ $user_info->name }}</p>
                                    <p class="degrees">{{ $user_info->gender }}</p>
                                    <p><img style="height: 20px; width: 20px;"
                                            src="{{ URL::to('/') }}/images/location.png"> <span>Address:</span> <span
                                                itemprop="address" style="color: black">{{ $user_info->address }}</span>
                                    </p>

                                    <!--========================================================
                                                            i'm showing Map here
                                   =========================================================-->
                                    <input type="hidden" id="address" name="address" value="{{ $user_info->address }}"
                                           class="submit btn btn-default"/>

                                    <input id="pac-input" class="controls" type="text"
                                           placeholder="Enter a location">
                                    <div id="type-selector" class="controls">
                                        <input type="radio" name="type" id="changetype-all" checked="checked">
                                        <label for="changetype-all">All</label>

                                        <input type="radio" name="type" id="changetype-establishment">
                                        <label for="changetype-establishment">Establishments</label>

                                        <input type="radio" name="type" id="changetype-address">
                                        <label for="changetype-address">Addresses</label>

                                        <input type="radio" name="type" id="changetype-geocode">
                                        <label for="changetype-geocode">Geocodes</label>
                                    </div>
                                    <div id="map"></div>

                                    <!--========================================================
                                                            Map code end here
                                   =========================================================-->

                                    <p><img style="height: 20px; width: 20px;"
                                            src="{{ URL::to('/') }}/images/fee_icon.jpg"> <span>Fee Range: </span> <span
                                                itemprop="priceRange"
                                                style="color: black">{{ $user_info->min_fee . '-' . $user_info->max_fee }}</span>
                                    </p>

                                    @if($user_info->day && $user_info->start && $user_info->end)
                                        <p><span style="font-family: strong;">Working Days:</span> <span itemprop="day"
                                                                                                         style="color: black">{{ $user_info->day }}</span>
                                            <span style="font-family: strong;"> & Working Hours: </span><span
                                                    itemprop="start" style="color: black">{{ $user_info->start }}</span><span> - </span><span
                                                    itemprop="end" style="color: black">{{ $user_info->end }}</span>
                                        </p>
                                        {{----}}
                                        {{--{{$dutyDay->day}}--}}
                                        {{--{{$dutyDay->start}}--}}
                                        {{--{{$dutyDay->end}}--}}

                                    @else
                                        <p>Sorry, Working days did not exist, Please contact us for appointment</p>
                                    @endif

                                    <div>
                                        <!-- start search bar -->
                                        {{ Form::open(['method'=>'POST','action'=>'commentOnDoctors','class'=>'navbar-form navbar-left','role'=>'comment'])  }}

                                        <div class="input-group custom-comment-form">
                                            <input type="text" class="form-control" name="comment"
                                                   placeholder="Comment here">
                                            <input type="hidden" id="doctor_id" name="doctor_id"
                                                   value="{{ $user_info->id }}" class="submit btn btn-default"/>
                                            <input type="hidden" id="user_id" name="user_id"
                                                   value="{{ $user_info->user_id }}" class="submit btn btn-default"/>
                                        </div>

                                        <input type="submit" id="comment" name="commentbutton" value="Comment"
                                               class="glyphicon-comment"/>
                                        {{ Form::close() }}

                                                <!-- end search bar -->
                                    </div>

                                </div>
                            @endforeach
                        @else
                            <p style="font-family: strong;">Sorry, you have not any record</p>
                        @endif

                        <div class="container mT20">
                            {{--<h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Comments List</h1>--}}
                            <hr class="w100p fL mT0"/>
                            <section id="form-Section">
                                <!--========================================================
                                                         Data Table
                                =========================================================-->
                                <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
                                    <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>User Name</th>
                                        <th>Comment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($doctors_comments as $user_comment)
                                        <tr class="row-data">
                                            <td><a href=""></a>
                                                <span><img style="height: 30px; width: 30px;"
                                                           src="{{ URL::to('/') }}/images/{{ $user_comment->photo }}"></span>
                                            </td>
                                            <td><a href=""></a>
                                                <span style=" font-family:Arial; font-size: 14px; background-color: white; color:black;">{{ $user_comment->full_name }}</span>
                                            </td>
                                            <td><a href=""></a>
                                                <span style=" font-family:Arial; font-size: 14px; background-color: white; color:black;">{{ $user_comment->status }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

            var address = $('#address').val();

//                if (geocoder) {
//                    geocoder.geocode({
//                        'address': address
//                    }, function(results, status) {
//                        if (status == google.maps.GeocoderStatus.OK) {
//                            if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
//                                map.setCenter(results[0].geometry.location);
//
//                                var infowindow = new google.maps.InfoWindow({
//                                    content: '<b>' + address + '</b>',
//                                    size: new google.maps.Size(150, 50)
//                                });
//
//                                var marker = new google.maps.Marker({
//                                    position: results[0].geometry.location,
//                                    map: map,
//                                    title: address
//                                });
//                                google.maps.event.addListener(marker, 'click', function() {
//                                    infowindow.open(map, marker);
//                                });
//
//                            } else {
//                                alert("No results found");
//                            }
//                        } else {
//                            alert("Geocode was not successful for the following reason: " + status);
//                        }
//                    });
//                }
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


        $(document).ready(function () {
            $('#tblRecordsList').DataTable();

            $(".rating").on('click', function () {
                var doctorIdVal = $('#doctor_id').val();
                var userIdVal = $('#user_id').val();
                var titleVal = $('#title').val();
                var descriptionVal = $('#description').val();
                var ratingVal = $('.modal-body .rating-container.rating-md.rating-animate .caption span').html();

                event.preventDefault();

                $.ajax({

                    type: "GET",
                    url: "{{ route('giveRating') }}",
                    data: {
                        doctor_id: doctorIdVal,
                        user_id: userIdVal,
                        rating: ratingVal,
                        title: titleVal,
                        description: descriptionVal
                    },
                    success: function (response) {

                        if (response == "Error") {

                        } else {
                            window.location.reload();
                        }
                    }
                });
            });

//            if($('#tblRecordsList tr.row-data').length){
//                $('#tblRecordsList').DataTable({
//                    "columnDefs": [ {
//                        "targets": 3,
//                        "orderable": false
//                    } ]
//                });
//            }


        });
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZyzoPLBoiaG-wCoB38jawe_BA0zB1W3w&callback=initMap&libraries=places"></script>
@stop