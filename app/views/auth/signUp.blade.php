@extends('layouts.master')
<!--========================================================
   TITLE
   =========================================================-->
@section('title')
    Sign Up
@stop
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Welcome to Sign Up</div>
    </div>
@stop
@section('sliderContent')
@stop
<!--========================================================
   CONTENT
   =========================================================-->
@section('content')

<div class="row">
<div class="col-md-12">
    <div class="col-md-3" ></div>
             <div class="col-md-6">
                 <div class="login-card login-page">
                     <form action="{{URL::route('doSignUp') }}" method="post" name="form" onsubmit="return checkError()">

                     <input type="text" id ="fname" name="fname" placeholder="First Name" required="true">
                    <input type="text" id ="lname" name="lname" placeholder="Last Name" required="true">

                         <input type="email" name="email" placeholder="Email Address" id="email" onblur="checkemail()">
                         <span id="email_status"></span>
                     <input type="text" placeholder="User Name" name="userName" id="userName" onblur="checkUserName()">
                         <span id="userName_status"></span>

                    <input type="password" required="true" name="password" id="password" placeholder="Password">
                         <select class="js-example-basic-single" id="city" name="city">
                             <option class="vhid"></option>
                             @foreach($cities as $city)
                                 <option value="{{$city['id']}}">{{$city['name']}}</option>
                             @endforeach
                         </select>
                    <input type="number" required="true" name="phone" id="number" placeholder="Phone Number" style="width: 100%;">
                         <input  type="submit" class="btn btn-raised btn-sm btn-1"  value="Register" id="submitButton">
                     </form>
                 </div>
            </div>
        <div class="col-md-3" ></div>
    </div>
<br>
<br><br><br><br>
<br><br><br><br>
</div>
<script src="{{asset('js/emailAvailability.js')}}"></script>
@endsection























{{--<input type="text" id ="fname" name="fname" placeholder="First Name" required="true">--}}
{{--<input type="text" id ="lname" name="lname" placeholder="Last Name" required="true">--}}

{{--<input type="email" placeholder="Email Address" name="email" id="regemail">--}}
{{--<span class="clearfix"></span><span class="erroremail register-error-block"></span>--}}
{{--<input type="text" placeholder="User Name" name="userName" id="userName">--}}
{{--<span class="clearfix"></span><span class="errortag register-error-block"></span>--}}
{{--<input type="password" required="true" name="password" id="password" placeholder="Password">--}}
{{--<select class="js-example-basic-single" id="city" name="city">--}}
    {{--<option class="vhid"></option>--}}
    {{--@foreach($cities as $city)--}}
        {{--<option value="{{$city['id']}}">{{$city['name']}}</option>--}}
    {{--@endforeach--}}
{{--</select>--}}
{{--<input type="number" required="true" name="phone" id="number" placeholder="Phone Number" style="width: 100%;">--}}
{{--<input type="submit" class="btn btn-raised btn-sm btn-1" value="Register">--}}