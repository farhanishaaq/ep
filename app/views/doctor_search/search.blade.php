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
@section("current_login")
    class="current"
@stop
@section('headScript')
@stop
@section('redBar')
    {{--
    <div class = "user_logo">
       --}}
    {{--
    <div class="header_1 wrap_3 color_3 login-bar">Search Doctor</div>
    --}}
    {{--
 </div>
 --}}
@stop
@section('sliderContent')
@stop
<!--========================================================
   CONTENT
   =========================================================-->
@section('content')
    <div class="banner bgt" >
        <div class="container-fluid" >
            <div class="row" >
                {{--<img src="}" style="z-index: -1">--}}
                <div class="col-lg-8 col-lg-offset-2 ">
                    <form class="col-lg-12 form-inline" method="" id="search" action="{{route('getDoctors')}}" style="margin-top: 150px">
                        <div class="col-md-9 col-md-offset-3 pd0">
                            <ul class="tabs">
                                <li class="tab-link current" data-tab="tab-1">Search Doctor by Name</li>
                                <li class="tab-link" data-tab="tab-2">Search by Speciality</li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-3 pd0">
                            <select class="js-example-basic-single" id="city" name="city">
                                <option class="vhid"></option>
                                @foreach($cities as $city)
                                    <option value="{{$city['id']}}">{{$city['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-7 col-md-7 pd0">
                            <div id="tab-1" class="tab-content current pd0">
                                <select class="js-example-basic-single " name="user_id" id="users"   style="width:100%">
                                    <option class="vhid"></option>
                                </select>
                            </div>
                            <div id="tab-2" class="tab-content pd0">
                                <select class="js-example-basic-single" id="speciality" name="speciality" style="width: 100%">
                                    <option class="vhid"></option>
                                    @foreach($medspeciality as $ms)
                                        <option value="{{$ms['id']}}">{{$ms['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="snackbar">Please Select City or Speciality to Search </div>
                        <!-- container -->
                        <div class="col-lg-2 col-md-2 pd0">
                            <button type="submit" class="btn btn-style" style="" id="submitButton">Search <span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>
                    {{--<div style="margin-top: 150px"></div>--}}
                </div>
            </div>
        </div>
    </div>
    <section id="content">
        <div class="container">
            <div class="row mT30">
                <div class="col-md-3">
                    <div class="box_1">
                        <div class="icon_1"></div>
                        <h3 class="text_2 color_7 maxheight1"><a href="#">Fee Management</a></h3>
                        <p class="text_3 color_2 maxheight">
                            Online creation and generation of patient's Bills anywhere, anytime.
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box_1">
                        <div class="icon_2"></div>
                        <h3 class="text_2 color_7 maxheight1"><a href="#">Appointment on Phone</a></h3>
                        <p class="text_3 color_2 maxheight">
                            Now Appointment reservation also is just ahead of a Phone Call, by Receptionist.
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box_1">
                        <div class="icon_3"></div>
                        <h3 class="text_2 color_7 maxheight1"><a href="#">Patient Check-Up</a></h3>
                        <p class="text_3 color_2 maxheight">
                            Now Check your patients with much convinience by keeping medical records
                            Online.
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box_1">
                        <div class="icon_4"></div>
                        <h3 class="text_2 color_7 maxheight1"><a href="#">Administration</a></h3>
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
    <script>
        $(document).ready(function() {

            function toast() {
                var x = document.getElementById("snackbar")
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 8000);
            }
            $("#search").submit(function (ev) {
                ev.preventDefault();
                var city = $('#city');
                var speciality =$('#speciality');
                var user= $('#users');
                if (city.val()=="" && speciality.val()=="" && user.val()==null ){
                    city.attr("border-color","red")
                    toast();
                }else {
                    $(this).unbind('submit').submit()
                    // $("#search").submit() ;
                }
            })
            $('#city').select2({
                allowClear: true,
                placeholder: 'Select City'

            });
            $('#speciality').select2({
                allowClear: true,
                placeholder: 'Select Doctor\'s Speciality'


            });
            var userId=0
            $('#users').select2({
                allowClear: true,
                placeholder: 'Select Doctor Name',
                ajax : {
                    url : '{{route('getDoctorData')}}',
                    dataType : 'json',
                    delay : 200,
                    data : function(params){
                        return {
                            q : params.term,
                            page : params.page,
                            city : $( "#city" ).val()

                        };
                    },
                    processResults : function(data, params){
                        params.page = params.page || 1;
                        return {
                            results : data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    }
                },
                minimumInputLength : 2,

                templateResult : function (repo){
                    imagePath = "";
                    if(repo.photo === null) {
                        if (repo.gender === 'Male') {
                            imagePath = "/uploads/maleUnknown.jpg";
                        }
                        else {
                            imagePath = "/uploads/femaleUnknown.jpg";
                        }
                        }
                    else {
                        imagePath = "/uploads/"+repo.photo;
                    }

                    if(repo.loading)
                        return repo.full_name;

                  //  var markup =  repo.full_name;
                    var asset = "{{asset('')}}";
//                    console.log(repo.photo);
                    var markup = '<div class="col-sm-1 p0">'
                        + '<img style="border-radius:2px;height: 25px; width: 25px " src="'
                        + imagePath
                        + '" style="width: 100% ;max-height: 30px; position: absolute" />'
                        + '</div>'
                        + '<div>'
                        +"<span  style='margin-left:10px;'>"+repo.full_name
                        + "</div>"

                        return markup;


                    if (repo.description) {
                        markup += '<div>' + repo.description + '</div>';
                    }

                    markup += '</div></div>';

                    return markup;


                },
                templateSelection : function(repo)
                {
                    userId=repo.id
                    return repo.full_name;
                },
                escapeMarkup : function(markup){ return markup; }
            });


            var action= $('#search').attr('action');



            $('ul.tabs li').click(function(){
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs li').removeClass('current');
                $('.tab-content').removeClass('current');

                $(this).addClass('current');
                $("#"+tab_id).addClass('current');
            })

        });


    </script>
    <style>
        .select2.select2-container{
            border-radius: 5px;
        }
        .btn-style{
            width:100%;
            height:45px
        }
        .pd0{
            padding:0px;
        }
        #multiple-datasets .league-name {
            margin: 0 20px 5px 20px;
            padding: 3px 0;
            border-bottom: 1px solid #ccc;s
        }
        .select2-search input {
            font-size: 16px;
        }
        .select2-selection__placeholder{
            font-size: 16px;
        }
        .vhid{
            visibility: hidden;
        }
        .bgt{
            background-image: url({{asset('images/index_slide02.jpg')}});
            background-size: 100% ;
            background-repeat: no-repeat;


        }
        ul.tabs{
            margin: 0px;
            padding: 0px;
            list-style: none;
        }
        ul.tabs li{
            background: #d6d8db;
            opacity: 20;
            color: #222;
            display: inline-block;
            padding: 10px 15px;
            cursor: pointer;
        }
        ul.tabs li.current{
            background: #a3abb5;
            color: #222;
        }
        .tab-content{
            display: none;
            padding: 0px;
        }
        .tab-content.current{
            display: inherit;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #5897fb;
            color: white;
            padding-top: 0;
            padding-bottom: 12px;
        }
        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    </style>
    <div class="container">
        {{--
        <div class="row wrap_9 wrap_4 wrap_10">--}}
        @if(Auth::user())
        @else
            @include('includes.webSocialLinks')
        @endif
    </div>
@endsection
@stop