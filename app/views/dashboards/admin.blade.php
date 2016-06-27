@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Super User Home
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_super_home")
active
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Super User Home</div>
</div>
@stop

@section('sliderContent')@stop
<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
<section id="content">
    <div>
        <div class="menu" style="margin-left: 10%; margin-right: 10%">
            <a class="ferozi" href="companies">Manage Companies</a>
            <a class="purple" href="companies">Manage Branches</a>
        </div>
    </div>
</section>
@stop