@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Lab Manager Home
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_home")
class="current"
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Welcome to Lab Manager Home</div>
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
				<center>
					<a class="ferozi" href="app_tests?flag=results">Manage Test Results</a>
					
					<a class="purple" href="app_test_print">Print Test Report</a>
				</center>
				</div>
			</div>
		
    </section>
@stop