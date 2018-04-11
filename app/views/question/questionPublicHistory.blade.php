
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Questions History
@stop

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Question History

        </div>
    </div>
@stop

@section('sliderContent')

@stop
@section('headScript')

    {{--<link src="{{ asset('css/jquery.rateyo.min.css') }}">--}}
@endsection



@section('content')
<div class="container" style="min-height: 600px; padding-top: 20px">

        @if($questions)
        @foreach($questions as $question)

    <div>
        <div style="background-color: whitesmoke; border-radius: 5px;">
            <i class="fa fa-question" style="padding-top: 6px"></i> &nbsp;<strong>{{$question->question}} </strong> <br>
            <span class="pL20"><i class="fa fa-info-circle" style="padding-top: 8px"></i> &nbsp;
             @if($question->answer)
             {{$question->answer}}
             @else
             No Replay yet . . .
             @endif

           </span>
        </div>
    </div>
    <br>
        @endforeach
        @else
        <div style="margin-top: 150px; margin-bottom: 200px;">
                      <h2 class="center" style="color: dimgray;">Question History Is Empty Yet!</h2>
                      </div>
        @endif




    <div class="center" >
        <?php //echo $questions->links(); ?>

    </div>




</div>

@endsection
