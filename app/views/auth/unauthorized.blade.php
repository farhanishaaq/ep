@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Employees
@stop

@section('redBar')
    <div class = "user_logo">        <div class="header_1 wrap_3 color_3 login-bar">{{Auth::user()->company->name}}
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
    <div class="container un-auth-content taC">
        <div class="col-sm-12">
            <img src="{{asset('images/unauthorized.png')}}" />
            <h2 class="">You are not authorized user for this resource!</h2>
        </div>
    </div>
    {{--Please <a href="{{route('login')}}">login</a> with other user, or go <a href="{{Redirect::intended()}}">back</a>--}}
@stop

@section('scripts')
@stop
