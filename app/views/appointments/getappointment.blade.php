@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Create Appointment
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Create Appointment
        </div>
    </div>
@stop

@section('sliderContent')
@stop


@section('content')


    <section class="form-Section col-md-12 h1000 fL">

        <div class="container w100p">
            <h3 class="mT15 mB0 c3">Appointment Basic Info</h3>
            <hr class="w95p fL mT0" />
            <hr class="w95p fL mT0" />

            <div class="form-group">
                <label class="col-md-1 control-label">Code</label>
                <div class="col-md-4 control-label">
                    <input type="text" id="code" name="code" value="" class="form-control" placeholder="Code">
                    <span id="error_code" class="field-validation-msg"></span>
                </div>
            </div><br><br>
            <br>

            <div class="form-group">
                <label class="col-xs-5 control-label asterisk">Select Doctor</label>
                <div class="col-xs-6">
                    {{--{{ make_doctor_drop_down($doctors, Form::getValueAttribute('doctor_id', null)) }}--}}
                    <span id="error_doctor_id" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-5 control-label asterisk">Select Patient</label>
                <div class="col-xs-6">
                    {{--{{ Form::select('patient_id', ["" => 'Select Patient'] + $patients->lists('full_name', 'id'), null, ['id' => 'patient_id'] ); }}--}}
                    <span id="error_patient_id" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-5 control-label asterisk">Status</label>
                <div class="col-xs-6">
                    {{--{{ Form::select('status', ['0' => 'Reserved', '1' => 'Waiting',
              '2' => 'Check-in', '3' => 'No Show', '4' => 'Cancelled', '5' => 'Closed'], null, ['required' => 'true', 'id' => 'status'] ); }}
              --}}
                    {{--{{ Form::select('status', ["" => 'Select Status']+ GlobalsConst::$APPOINTMENT_STATUSES, null, ['required' => 'true', 'id' => 'status'] ); }}--}}
                    <span id="error_status" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-5 control-label asterisk">Checkup Detail</label>
                <div class="col-xs-6 hAi">
                    <textarea type="text" id="checkup_detail" name="checkup_detail" rows="7" cols="20" class="form-control" placeholder="note">{{{ Form::getValueAttribute('checkup_reason', null) }}}</textarea>
                    <span id="error_checkup_detail" class="field-validation-msg"></span>
                </div>
            </div>
        </div>




    </section>


@stop