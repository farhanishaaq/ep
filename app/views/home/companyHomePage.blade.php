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

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Welcome to {{$Company->name}}</div>
    </div>
@stop

<!-- ========================================================
                                      SLIDERS
            ========================================================= -->
@section('sliderContent')
    <div class="camera-wrapper">

        <div id="camera" class="camera-wrap">
            <!--
            <div data-src="{{asset('images/index_slide01.jpg')}}">
                <div class="fadeIn camera_caption">
                    <h2 class="text_9 color_3">Optimize resources with technologies</h2>
                </div>
            </div>

            <div data-src="{{asset('images/index_slide02.jpg')}}">
                <div class="fadeIn camera_caption">
                    <h2 class="text_9 color_3">Cure with excellence!</h2>
                </div>
            </div>

            <div data-src="{{asset('images/index_slide03.jpg')}}">
                <div class="fadeIn camera_caption">
                    <h2 class="text_9 color_3">Easy online resource management for Physicians</h2>
                </div>
            </div>
            <div data-src="{{asset('images/index_slide04.png')}}">
                <div class="fadeIn camera_caption">
                    <h2 class="text_9 color_3">Easy online Medical Records</h2>
                </div>
            </div>
            <div data-src="{{asset('images/index_slide05.jpg')}}">
                <div class="fadeIn camera_caption">
                    <h2 class="text_9 color_3">The Ease for the new era for Health care</h2>
                </div>
            </div>
            -->
            <div data-src="{{asset('images/index_slide03.jpg')}}">
                <div class="fadeIn camera_caption">
                    {{--<h2 class="text_9 color_3">Online Medical Records!</h2>--}}


                    {{--Working Hours & Fee --}}
                    <section class="form-Section col-md-4 h350 fL bca9">

                        <h3 class="c7">Working Hours & Fee</h3>

                        <div class="form-group workingHours">
                            {{--<label class="col-xs-5 control-label asterisk">Select Doctor</label>--}}
                            <div class="col-xs-12">
                                {{ make_doctor_drop_down($doctors, Form::getValueAttribute('doctor_id', null)) }}
                                <span id="error_doctor_id" class="field-validation-msg"></span>
                            </div>
                        </div>

                        <div id="doctorInfo">

                        </div>


                    </section>


                    {{-- Start Online Appointment --}}



                    {{ Form::open(array('action' => 'CompaniesController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm','enctype' => 'multipart/form-data', 'novalidate')) }}


                    <section class="form-Section col-md-7 h350 fR bca9">
                        <h3 class="c7">Online Appointment</h3>
                        <ul class="nav nav-tabs company-home" role="tablist">
                            <li role="presentation" class="active"><a href="#patientBasicInfoTab" aria-controls="patientBasicInfoTab" role="tab" data-toggle="tab">Patient Basic Info</a></li>
                            <li role="presentation" id="appointmentInfoLi"><a href="#appointmentInfoTab" aria-controls="appointmentInfoTab" role="tab" data-toggle="tab">Appointment Info</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="patientBasicInfoTab">
                                <section class="form-Section col-md-12 bca9">
                                    <div class="mT10">
                                        <div class="form-group mB0 col-xs-12 mL0i mR0i">
                                            <div class="col-xs-12 taL">
                                                {{switch_btn_group(['fieldName'=>'status', 'onVal'=>'Yes', 'offVal'=>'No'])}}
                                                <label class="c7">Do you visit before?</label>
                                                <span id="error_paid_fee" class="field-validation-msg"></span>
                                            </div>
                                        </div>

                                        {{-- NewPatient --}}
                                        <div class="form-group mB0 col-xs-6 mL0i mR0i newPatient dN">
                                            <div class="col-xs-12">
                                                <input type="text" id="fname" name="fname" value="{{{ Form::getValueAttribute('lname', null) }}}" class="form-control" placeholder="Patient First Name">
                                                <span id="error_paid_fee" class="field-validation-msg"></span>
                                            </div>
                                        </div>

                                        <div class="form-group mB0 col-xs-6 mL0i mR0i newPatient dN">
                                            <div class="col-xs-12">
                                                <input type="text" id="lname" name="lname" value="{{{ Form::getValueAttribute('lname', null) }}}" class="form-control" placeholder="Patient Last Name">
                                                <span id="error_paid_fee" class="field-validation-msg"></span>
                                            </div>
                                        </div>

                                        <div class="form-group mB0 col-xs-6 mL0i mR0i newPatient dN">
                                            <div class="col-xs-12">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control" id="dob" name="dob" value="{{{ get_display_date(Form::getValueAttribute('dob', null)) }}}" readonly placeholder="Date of Birth (dd-mm-yyyy)">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>

                                                <span id="error_dob" class="field-validation-msg"></span>
                                            </div>
                                        </div>

                                        <div class="form-group mB0 col-xs-6 mL0i mR0i newPatient dN">
                                            <div class="col-xs-12">
                                                <input type="text" id="age" name="age" required="true" value="{{{ Form::getValueAttribute('age', null) }}}" class="form-control" placeholder="Age">
                                                <span id="error_age" class="field-validation-msg"></span>
                                            </div>
                                        </div>

                                        <div class="form-group mB0 col-xs-6 mL0i mR0i newPatient dN">
                                            <div class="col-xs-12 taL">
                                                {{radio_btn_group(array( 'Male' => 'Male', 'Female' => 'Female' ),'gender')}}
                                            </div>
                                        </div>

                                        <div class="form-group mB0 col-xs-6 mL0i mR0i newPatient dN">
                                            <div class="col-xs-12">
                                                <input type="text" id="cell" name="cell" value="{{{ Form::getValueAttribute('cell', null) }}}" class="form-control" placeholder="+92 301 7865324">
                                                <span id="error_cell" class="field-validation-msg"></span>
                                            </div>
                                        </div>
                                        {{-- End NewPatient --}}


                                        {{-- Start OldPatient --}}
                                        <div class="form-group mB0 col-xs-6 mL0i mR0i oldPatient">
                                            <div class="col-xs-12">
                                                <input type="text" id="code" name="code" value="{{{ Form::getValueAttribute('code', null) }}}" class="form-control" placeholder="Patient Code">
                                                <span id="error_cell" class="field-validation-msg"></span>
                                            </div>
                                        </div>
                                        <div class="form-group mB0 col-xs-6 mL0i mR0i oldPatient">
                                            <div class="col-xs-12">
                                                <input type="text" id="cell" name="cell" value="{{{ Form::getValueAttribute('cell', null) }}}" class="form-control" placeholder="+92 301 7865324">
                                                <span id="error_cell" class="field-validation-msg"></span>
                                            </div>
                                        </div>
                                        {{-- End OldPatient --}}


                                        <div class="form-group mB0 col-xs-12 fR mL0i mR0i taR">
                                            <div class="col-xs-12">
                                                <input id="goToTab2" type="button" value="Next">
                                                <span id="errorTimeslotId" class="field-validation-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="appointmentInfoTab">
                                <section class="form-Section col-md-12 bca9">
                                    <div class="mT10">
                                        <div class="form-group mB0 col-xs-6 mL0i mR0i">
                                            <div class="col-xs-12">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control" id="date" name="date" required="true" value="{{{ retrieve_date_for_input('date')}}}" readonly placeholder="Appointment Date (dd-mm-yyyy)">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                                <span id="error_date" class="field-validation-msg"></span>
                                            </div>
                                        </div>

                                        <div class="form-group mB0 col-xs-6 mL0i mR0i">
                                            <div class="col-xs-12">
                                                <select id="time_slot_id" name="time_slot_id" required="true">
                                                    <option> Select Time slot </option>
                                                </select>
                                                <span id="errorTimeslotId" class="field-validation-msg"></span>
                                            </div>
                                        </div>

                                        <div class="form-group mB0 col-xs-12 fR mL0i mR0i taR">
                                            <div class="col-xs-12">
                                                <input type="submit" value="Book Appointment">
                                                <span id="errorTimeslotId" class="field-validation-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>


                    {{ Form::close() }}

                    {{-- End Online Appointment --}}

                </div>
            </div>
        </div>
    </div>
@stop

<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
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
    <div class="container">
        {{--<div class="row wrap_9 wrap_4 wrap_10">--}}
        @if(Auth::user())
        @else
            @include('includes.webSocialLinks')
        @endif
    </div>
@stop

@section('scripts')
    <script src="{{asset('js/view-pages/home/CompanyHomePage.js')}}"></script>
    <script>
        $(document).ready(function () {
            var options = {
                fetchDoctorInfoUrl: "{{route('fetchDoctorDutyAndFeeInfo')}}"
            };
            var companyHomePage = new CompanyHomePage(window,document,options);
            companyHomePage.initializeAll();
        });


    </script>
@stop


