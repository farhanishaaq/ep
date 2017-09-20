{{-- users.layouts.master --}}
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Create Prescriptions
@stop

@section('redBar')
    <div class = "user_logo">        <div class="header_1 wrap_3 color_3 login-bar">{{Auth::user()->company->name}}</div>
    </div>
@stop

@section('sliderContent')
@stop
<!--========================================================
                          CONTENT
=========================================================-->


@section('content')

    <div class="container">
        <h3 class="mT10 mB0 c3">View Prescription</h3>
        <hr class="w95p fL mT0" />
        <p class="col-xs-12 fL taR"></p>
        {{$_viewPrescription}}
        <div class="col-xs-12 taR pR0 mT20">
            <input type="button" id="cancel" value="Go Back" onclick="goTo('{{URL::previous()}}')" />
        </div>
    </div>
@stop

@section('scripts')
    {{--<script src="{{asset('js/view-pages/users/UserForm.js')}}"></script>--}}
    <script>
        $(document).ready(function(){
            /*var options = {};
             var employeeForm = new EmployeeForm(window,document,options);
             employeeForm.initializeAll();*/
        });


    </script>
@stop