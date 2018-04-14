@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Questions Asked
@stop

@section('sliderContent')

@stop

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">
            Asked Question
        </div>
    </div>
@stop

@section('headScript')

    {{--<link src="{{ asset('css/jquery.rateyo.min.css') }}">--}}
@endsection



@section('content')
<div class="container"><br>

<span>
@if(Auth::check())
@if(isset($question->id))
  @if(Auth::user()->user_type != \App\Globals\GlobalsConst::DOCTOR)
  <span class=""><a  href="{{ URL::route('login')}}" type="submit" style="color: white"><button class="btn btn-raised btn-sm btn-1" > Ask A Question </button></a></span>
@endif
@endif
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
                    <a  class="btn btn-primary" href="{{url('ep/public/answer/create')}}/?questionId={{$question->id}}">Reply</a>

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



@else
<div style="margin-top: 150px; margin-bottom: 240px;">
@if(Auth::check())
  @if(Auth::user()->user_type != \App\Globals\GlobalsConst::DOCTOR)
  <span class=""><a  href="{{ URL::route('login')}}" type="submit" style="color: white"><button class="btn btn-raised btn-sm btn-1" > Ask A Question </button></a></span>
@endif
@endif
<h2 class="center" style="color: dimgray;">No Question History for Now!</h2>
</div>
@endif

</span>






</div>
@section('scripts')
    <script>



    </script>

    @endsection



@endsection