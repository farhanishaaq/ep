
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Edit Doctor
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
<div class="container">
    <h2>Asked questions</h2>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Question</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @if($questions)
        @foreach($questions as $question)
            <tr>
                <td>{{$question->id}}</td>
                <td>{{$question->question}}</td>
                <td>
                    <a href="{{route('answer.create')}}/?questionId={{$question->id}}">Reply</a>
                    <a href="{{route('changeStatus')}}/?id={{$question->id}}">Decline</a>
                </td>
            </tr>

        @endforeach
        @endif


        </tbody>
    </table>




</div>
@section('scripts')
    <script>



    </script>

    @endsection



@endsection