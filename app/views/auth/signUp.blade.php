@extends('layouts.master')
<!--========================================================
   TITLE
   =========================================================-->
@section('title')
    EP-Sociale Doctors
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

                                {{--<section id="content">--}}
                                    {{--<div class="login">--}}
                                        {{--<div class="login-card login-page">--}}
                                            {{--@if(count($errors))--}}
                                                {{--<div class="col-md-12">--}}
                                                    {{--<ul class="error-container m10">--}}
                                                        {{--<li>Solve Following Errors!</li>--}}
                                                        {{--<li>--}}
                                                            {{--<ul>--}}
                                                                {{--@foreach($errors->all("<li>:message</li>") as $message)--}}
                                                                    {{--{{ $message }}--}}
                                                                {{--@endforeach--}}
                                                            {{--</ul>--}}
                                                        {{--</li>--}}
                                                    {{--</ul>--}}
                                                {{--</div>--}}

                                            {{--@endif--}}

                                            {{ Form::open(array('url' => 'doSignUp')) }}

                                            <input type="text" id = "fname" name="fname" placeholder="First Name" required="true">
                                            <input type="text" id = "lname" name="lname" placeholder="Last Name" required="true">
                                            <input type="email" id = "email" name="email" placeholder="Email" required="true">
                                            <input type="text" id = "username" name="username" placeholder="User Name" required="true">
                                            <input type="password" required="true" name="password" id="password" placeholder="Password">
                                              <input type="text" required="true" name="city" id="city" placeholder="City" >
                                            <input type="number" required="true" name="phone" id="number" placeholder="Phone Number" style="width: 100%;">
                                            <input type="submit" name="signUp" class="btn btn-raised btn-sm btn-1" value="Register">
                                            {{ Form::close() }}
                                            {{--</form>--}}
                 </div>
             </div>
    <div class="col-md-3" ></div>
</div>
    <br>
    <br><br><br><br>
    <br><br><br><br>
                            </div>
@endsection










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

{{--<script src="{{asset('js/pages/index.js')}}"></script>--}}

