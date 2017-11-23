@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Create Appointment
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Create Appointment
        </div>
    </div>
@stop

@section('sliderContent')
@stop


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3" ></div>
            <div class="col-md-6">
                <div class="login-card login-page">



                    {{--{{ Form::open(array('url' => 'doSignUp')) }}--}}

                    <input type="text" id = "fname" name="first_name" placeholder="First Name" required="true">
                    <input type="text" id = "lname" name="last_name" placeholder="Last Name" required="true">
                    <input type="email" id = "email" name="email" placeholder="Email" required="true">
                    <input type="number" required="true" name="phone" id="number" placeholder="Phone Number" style="width: 100%;">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Doctor's duty days</b>
                           <div class="profile-desc-item fa-pull-right">Monday To Friday</div>
                        </li>
                    </ul>
                      <div class='input-group date' id='datetimepicker5'>
                       <input type='text' class="login-card login-page" placeholder="Set Appointment Date" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                         </span>
                      </div>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Doctor's time slot</b>
                            <div class="profile-desc-item pull-right">4:30 To 9:00</div>
                        </li>
                    </ul>
                    <div class='input-group date' id='timepicker3'>
                        <input type='text' class="login-card login-page" placeholder="Set Appointment Time" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>


                    <input style="width:100%" type="submit" name="signUp" class="login login-submit" value="SUBMIT">
                    {{--{{ Form::close() }}--}}
                    {{--</form>--}}
                </div>
            </div>
            <div class="col-md-3" ></div>
        </div>


        <br>
        <br><br><br><br>
        <br><br><br><br>
    </div>


    <script src="{{asset('js/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" ></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#datetimepicker5').datepicker();
        });
    </script>
    <script src="{{asset('js/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" ></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-timepicker/js/bootstrap-timepicker-init.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#timepicker3').clockpicker({
                format: 'LT'
            });
        });
    </script>





@stop