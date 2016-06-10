@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Administrator Home
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_home")
class="current"
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Welcome to Admin Home</div>
</div>
@stop

@section('sliderContent')@stop
<!--========================================================
                          CONTENT-1
=========================================================-->


<!---------------- Breadcrumbs ------------------>
{{--@section('breadcrumbs')--}}
    {{----}}
    {{--<div class="breadcrumb flat">--}}
      {{--<a href="admin_home" class="active">Home</a>--}}
      {{--<!-- <a href="#">Unused</a>--}}
      {{--<a href="#">Unused</a>--}}
      {{--<a href="#">Unused</a> -->--}}
    {{--</div>--}}
    {{----}}
{{--@stop--}}
<!---------------End of Breadcrumbs -------------->


@section('content')
			<div>
				<div class="menu" style="margin-left: 10%; margin-right: 10%">
					<a class="ferozi" href="employees">Manage Employees</a>
					<a class="blue" href="appointments">Manage Appointments</a>
					<a class="purple" href="dutydays">Doctor Schedules </a>
					{{--<a class="orange" href="patients" >Manage Patients </a>--}}
					{{--<a class="pink" href="searchPmr">Manage Medical Record</a>--}}
					{{--<a class="green" href="vitalSign">Add Vital Signs</a>--}}
					{{--<a class="ferozi" href="appPrescription">Prepare Prescription</a>--}}
					{{--<a class="green" href="app_proc"> Diagnostic Procedures	</a>--}}
					{{--<a class="blue" href="printPrescription" >Print Prescription </a>--}}
					{{--<a class="purple" href="showTestReports">Manage Test Reports</a>--}}
					{{--<a class="orange" href="printTestReports">Print Test Report</a>--}}
  					{{--<a class="pink" href="addCheckUpFee">Add Checkup Fee</a>--}}
					{{--<a class="green" href="checkupFeeInvoice">Print Checkup Invoice</a>--}}
					{{--<a class="ferozi" href="addTestFee" >Add Lab Test Fee </a>--}}
					{{--<a class="blue" href="testFeeInvoice">Print Test Invoice</a>--}}
					{{--<a class="orange" href="medicines" >Manage Medicines </a>--}}
					{{--<a class="orange" href="patientsReporting" >View Checked Patients</a>--}}
				</div>
			</div>

@stop