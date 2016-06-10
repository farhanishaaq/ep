@extends('layouts.master')

<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Create Schedule
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
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
        {{$_form}}
    </div>

@stop

