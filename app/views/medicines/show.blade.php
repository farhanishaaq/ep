{{-- users.layouts.master --}}
@extends('layouts.master')
        <!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Show Medicine
@stop

@section('redBar')
    <div class = "user_logo">        <div class="header_1 wrap_3 color_3 login-bar">            @if(isset(Auth::user()->company->name))            {{Auth::user()->company->name}}            @else                Easy Physician            @endif
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