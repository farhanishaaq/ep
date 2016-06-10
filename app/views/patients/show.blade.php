@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Edit Patient
@stop

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
            {{--<div class="col-md-12 mL25 taL">Easy Physician</div>--}}
        </div>
    </div>
@stop

@section('sliderContent')
@stop
<!--========================================================
                          CONTENT
=========================================================-->
@section('content')

    <div class="container">
        {{$_view}}
    </div>
@stop

@section('scripts')
    <script src="{{asset('js/view-pages/patients/PatientsForm.js')}}"></script>
    <script>
        $(document).ready(function(){
            var options = {};
            var patientsForm = new PatientsForm(window,document,options);
            patientsForm.initializeAll();
        });
    </script>
@stop