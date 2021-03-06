{{-- users.layouts.master --}}
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Employee Registration
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
        {{$_form}}
    </div>
@stop

@section('scripts')
    <script src="{{asset('js/view-pages/users/UserForm.js')}}"></script>
    <script>
        $(document).ready(function(){
            var options = {};
            var userForm = new UserForm(window,document,options);
            userForm.initializeAll();
        });
    </script>
@stop