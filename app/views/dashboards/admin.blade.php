@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Company Admin Home
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
        <h3 class="mT10 mB15 c3 bdrB1">Dashboard Contents
            <p class="col-xs-3 fR taR p0 required-hint pT10"><kbd>Date: {{date('d-m-Y')}}</kbd></p>
        </h3>

        {{--<section class="form-Section col-sm-12 h100 fL mB15">
            <div class="container w100p">

            </div>
        </section>--}}

        {{-- ****Start Row 1*** --}}
        {{-- Daily Fee Collection Summary --}}
        <section class="form-Section col-sm-6 h350 fL mB15">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Daily Fee Collection Summary</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group col-xs-12">
                    <label class="col-xs-4 control-label c3">Expected Fee: </label>
                    <div class="col-xs-6">
                        <label class="c2b">{{$dailyFeeCollectionDataset['expectedFee']}} PKR</label>
                    </div>
                </div>
                <div class="form-group col-xs-12">
                    <label class="col-xs-4 control-label c3">Paid Fee: </label>
                    <div class="col-xs-6">
                        <label class="c2b">{{$dailyFeeCollectionDataset['paidFee']}} PKR</label>
                    </div>
                </div>
                <div class="form-group col-xs-12">
                    <label class="col-xs-4 control-label c3">Difference: </label>
                    <div class="col-xs-6">
                        <label class="c2b">{{$dailyFeeCollectionDataset['expectedFee'] - $dailyFeeCollectionDataset['paidFee']}} PKR</label>
                    </div>
                </div>
            </div>
        </section>


        {{-- Pie Chart --}}
        <section class="form-Section col-sm-6 h350 fL mB15">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Appointments Status Overview Chart</h3>
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
        {{-- Line Chart --}}
        <section class="form-Section col-sm-6 h600 fL mB15">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Appointments Per Week Analysis</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <div class="col-sm-12">
                    <canvas id="canvas"></canvas>
                </div>
            </div>
        </section>

        <section class="form-Section col-sm-6 h600 fL mB15">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Appointments Calendar</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <div class="col-sm-12">
                    <div id="appointmentsCalendar"></div>
                </div>
            </div>
        </section>
        {{-- ****End Row 2*** --}}
    </div>
@stop

@section('scripts')
    <link rel="stylesheet" href="{{asset('plugins/calendar/css/fullcalendar.min.css')}}" type="text/css">
    <script src="{{asset('plugins/calendar/js/fullcalendar.min.js')}}"></script>
    <script src="{{asset('js/view-pages/dashboards/Dashboard.js')}}"></script>
    <script>
        $(document).ready(function () {
            var options = {
                appointmentPieChartDataset: JSON.parse('{{$appointmentPieChartDatasetJson}}'),
                appointmentLineChartDataset: JSON.parse('{{$appointmentLineChartDatasetJson}}'),
                appointments: JSON.parse('{{$appointmentJson}}'),
            };
            var dasboard = new Dashboard(window, document, options);
            dasboard.initializeAll();
        });
    </script>
@stop