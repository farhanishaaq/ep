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
    <div class="user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Welcome to Admin Dashboard</div>
    </div>
    @stop

    @section('sliderContent')@stop
            <!--========================================================
                          CONTENT
=========================================================-->
@section('content')
    <div class="container">
        <h3 class="mT10 mB15 c3 bdrB1">Dashboard Contents<p class="col-xs-3 fR taR p0 required-hint pT10"></p></h3>

        {{-- ****Start Row 1*** --}}
        {{-- Line Chart --}}
        <section class="form-Section col-sm-6 h350 fL mB15">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Patient Per Week</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <div class="col-sm-12">
                    <canvas id="canvas"></canvas>
                </div>
            </div>
        </section>

        {{-- Pie Chart --}}
        <section class="form-Section col-sm-6 h350 fL mB15">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Appointments Overview Chart</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <div class="col-sm-12">
                    <div class="col-sm-12" id="canvas-holder" >
                        <canvas id="chart-area" class="w200 h200" />
                    </div>
                </div>
            </div>
        </section>
        {{-- ****End Row 1*** --}}

        {{-- ****Start Row 2*** --}}
        <section class="form-Section col-sm-6 h260 fL mB15">
            <div class="container w100p">
                <div class="col-sm-12">
                    Data Goes Here
                </div>
            </div>
        </section>

        <section class="form-Section col-sm-6 h260 fL mB15">
            <div class="container w100p">
                <div class="col-sm-12">
                    Data Goes Here
                </div>
            </div>
        </section>
        {{-- ****End Row 2*** --}}
    </div>
@stop

@section('scripts')
    <script src="{{asset('js/view-pages/dashboards/employee-dashboard.js')}}"></script>
    <script>
        $(document).ready(function () {
            var total_fee = JSON.parse('{{$total_fee}}');
            var appointments = JSON.parse('{{$appointments}}');
            var status = JSON.parse('{{$status}}');
            if (((total_fee && appointments && status) == null) || ((total_fee && appointments && status) == '')) {
                total_fee = ['20000', '25000', '45000', '10000'];
                appointments = [];
                status = ['completed', 'incomplete', 'rejected', 'pending'];
            }
            var options = {
                days: JSON.parse("{{$days}}"),
                totalPatients: JSON.parse("{{$totalPatients}}"),
                total_fee: total_fee,
                appointments: appointments,
                status: status
            };
            var employeeDasboard = new EmployeeDasboard(window, document, options);
            employeeDasboard.initializeAll();
        });
    </script>
@stop