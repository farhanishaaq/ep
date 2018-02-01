{{-- users.layouts.master --}}
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Create Prescriptions
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Easy Physician</div>
</div>
@stop

@section('sliderContent')
@stop
<!--========================================================
                          CONTENT
=========================================================-->


@section('content')

    <div class="container">
        {{$_form}}
    </div>
    <link href="{{ asset('css/medicine.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/medicine.js')}}" type="text/javascript"></script>
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