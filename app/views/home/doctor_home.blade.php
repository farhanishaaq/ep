@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Doctor Home
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_home")
class="current"
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Welcome to Doctor Home</div>
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
					<a class="purple" href="{{URL::route('searchPmr')}}">View Medical Record</a>
					<a class="blue" href="{{route('vitalsigns.index')}}">View Vital Signs</a>
					<a class="orange" href="appointments">View Appointments</a>
				</div>
			</div>

    </section>
@stop
