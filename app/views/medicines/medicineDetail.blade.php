{{-- users.layouts.master --}}
@extends('layouts.master')
<!--========================================================
                  TITLE
=========================================================-->
@section('title')
Search Medicines
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar"> Medicine Search
        {{--<div class="col-md-12 mL25 taL">Easy Physician</div>--}}
    </div>
</div>
@stop

@section('sliderContent')
@stop
<!--========================================================
              CONTENT
=========================================================-->
@section('content')






<br>
<br>
<br>




<script src="{{asset('js/medicine.js')}}" type="text/javascript"></script>
<link href="{{ asset('css/medicine.css') }}" rel="stylesheet">


@endsection
@stop