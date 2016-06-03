@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Create Lab Test
    @stop


            <!--========================================================
                          CONTENT
=========================================================-->
@section('redBar')
    <div class="user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
            {{--<div class="col-md-12 mL25 taL">Easy Physician</div>--}}
        </div>
    </div>
@stop
@section('sliderContent')
@stop


@section('content')

    <div class="container">
        @foreach($errors->all("<p class='error'>:message</p>") as $message)
            {{ $message }}
        @endforeach
        <br/>
        {{ Form::open(array('action' => 'LabtestsController@store', 'style' => 'padding: 40px', 'id' => 'regForm')) }}
        <div class="form-group">
            <label class="col-xs-4 control-label asterisk fL">Test Name</label>

            <div class="col-xs-7 fL">
                {{ Form::input('text', 'test_name', null, array('required' => 'true','class'=>"form-control")) }}
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 control-label asterisk fL">Description</label>

            <div class="col-xs-7 fL">
                {{ Form::input('text', 'test_description', null, array('required' => 'true','class'=>"form-control")) }}
            </div>
        </div>

        <input name="patient_id" type="hidden" value="{{ $appointment->patient->id }}">
        <input name="appointment_id" type="hidden" value="{{ $appointment->id }}">

        <div class="col-xs-12 taR pR0 mT20">
            <input type="reset" id="reset" value="Reset" class="submit"/>
            <input type="submit" id="create" value="Save && Close" class="submit"/>
            <input type="submit" id="create" value="Save && Continue" class="submit"/>
            <input type="submit" id="cancel" value="Cancel" class="submit"/>
        </div>
        {{ Form::close() }}
    </div>
    </center>

    <br><br>


@stop