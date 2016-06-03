@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Accountant Home
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_home")
class="current"
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Welcome to Accountant Home</div>
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
					<a class="ferozi" href="app_check_fee">Manage Checkup Fee</a>

					<a class="purple" href="app_checkup_fee_print">Print Checkup Invoice</a>
					<a class="blue" href="app_test_fee">Manage Test Fee</a>

					<a class="pink" href="app_test_fee_print">Print Test Invoice</a>
				</div>
			</div>
    </section>
@stop
