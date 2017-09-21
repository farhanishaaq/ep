@extends('layouts.master')

<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Edit Schedule
@stop

@section('redBar')
    <div class = "user_logo">        <div class="header_1 wrap_3 color_3 login-bar">            @if(isset(Auth::user()->company->name))            {{Auth::user()->company->name}}            @else                Easy Physician            @endif
        </div>
    </div>
@stop

@section('sliderContent')
@stop


@section('content')

    @foreach($errors->all("<p class='error'>:message</p>") as $message)
        {{ $message }}
    @endforeach
    <div class="container">
        {{$_view}}
    </div>

@stop