
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
            {{--<div class="col-md-12 mL25 taL">Easy Physician</div>--}}
        </div>
    </div>
@stop

@section('sliderContent')
@stop
@section('headScript')

    {{--<link src="{{ asset('css/jquery.rateyo.min.css') }}">--}}
@endsection
@section('content')
<div class="container" style="min-height: 500px">
    <h2>Asked questions</h2>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Question</th>
            <th>Status</th>
            <th class="center">Action</th>
        </tr>
        </thead>
        <tbody>

        @if($questions)
        @foreach($questions as $question)
            <tr>
                <td class="align-top">{{$question->id}}</td>
                <td>{{$question->question}}</td>
                <td>{{$question->status}}</td>
                <td class="center" style="min-width: 150px">
                    <a class="btn btn-primary" href="{{route('answer.create')}}/?questionId={{$question->id}}">Reply</a>

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
    <style>
        td, th {
            vertical-align:top;
        }
    </style>
    <script>



    </script>

    @endsection



@endsection