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
            <body>
            <div style="width:45%;">
                <canvas id="canvas"></canvas>
            </div>
            <div id="canvas-holder" style="width:40%">
                <canvas id="chart-area" width="300" height="300"/>
            </div>
            </body>
            <div class="menu" style="margin-left: 10%; margin-right: 10%">
                <a class="ferozi" href="companies">Manage Companies</a>
                <a class="purple" href="companies">Manage Branches</a>
                <?php ?>
                <a class="purple" href="companies">{{{$totalRecieved}}}</a>
            </div>
        </div>


    </section>
@stop

@section('scripts')
    <script src="{{asset('js/view-pages/dashboards/employee-dashboard.js')}}"></script>
    <script>
        $(document).ready(function () {
            var total_fee = JSON.parse("{{$total_fee}}");
            var appointments = JSON.parse("{{$appointments}}");
            var status = JSON.parse("{{$status}}");
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