
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Questions Asked
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
                <td style="max-width: 50%">{{$question->question}}</td>
                <td>
                    <a  class="btn btn-primary" href="{{route('answer.create')}}/?questionId={{$question->id}}">Reply</a>

                </td>
                <td>
                    <a class="btn btn-danger" href="{{route('changeStatus')}}/?id={{$question->id}}">Decline</a>
                </td>
            </tr>

        @endforeach
        @endif


        </tbody>
    </table>

    <div class="center" >
        <?php echo $questions->links(); ?>

    </div>




</div>
@section('scripts')
    <script>



    </script>

    @endsection



@endsection