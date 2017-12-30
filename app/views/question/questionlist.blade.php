@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Question List
@stop

@section('redBar')
    <div >

    </div>
@stop

@section('sliderContent')
@stop
@section('headScript')

    {{--<link src="{{ asset('css/jquery.rateyo.min.css') }}">--}}
@endsection

@section('content')

fdsfds
@foreach($questions as $question)

    {{$question->question}}
<br>
    @endforeach


    @stop