@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Company Registration
@stop

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Easy Physician</div>
    </div>
@stop

@section('sliderContent')
@stop
<!--========================================================
                          CONTENT
=========================================================-->
@section('content')

    <div class="container">
        {{$_form}}
    </div>
@stop

