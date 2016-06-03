{{-- employees.layouts.master --}}
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
@stop

@section('scripts')
    {{--<script src="{{asset('js/view-pages/employees/EmployeeForm.js')}}"></script>--}}
    <script>
        $(document).ready(function(){
            /*var options = {};
            var employeeForm = new EmployeeForm(window,document,options);
            employeeForm.initializeAll();*/
        });


    </script>
@stop