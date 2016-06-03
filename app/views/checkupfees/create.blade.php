@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Create Checkup Fee
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Create Checkup Fee
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
            {{ Form::open(array('action' => 'CheckupfeesController@store', 'class' => 'form-horizontal w100p', 'id' => 'regForm')) }}
            <h3 class="mT10 mB0 c3">Checkup Fee Form</h3>
            <hr class="w95p fL mT0" />
            <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
            <section class="form-Section col-md-12 h400 fL">
                <div class="container w100p">
                    <h3 class="mT15 mB0 c3">Checkup Fee Basic Info</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />
                    <div class="form-group">
                        <label class="col-xs-3 control-label asterisk">Checkup Fee*</label>
                        <div class="col-xs-8">
                            <input type="number" id="checkup_fee" name="checkup_fee" required="true" value="{{{ Form::getValueAttribute('checkup_fee', null) }}}" class="form-control" placeholder="Checkup Fee">
                            <span id="errorCheckupFee" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label asterisk">Checkup Note</label>
                        <div class="col-xs-8">
                            <textarea type="text" id="fee_note" name="fee_note" rows="7" cols="20" class="form-control" placeholder="Fee Note">{{{ Form::getValueAttribute('fee_note', null) }}}</textarea>
                            <span id="errorFeeNote" class="field-validation-msg"></span>
                        </div>
                    </div>
                    {{--
                    
                    DO NOT REMOVE THIS CODE, WE NEED TO CHECK IT WHILE RUNNING
                    
                    <input name="patient_id" type="hidden" value="{{ $appointment->patient->id }}">
                    <input name="appointment_id" type="hidden" value="{{ $appointment->id }}">
                    
                    --}}
                </div>
            </section>
            <div class="col-xs-12 taR pR0 mT20">
                <input type="reset" id="reset" value="Reset" class="submit" />
                <input type="submit" id="create" value="Save && Close" class="submit" />
                <input type="submit" id="create" value="Save && Continue" class="submit" />
                <input type="submit" id="cancel" value="Cancel" class="submit" />
            </div>
            {{ Form::close() }}
        </div>
@stop