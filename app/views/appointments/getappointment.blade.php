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
                    {{--<input type="password" required="true" name="password" id="password" placeholder="Password">--}}
                    {{--<input type="text" required="true" name="city" id="city" placeholder="City" >--}}
                    <input type="number" required="true" name="phone" id="number" placeholder="Phone Number" style="width: 100%;">
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



@stop