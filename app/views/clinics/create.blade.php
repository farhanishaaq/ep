@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Company Registration
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Company Registration
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
             {{ Form::open(array('action' => 'AppointmentsController@store', 'class' => 'form-horizontal w100p', 'id' => 'regForm')) }}
                <h3 class="mT10 mB0 c3">Company Registration Form</h3>
                <hr class="w95p fL mT0" />
                <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
                
                @include('companies._form')
                
            {{ Form::close() }}
        </div>
@stop