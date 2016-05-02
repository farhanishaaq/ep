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

    <div class="container">
        {{$_form}}
    </div>
@stop