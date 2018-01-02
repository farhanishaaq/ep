
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Answer patients question
@stop

@section('redBar')

@stop

@section('sliderContent')
@stop
@section('headScript')

    {{--<link src="{{ asset('css/jquery.rateyo.min.css') }}">--}}
@endsection



@section('content')
<div class="container">
    <h2>Asked question</h2>

        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3"><h4>{{$question}}</h4></div>


        <form class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3" method="post" action="{{route('answer.store')}}">
            <textarea style="resize: none" class="col-md-12" name="answer" id="answer" placeholder="Please Type your Answer" rows="6" cols="50"></textarea>
            <input type="hidden"  value="{{$questionId}}" name="questionId">
        <input type="submit" class="btn btn-danger " style="margin-top: 10px ;float: right">

        </form>




</div>
@section('scripts')
    <script>



    </script>

    @endsection



@endsection