<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>EP-Sociale Appointment</title>
    <script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>

    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
    <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'>

    <link rel="stylesheet" href="{{asset('css/appointment_style.css')}}">


</head>

<body>
{{--<div class="container">--}}

    {{--<form class="well form-horizontal"   method="GET" id="contact_form">--}}
        {{--<fieldset>--}}

            {{--<!-- Form Name -->--}}
            {{--<legend>--}}
                {{--<center>--}}
                    {{--<h2><b>Registration Form</b></h2></center>--}}
            {{--</legend><br>--}}

            {{--<!-- Text input-->--}}

            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label">First Name</label>--}}
                {{--<div class="col-md-4 inputGroupContainer">--}}
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>--}}
                        {{--<input name="first_name" placeholder="First Name" class="form-control" type="text">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- Text input-->--}}

            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label">Last Name</label>--}}
                {{--<div class="col-md-4 inputGroupContainer">--}}
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>--}}
                        {{--<input name="last_name" placeholder="Last Name" class="form-control" type="text">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label">Department / Office</label>--}}
                {{--<div class="col-md-4 selectContainer">--}}
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>--}}
                        {{--<select name="department" class="form-control selectpicker">--}}
                            {{--<option value="">Select your Department/Office</option>--}}
                            {{--<option>Department of Engineering</option>--}}
                            {{--<option>Department of Agriculture</option>--}}
                            {{--<option >Accounting Office</option>--}}
                            {{--<option >Tresurer's Office</option>--}}
                            {{--<option >MPDC</option>--}}
                            {{--<option >MCTC</option>--}}
                            {{--<option >MCR</option>--}}
                            {{--<option >Mayor's Office</option>--}}
                            {{--<option >Tourism Office</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- Text input-->--}}

            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label">Username</label>--}}
                {{--<div class="col-md-4 inputGroupContainer">--}}
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>--}}
                        {{--<input name="user_name" placeholder="Username" class="form-control" type="text">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- Text input-->--}}

            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label">Password</label>--}}
                {{--<div class="col-md-4 inputGroupContainer">--}}
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>--}}
                        {{--<input name="user_password" placeholder="Password" class="form-control" type="password">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- Text input-->--}}

            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label">Confirm Password</label>--}}
                {{--<div class="col-md-4 inputGroupContainer">--}}
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>--}}
                        {{--<input name="confirm_password" placeholder="Confirm Password" class="form-control" type="password">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- Text input-->--}}
            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label">E-Mail</label>--}}
                {{--<div class="col-md-4 inputGroupContainer">--}}
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>--}}
                        {{--<input name="email" placeholder="E-Mail Address" class="form-control" type="text">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


            {{--<!-- Text input-->--}}

            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label">Contact No.</label>--}}
                {{--<div class="col-md-4 inputGroupContainer">--}}
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>--}}
                        {{--<input name="contact_no" placeholder="(639)" class="form-control" type="text">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- Select Basic -->--}}

            {{--<!-- Success message -->--}}
            {{--<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>--}}

            {{--<!-- Button -->--}}
            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label"></label>--}}
                {{--<div class="col-md-4"><br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp--}}
                    {{--<button type="submit" class="btn btn-warning">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</fieldset>--}}
    {{--</form>--}}
{{--</div>--}}

{{--<!-- /.container -->--}}
{{--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>--}}
{{--<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>--}}
{{--<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>--}}

{{--<script  src="{{asset('js/appointment_index.js"')}}"></script>--}}






<div class="container">
    <div class="col-md-12">
        <div class="CardNew">
            <div class="CardNewTop">
                <div class="row">
                    <div class="col-md-2 CardPad col-sm-2 col-xs-4 col-lg-2">
                        <div class="CardNewImg">
                            <div class="ImgCir"><img class="img-circle" src="https://myzindagi.pk/assets/female_doctor.png" alt="Dr. Nuzhat Tirmizi' picture"></div>
                            <div class="TextExp">
                                Exp. 30 Years
                            </div>
                            <!-- recommendations thing -->
                        </div>
                    </div>
                    <div class="col-md-4 CardPad col-sm-10 col-xs-8 col-lg-4">
                        <div class="DetDr">
                            <h4>
                                <a href="https://www.myzindagi.pk/doctors/dermatologist-skin-specialist/dr-nuzhat-tirmizi">Dr. Nuzhat Tirmizi</a>
                            </h4>
                            <a href="https://www.myzindagi.pk/cities/lahore/dermatologist-skin-specialist">Dermatologist / Skin Specialist</a>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-4 CardPad1 col-sm-8 col-xs-12 col-lg-4 hidden-md">
                        <div class="AboutDr-Jcarosel HospReJcarosel">
                            <div class="jcarousel-wrapper HospReJac">
                                <div data-jcarousel="true" data-wrap="circular" class="jcarousel">
                                    <ul style="left: 0px; top: 0px;">
                                        <li style="width: 215px;">
                                            <a href="https://www.myzindagi.pk/organizations/lahore/zainab-memorial-hospital"> <i><img src="https://zindagilivewebphotos.s3-eu-west-1.amazonaws.com/pictures/images/000/001/272/original/Zainab_Memorial_Hospital.jpg?1481797080" alt="Zainab Memorial Hospital"></i>
                                                <div class="HospRe">
                                                    <h2>Zainab Memorial Hospital</h2>
                                                    <span>(12:00 AM - 11:59 PM)</span> </div>
                                            </a></li>
                                    </ul>
                                </div>
                                <a data-jcarousel-control="true" data-target="-=1" href="#" class="jcarousel-control-prev HospRePrv" data-jcarouselcontrol="true"><img src="/assets/AboutDr-left.png" alt=""></a> <a data-jcarousel-control="true" data-target="+=1" href="#" class="jcarousel-control-next HospReNex" data-jcarouselcontrol="true"><img src="/assets/AboutDr-rite.png" alt=""></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 callDone col-sm-10 col-xs-12 hidden-xs">
                        <div class="StartFee"> <span><a href="#myModal" data-toggle="modal" class="btn btn-danger"><i class="fa fa-phone"></i> Call Now</a></span>
                            <p>Fee starting</p>
                            <p>from: <strong>1000 PKR</strong></p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="AboutDrBottom">

                <div class="DrApointList HospReApp">
                    <ul>
                        <li><a href="https://www.myzindagi.pk/doctors/dermatologist-skin-specialist/dr-nuzhat-tirmizi"><i><img src="/assets/AskQ.png" alt=""></i><span>Book Appointment</span></a></li>
                        <li><a href="/forums/questions"><i><img src="/assets/BookAp.png" alt=""></i><span>Ask a Question</span></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>






































</body>
</html>
<!-- /.container -->




{{--<div ng-app  class="body">--}}
{{--<form  method="post"  ng-submit="submitStudnetForm()" role="form" name="studentForm" novalidate>--}}

{{--<div class="row clearfix">--}}
{{--<div ng-class="{'has-error': studentForm.f_name.$touched && studentForm.f_name.$error.required , 'has-success': studentForm.f_name.$valid }">--}}
{{--<div class="col-sm-6 col-xs-12">--}}
{{--<div class="form-group">--}}
{{--<div class="form-line">--}}
{{--<input id="f_name" name="f_name"  type="text" ng-model="f_name" required data-validate-length-range="6" data-validate-words="2" class="form-control" placeholder="First Name">--}}
{{--</div>--}}
{{--<div class="col-sm-6">--}}
{{--<span class="help-block" ng-show="studentForm.f_name.$touched && studentForm.f_name.$error.required">Please enter First Name.</span>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div ng-class="{'has-error': studentForm.l_name.$touched && studentForm.l_name.$error.required , 'has-success': studentForm.l_name.$valid }">--}}
{{--<div class="col-sm-6 col-xs-12">--}}
{{--<div class="form-group">--}}
{{--<div class="form-line">--}}
{{--<input id="l_name" name="l_name" ng-model="l_name" required type="text" data-validate-length-range="6" data-validate-words="2" class="form-control" placeholder="Last Name">--}}
{{--</div>--}}
{{--<div class="col-sm-6">--}}
{{--<span class="help-block" ng-show="studentForm.l_name.$touched && studentForm.l_name.$error.required">Please enter First Name.</span>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row clearfix">--}}
{{--<div ng-class="{'has-error': studentForm.email.$touched && studentForm.email.$error.email , 'has-success': studentForm.email.$valid}">--}}
{{--<div class="col-sm-12">--}}
{{--<div class="form-group">--}}
{{--<div class="form-line">--}}
{{--<input type="email" id="email" name="email" ng-model="email" required class="form-control" placeholder="Enter Your Email">--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="col-sm-12">--}}
{{--<div class="form-group">--}}
{{--<div class="form-line">--}}
{{--<input type="email" id="confirm_email" name="confirm_email" data-validate-linked="email" required="required" class="form-control" placeholder="Confirm Email">--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div ng-class="{'has-error': studentForm.number.$touched && studentForm.number.$error.number , 'has-success': studentForm.number.$valid}">--}}
{{--<div class="col-sm-12">--}}
{{--<div class="form-group">--}}
{{--<div class="form-line">--}}
{{--<input type="number" id="number" name="number" ng-model="number" required="required" data-validate-minmax="10,100" class="form-control" placeholder="Phone">--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-xs-12">--}}
{{--<div class="form-group">--}}
{{--<div class="form-line">--}}
{{--<input id="dob" name="dob" type="text" class="datepicker form-control" placeholder="Date of Birth">--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}


{{--<div class="row clearfix">--}}

{{--<div class="col-sm-3 col-xs-12">--}}
{{--<div class="form-group drop-custum">--}}
{{--<select class="form-control show-tick" id="gender" name="gender">--}}
{{--<option value="">-- Gender --</option>--}}
{{--<option value="10">Male</option>--}}
{{--<option value="20">Female</option>--}}
{{--</select>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-sm-3 col-xs-12">--}}
{{--<div class="form-group drop-custum">--}}
{{--<select class="form-control show-tick" id="service" name="service">--}}
{{--<option value="">-- Service --</option>--}}
{{--<option>Select Service</option>--}}
{{--<option>Dental Checkup</option>--}}
{{--<option>Full Body Checkup</option>--}}
{{--<option>ENT Checkup</option>--}}
{{--<option>Heart Checkup</option>--}}
{{--</select>--}}
{{--</div>--}}
{{--</div>--}}


{{--</div>--}}
{{--<div class="col-xs-12">--}}
{{--<div class="form-group">--}}
{{--<div class="form-line">--}}
{{--<input type="text" id="appointment_time" name="appointment_time" class="datetimepicker form-control" placeholder="Please choose Appointment date & time...">--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-sm-12">--}}
{{--<div class="form-group">--}}
{{--<div class="form-line">--}}
{{--<textarea name="textarea" id="textarea" required="required" rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="col-xs-12">--}}
{{--<input type="submit" value="Submit" class="btn"  />--}}
{{--<input type="button" value="Reset" class="btn" />--}}

{{--</div>--}}
{{--</div>--}}

{{--</form>--}}



{{--</div>--}}