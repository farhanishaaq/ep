
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
<?php $id=0; ?>

@foreach($drRecord as $profile)
    <?php $id = $profile->id ?>
@section('title')
   {{$profile->full_name}}
@stop

@section('redBar')
    <div >

    </div>
@stop

@section('sliderContent')
@stop
@section('headScript')

    {{--<link src="{{ asset('css/jquery.rateyo.min.css') }}">--}}
    @endsection

@section('content')
    {{--<div class="container">--}}


    {{--</div>--}}
        <div class=" container-fluid" style="max-width: 1200px;">
            {{--{{$drRecord->fname}}--}} {{--{{ $i=0 }}--}}

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <div class="card card-topline-aqua">
                            <div class="card-body no-padding height-9">
                                <div class="row">
                                    <div class="profile-userpic">

                                        <img src="
                                                   @if(isset($profile->photo))
                                        {{asset('/'.$profile->photo)}}
                                        @else
                                        @if($profile->gender =="Male")
                                        {{asset('uploads/maleUnknown.jpg')}}
                                        @else
                                        {{asset('uploads/femaleUnknown.jpg')}}
                                        @endif
                                        @endif

                                        " class="img-responsive" alt=""> </div>
                                </div>
                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name"> {{ $profile->full_name }} </div>
                                    <div class="profile-usertitle-job">{{$profile->specialityName}}</div>
                                </div>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Fee:</b>
                                        <div class="profile-desc-item pull-right">{{($profile->max_fee)-500}}-{{$profile->max_fee}}</div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Exprience</b>
                                        <div class="profile-desc-item pull-right">10 Year</div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Rating</b>
                                        <div class="profile-desc-item pull-right" id="drRate"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Degree</b>
                                        <div class="profile-desc-item pull-right">{{$profile->code}}</div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender </b>
                                        <div class="profile-desc-item pull-right">{{ $profile->gender }}</div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Designation</b>
                                        <div class="profile-desc-item pull-right"></div>
                                    </li>
                                </ul>
                                <!-- END SIDEBAR USER TITLE -->
                                <!-- SIDEBAR BUTTONS -->
                                <div class="profile-userbuttons">
                                    {{--
                                    <button type="submit" class="btn btn-circle green-bgcolor btn-sm" href="{{URL::route('getappointment')}}">Get Appointment</button>--}}

                                    @if($profile->company_id != 1)
                                     <a  href="{{ URL::route('appointments.create')."?id=".$profile->id }}" type="submit" style="color: white"><button class="btn btn-raised btn-sm btn-1" > Get Appointment </button></a>
                                   @endif
                                    @if(Auth::check())
                                    <button type="button" class="btn btn-raised btn-sm btn-1" data-toggle="modal" data-target="#myModal">Ask A Question</button>
                                    @endif
                                        <div id="rateYo" style="margin-left: 50px;margin-top: 25px;"></div>
                                    <script src="{{asset('js/jquery.rateyo.js')}}"></script>
                                    @include('doctors.includes.questionModal')
                                </div>

                                <!-- END SIDEBAR BUTTONS -->
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-head card-topline-aqua" style="border: 0px">
                                <header>Location</header>
                            </div>
                            <div class="card-body no-padding height-9">


                                    <input hidden id="address" type="textbox" value="
                                    {{--{{$profile->address}}--}}
                                    {{$profile->cityName}}
                                    ">
                                    <input  hidden id="submit" type="button" value="Geocode">

                                <div id="map" style="width: 300px; height: 600px;"></div>
                                {{--star rating/--}} {{--star rating/--}}
                            </div>
                        </div>

                    </div>

                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="card">
                                <div class="card-body no-padding height-9">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tabbable-line">
                                                    <ul class="nav nav-tabs">
                                                        <li ><h4><strong>About Me </strong>  </h4>  </li>

                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active fontawesome-demo" id="tab1">
                                                            <div class="row">
                                                                <div id="biography">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-xs-6 b-r"> <strong>Full Name</strong>
                                                                            <br>
                                                                            <p class="text-muted">{{ $profile->full_name }}</p>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-6 b-r"> <strong>Mobile</strong>
                                                                            <br>
                                                                            <p class="text-muted">{{$profile->phone != "" ? $profile->phone: "No contact" }}</p>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-6 b-r" > <strong>Email</strong>
                                                                            <br>
                                                                            <p class="text-muted" >{{$profile->email}}</p>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-6"> <strong>Location</strong>
                                                                            <br>
                                                                            <p class="text-muted " id="address">{{$profile->address}}</p>
                                                                            {{--
                                                                            Use this For Removing Alert Error {{$profile->cityName}}
                                                                            --}}
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                     @if(!empty($profile->code))
                                                                    <h4 class="font-bold">Education</h4>
                                                                    <ul>
                                                                        <li>{{$profile->code}} &nbsp;
                                                                        <a data-toggle="modal" data-target="#code"><h7>what is {{$profile->code}}?</h7></a>
                                                                        </li>
                                                                        <li>{{$profile->title}}</li>
                                                                        <li>{{$profile->qualificationsDescription}}</li>
                                                                        <li>{{$profile->institute}}</li>

                                                                    </ul>
                                                                    <br>
                                                                    @endif
                                                                    <span id="experienceSection">
                                                                    <h4 class="font-bold">Experience</h4>
                                                                    <hr>
                                                                    <ul>
                                                                        <li id="experience">{{$profile->experience}}</li>
                                                                    </ul>
                                                                    </span>
                                                                    @if(!empty($profile->doctorAffiliation))
                                                                    <br>
                                                                    <h4 class="font-bold">Professional Affiliations </h4>
                                                                    <hr>
                                                                    <ul>
                                                                        <li id="affiliation">{{$profile->doctorAffiliation}}</li>
                                                                    </ul>
                                                                    <br>
                                                                    @endif


                                                                    {{--
                              <form class="form-inline" action="{{route('comment')}}" method="post">--}} @if(Auth::user())
                                                                        <h4><strong style="color: #01ADD5">Reviews About Doctor</strong></h4></button>
                                                                        <form class="form-inline" id="commentForm">

                                                                            <div class="input-group" style="width: 100%">

                                                                                <textarea style="resize: none" class="col-lg-12 col-md-12 col-sm-12 form-control" type="text" placeholder="Write Comments" name="addComment" id="comment"  style="width: 100%"></textarea>

                                                                                 <button class="btn btn-raised btn-sm btn-1 w100p pT10"  id="ajax" type="submit"><span class="fs15">Submit</span></button>
                                                                                {{--<span class="input-group-addon p0"  style="width: 20%; height: inherit"><button id="ajax" type="submit" style="width: 100%; height: inherit " onclick="submitForm()"><h5>Comment</h5></button></span>--}}
                                                                            </div>
                                                                            <br>
                                                                            <input class="form-control" type="hidden" value="{{$id}}" name="target_Id" id="target_Id">
                                                                            <input class="form-control" type="hidden" value="profile" name="type" id="type">

                                                                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                                                                            <br> {{--
                                                                    <input type="hidden" name="commenttoken" value=" {{csrf_token()}}" />--}}




                                                                        </form>
                                                                    @endif
                                                                    <input class="form-control" type="hidden" value="profile" name="type" id="type">
                                                                    <input class="form-control" type="hidden" value="{{$id}}" name="target_Id" id="target_Id">
                                                                    <br>
                                                                    <hr>
                                                                    <div class="tab-content" id="commentSection">

                                                                        <h3 class="tab-content"><strong>Doctor Reviews:</strong></h3> {{--@foreach($drComments as $comment)--}}

                                                                        <div class="" style="background-color: white">
                                                                            <ul  class="commentList" id="commentList">

                                                                            </ul>
                                                                        </div>
                                                                        <br> {{--@endforeach--}}
                                                                    </div>






                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

<!-- Modal -->
                 <div class="modal fade" id="code" role="dialog">
                     <div class="modal-dialog modal-sm">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4>{{$profile->code}}</h4>
                         </div>
                         <div class="col-md-offset-4">
                         </div>
                           <p style="text-align: center">{{$profile->qualificationsDescription}}</p>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         </div>
                       </div>
                     </div>
                   </div>
{{--Modal End--}}

                     <br><br>
                    <br><br>

    <!-- start js include path -->
    <!-- start js include path -->
    {{--<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>--}}
    {{--<script src="{{ asset('js/jquery.blockui.min.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('js/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    {{--<!-- bootstrap -->--}}
    {{--<script src="{{ asset('js/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('js/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>






    {{--<!----}}
            {{--<script src="js/jquery.slimscroll.js"></script>--}}
            {{--<script src="js/app.js" type="text/javascript"></script>--}}
    {{---->--}}
    <script type="text/javascript"> $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>
    <script src=" {{ asset('js/profile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/layout.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{asset('css/jquery.rateyo.css')}}"/>
    <script src="{{asset('js/jquery.min.js')}}"></script>

    <script src="{{ asset('js/jquery.rateyo.min.js') }}" type="text/javascript"></script>
    <script>

        // $( document ).ready(function() {
        //     var rating  = $("#drRate").html();
        //     if(rating == ""){
        //     $("#drRate").replaceWith("0");
        // }
        // });
    function rating () {
        $(function () {
            $.ajax({
                type : "get",
                url : "{{route('starRating.index')}}",
                data : {
                    "doctorId" : $('#Doctro_id').val()
                },
                dataType : "json",
                success : function(response){
                    if(response.toString() == "noRecord"){
//                    if(response.rating == "noRecord"){

                        $("#rateYo").rateYo({
                            rating: 0,
                            fullStar:true
                            //readOnly: true
                        })
                        // console.log('in no record')
                    }else {

                        console.log(response.rating[0]);
                        if(response.check){

                            $("#rateYo").rateYo({
                                rating: response.rating[0].rating,
                                fullStar:true,
                                readOnly: false
                            })

                        }else{

                            $("#rateYo").rateYo({
                                rating: response.rating[0].rating,
                                fullStar:true,
                                readOnly: true
                            })

                        }
                        //  console.log(response)
                        // console.log('in found record '+response[0].rating)
                        if(typeof response.rating[0].rating == "undefined"){
                            $('#drRate').html("0"+'<i class="fa fa-star fa-2x" style="color: goldenrod;margin-top: 4px" aria-hidden="true"></i>')

                        }
                        else
                        {
                            console.log(response.rating[0].rating);
                            $('#drRate').html(response.rating[0].rating+'<i class="fa fa-star fa-2x" style="color: goldenrod;margin-top: 4px" aria-hidden="true"></i>')
                        }
//                        $('#drRate').html(response.rating['rating']+'<i class="fa fa-star fa-2x" style="color: goldenrod;margin-top: 4px" aria-hidden="true"></i>')
                    }
                },
                error : function(response){
                    //console.log('fail')
                }
            });
        })
    }

rating();
        $(function () {

            $("#rateYo")
                .on("rateyo.set", function (e, data) {
                    $.ajax({
                        type : "post",
                        url : "{{route('starRating.store')}}",
                        data : {
                            "rating" : data.rating,
                            "userId" : $('#auth_user').val(),
                            "doctorId" : $('#Doctro_id').val()
                        },
                        dataType : "json",
                        success : function(response){
                            rating();
                            if(response.toString() == "sucess"){

                              //  console.log('sucess')
                            }
                        },
                        error : function(response){
                            rating();
                          //  console.log('fail')
                        }
                    });
//                    alert("The rating is set to " + data.rating + "!");
                });

        });
//        function submitForm() {
//            $("#commentForm")[0].reset();
//        }





{{--//            getComments();--}}
            {{--function getComments() {--}}

                {{--$.ajax({--}}
                    {{--type: 'get',--}}
                    {{--url: '{{route('showComment')}}',--}}
                    {{--dataType: 'json',--}}
                    {{--data: {--}}

                        {{--'id': $('#Doctro_id').val()--}}

                    {{--},--}}
                    {{--success: function (data) {--}}

                    {{--if ((data.errors)) {--}}
                       {{--// console.log(JSON.stringify(data));--}}
                    {{--} else {--}}
                      {{--//  console.log(JSON.stringify(data));--}}
                        {{--$.each( data, function( key, val ) {--}}
                            {{--var txt2 = $(" <li>  " +--}}
                                {{--"<div  style='border-bottom: 1px solid #01ADD5; margin-bottom: 25px' class='commentText col-md-12'><span class='col-md-9'> " + val.comments+"</span>"+"<span class='col-md-3'>"+ (val.created_at).slice(0,-3)+"</span>" +--}}
                                {{--"</div>" +--}}
                                {{--"</li>");  // Create text with jQuery--}}

                            {{--$("#commentList").append(txt2);     // Append new elements--}}

{{--//                            $("#commentList").appendChild(txt2);--}}
                            {{--//alert(val.comments);--}}
                        {{--});--}}


                    {{--}--}}
                    {{--}--}}
                {{--});--}}


            {{--}--}}

            {{--getComments();--}}

{{--//        getComments();--}}

        {{--$("#ajax").click(function(event) {--}}
            {{--event.preventDefault();--}}
            {{--if($('#comment').val().length>5){--}}
                {{--$.ajax({--}}
                    {{--type: "get",--}}
                    {{--url: "{{ url('comment') }}",--}}
                    {{--dataType: "json",--}}
                    {{--data: {--}}
                        {{--//'_token': $('input[name=_token]').val(),--}}

                        {{--'id': $('#Doctro_id').val(),--}}
                        {{--'user_id': $('#auth_user').val(),--}}
                        {{--'comment': $('#comment').val()--}}
                    {{--},--}}

{{--//                data: $('#ajax').serialize(),--}}
                    {{--success: function(data){--}}
{{--//                        alert(sucess);--}}
                    {{--},--}}

                    {{--error: function(data){--}}
                        {{--commentsreload();--}}
                        {{--getComments();--}}
                        {{--$('#comment').val('')--}}
                    {{--}--}}
                {{--});--}}

            {{--}else {--}}
                {{--return 0--}}
            {{--}--}}


        {{--});--}}



        {{--function commentsreload() {--}}

            {{--$.ajax({--}}
                {{--type: 'get',--}}
                {{--url: '{{route('showComment')}}',--}}
                {{--dataType: 'json',--}}
                {{--data: {--}}

                    {{--'id': $('#Doctro_id').val()--}}

                {{--},--}}
                {{--success: function (data) {--}}

                    {{--if ((data.errors)) {--}}
                        {{--console.log(JSON.stringify(data));--}}
                    {{--} else {--}}
                        {{--console.log(JSON.stringify(data));--}}
                        {{--$.each( data, function( key, val ) {--}}
                            {{--var txt2 = $(" <li>  " +--}}
                                {{--"<div  class='commentText'><p> " + val.comments+"</p>"+"<span>"+ val.created_at+"</span>" +--}}
                                {{--"</div>" +--}}
                                {{--"</li>");  // Create text with jQuery--}}

                                {{--// Append new elements--}}
                            {{--$("#commentList").empty();--}}
{{--//                            $("#commentList").append( txt2)--}}

{{--//                            $("#commentList").appendChild(txt2);--}}
                            {{--//alert(val.comments);--}}
                        {{--});--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}



    </script>

    {{--<script>--}}
        {{--function initMap() {--}}
            {{--var map = new google.maps.Map(document.getElementById('map'), {--}}
                {{--zoom: 16,--}}
                {{--center: {lat: -34.397, lng: 150.644}--}}
            {{--});--}}
            {{--var geocoder = new google.maps.Geocoder();--}}

          {{--//  document.getElementById('submit').addEventListener('click', function() {--}}
                {{--geocodeAddress(geocoder, map);--}}
         {{--//   });--}}
        {{--}--}}

        {{--function geocodeAddress(geocoder, resultsMap) {--}}
            {{--var address = document.getElementById('address').value;--}}
            {{--geocoder.geocode({'address': address}, function(results, status) {--}}
                {{--if (status === 'OK') {--}}
                    {{--resultsMap.setCenter(results[0].geometry.location);--}}
                    {{--var marker = new google.maps.Marker({--}}
                        {{--map: resultsMap,--}}
                        {{--position: results[0].geometry.location--}}
                    {{--});--}}
                {{--} else {--}}
                    {{--alert('Geocode was not successful for the following reason: ' + status);--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

    {{--</script>--}}
    <script src="{{asset("js/doctor.profile.js")}}"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0h-b6OIqk8pmDhFmH2BiUHSlU4PmFiDU&callback=initMap">
    </script>
@stop






