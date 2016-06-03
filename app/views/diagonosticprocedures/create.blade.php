@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Add New Drug
@stop

@section('redBar')
    <div class="user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
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

    @foreach($errors->all("<p class='error'>:message</p>") as $message)
        {{ $message }}
    @endforeach

    <br/>
    <div class="container">

        {{ Form::open(array('action' => 'DiagonosticproceduresController@store', 'style' => 'padding: 40px', 'id' => 'regForm')) }}
        <h3 class="mT10 mB0 c3 taL">Diagonostic Procedure</h3>
        <hr class="w95p fL mT0"/>
        <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
        <section class="form-Section col-md-12 h695 fL">
            <div class="form-group">
                <label class="col-xs-4 control-label asterisk fL">Usage Note*</label>

                <div class="col-xs-7 fL">
                    <textarea id="procedure_note" name="procedure_note" required="true"
                              value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control"
                              placeholder="Enter Usage Detail For Medicine Here"></textarea>


                    <span id="errorName" class="field-validation-msg"></span>
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
        </section>
    </div>
@stop