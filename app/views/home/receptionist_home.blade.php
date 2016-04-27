@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Receptionist Home
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_home")
class="current"
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Welcome to Receptionist Home</div>
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
					<a class="ferozi" href="appointments">Manage Appointments</a>
					<a class="green" href="dutydays">Doctor Schedules</a>
					<a class="pink" href="patients">Manage Patients</a>
					<a class="purple" href="search_pmr">Manage Medical Record</a>
					<a class="blue" href="showVitalSign">Add Vital Signs</a>
					<a class="ferozi" href="app_prescription">Prepare Prescription</a>
					<a class="ferozi" href="app_pres_print">Print Prescription</a>
					<a class="purple" href="app_tests">Manage Test Reports</a>
					<a class="orange" href="app_test_print">Print Test Report</a>
					{{--<a class="green" href="app_proc"> Diagnostic Procedures	</a>--}}
				</div>
			</div>
		
       </section>
@stop