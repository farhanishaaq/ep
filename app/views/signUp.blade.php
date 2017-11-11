<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>EP-Appointment</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
    <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'>
    <link rel="stylesheet" href="{{asset('css/appointment_style.css')}}">
</head>
<body>
{{--Need to make section here--}}
<div class="block-header" style=" margin-left: 50px;">
    <h1>
        <img src="{{asset('images/appointment_img.png')}}" height="40px" width="40px" style="margin-right: 20px;">Book Appointment
    </h1>
</div>
<div class="col-md-12">
    <div class="col-md-3" ></div>
    <div class="col-md-6">


        <div class="tab">
            <button class="active" onclick="openCity(event, 'online')">Book Online</button>
            <button class="tablinks" onclick="openCity(event, 'call')">Book by Call</button>
        </div>

        <div id="online" class="tabcontent">
            <section >
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <div class="card" style="background-color: whitesmoke; ">
                                <div style="background-color: white; padding:1px 0px 10px 10px ; ">
                                    <h3>
                                        <img src="{{asset('images/search.png')}}" height="20px" width="20px">
                                        Appointment Information<br>
                                        <h5 style="margin-left: 30px">Get Your Appointment . . .</h5>
                                    </h3>
                                </div>
                                <form class="form-horizontal"   method="GET" id="contact_form" style="padding-top: 20px; background-color: whitesmoke">
                                    <fieldset>
                                        <!-- Form Name -->
                                        <!-- Text input-->
                                        <div class="form-group" style="padding-top: 10px;">
                                            <label class="col-md-3 control-label">First Name</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    <input name="first_name" placeholder="First Name" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group" style="padding-top: 10px;">
                                            <label class="col-md-3 control-label">Last Name</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    <input name="last_name" placeholder="Last Name" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group" style="padding-top: 10px;">
                                            <label class="col-md-3 control-label">E-Mail</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                    <input name="email" placeholder="E-Mail Address" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group" style="padding-top: 10px;">
                                            <label class="col-md-3 control-label">Password</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    <input name="user_password" placeholder="Password" class="form-control" type="password">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group" style="padding-top: 10px;">
                                            <label class="col-md-3 control-label">Confirm Password</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    <input name="confirm_password" placeholder="Confirm Password" class="form-control" type="password">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <!-- Text input-->
                                        <div class="form-group" style="padding-top: 10px;">
                                            <label class="col-md-3 control-label">Contact No.</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                    <input name="contact_no" placeholder="(+92-888-1234567)" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" style="padding-top: 10px;">
                                            <label class="col-md-3 control-label">Category</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group" style="padding-top: 10px;">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                    <select name="department" class="form-control selectpicker">
                                                        <option value="">Select Category</option>
                                                        <option>Physician</option>
                                                        <option>Dentistry</option>
                                                        <option >Dermatology</option>
                                                        <option >Cardiologist</option>
                                                        <option >Gynecology</option>
                                                        <option >Orthopedic</option>
                                                        <option >ENT</option>
                                                        <option >Pathologist</option>
                                                        <option >Psychologist</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Select Basic -->
                                        <!-- Success message -->
                                        <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>
                                        <!-- Button -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-8"><br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <button type="submit" class="btn btn-warning" onclick="move()">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                                            </div>
                                        </div>
                                        <div id="myProgress" style="margin-top: 20px;">
                                            <div id="myBar">10%</div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <div id="call" class="tabcontent">
            <h3>Contact No</h3>
            <p>+92-333-1234567.</p>
            <p>(Available between 9AM - 9PM)</p>
        </div>

        <div id="Tokyo" class="tabcontent">
            <h3>Tokyo</h3>
            <p>Tokyo is the capital of Japan.</p>
        </div>



    </div>
    <div class="col-md-3" ></div>
    </div>
</div>
{{--<!-- Jquery Core Js -->--}}
{{--<script src="{{asset('bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->--}}
{{--<script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->--}}
{{--<script src="{{asset('plugin/autosize/autosize.js')}}"></script> <!-- Autosize Plugin Js -->--}}
{{--<script src="{{asset('plugin/momentjs/moment.js')}}"></script> <!-- Moment Plugin Js -->--}}
{{--<!-- Bootstrap Material Datetime Picker Plugin Js -->--}}
{{--<script src="{{asset('plugin/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>--}}
{{--<script src="{{asset('bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->--}}
{{--<script src="{{asset('js/morphing.js')}}"></script><!-- Custom Js -->--}}
{{--<script src="{{asset('js/pages/forms/basic-form-elements.js')}}"></script>--}}
{{--<script src="{{asset('js/ep_validate.js')}}"></script>--}}
{{--<script src="{{asset('js/pages/index.js')}}"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
<script  src="{{asset('js/appointment_index.js"')}}"></script>
</body>
</html>