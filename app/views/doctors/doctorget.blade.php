@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Doctors
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
<?php $cols = 5; ?>
@section('content')

        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Manage Doctors</h1>


    @foreach($users as $user)
        <?php
        $doctorId = $user->id;


        ?>
        {{{ $user->employee->doctor->user->full_name }}}

        {{ $user->id }}

    @endforeach

@stop
