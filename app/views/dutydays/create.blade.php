@extends('layouts.master')

<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Create Schedule
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
    </div>
</div>
@stop

@section('sliderContent')
@stop


@section('content')

    @foreach($errors->all("<p class='error'>:message</p>") as $message)
        {{ $message }}
    @endforeach

    <br/>
    <div class="container">
        {{ Form::open(array('action' => 'DutydaysController@store','class' => "form-horizontal w100p ", 'id' => 'dutyDaysForm')) }}
        <section class="form-Section col-md-12 h800 fL">
            <div class="container w100p">
                <hr class="w95p fL mT0"/>
                <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
                <h3 class="mT10 mB0 c3 taL">Enter Duty Days</h3>
                <hr class="w95p fL mT0"/>

                <div class="form-group">
                    <label class="col-xs-2 control-label asterisk">Select Doctors</label>
                    <div class="col-xs-8">
                        {{ Form::select('employee_id', $doctors->lists('name', 'id'), null, ['required' => 'true', 'id' => 'employee_id'] ); }}
                        <span id="errorEmployeeId" class="field-validation-msg"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label asterisk">Sunday</label>
                    <div class="col-xs-9">
                        {{ Form::input('text', 'sun_start_time', null, ['class' => 'timepicker', 'id' => 'sun_start_time', 'placeholder'=>'Start Date']) }}
                        {{ Form::input('text', 'sun_end_time', null, ['class' => 'timepicker', 'id' => 'sun_end_time', 'placeholder'=>'End Date']) }}
                        {{ switch_btn_group(['fieldName'=>'Sunday','onVal'=>'Active','offVal'=>'Inactive'])}}
                        <span id="errorEmployeeId" class="field-validation-msg"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label asterisk">Monday</label>
                    <div class="col-xs-9">
                        {{ Form::input('text', 'mon_start_time', null, ['class' => 'timepicker', 'id' => 'mon_start_time', 'placeholder'=>'Start Date']) }}
                        {{ Form::input('text', 'mon_end_time', null, ['class' => 'timepicker', 'id' => 'mon_end_time', 'placeholder'=>'End Date']) }}
                        {{ switch_btn_group(['fieldName'=>'Monday','onVal'=>'Active','offVal'=>'Inactive'])}}
                        <span id="errorEmployeeId" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-2 control-label asterisk">Tuesday</label>
                    <div class="col-xs-9">
                        {{ Form::input('text', 'tue_start_time', null, ['class' => 'timepicker', 'id' => 'tue_start_time', 'placeholder'=>'Start Date']) }}
                        {{ Form::input('text', 'tue_end_time', null, ['class' => 'timepicker', 'id' => 'tue_end_time', 'placeholder'=>'End Date']) }}
                        {{ switch_btn_group(['fieldName'=>'Tuesday','onVal'=>'Active','offVal'=>'Inactive'])}}
                        <span id="errorEmployeeId" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-2 control-label asterisk">Wednesday</label>
                    <div class="col-xs-9">
                        {{ Form::input('text', 'wed_start_time', null, ['class' => 'timepicker', 'id' => 'wed_start_time', 'placeholder'=>'Start Date']) }}
                        {{ Form::input('text', 'wed_end_time', null, ['class' => 'timepicker', 'id' => 'wed_end_time', 'placeholder'=>'End Date']) }}
                        {{ switch_btn_group(['fieldName'=>'Wednesday','onVal'=>'Active','offVal'=>'Inactive'])}}
                        <span id="errorEmployeeId" class="field-validation-msg"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-xs-2 control-label asterisk">Thursday</label>
                    <div class="col-xs-9">
                        {{ Form::input('text', 'thu_start_time', null, ['class' => 'timepicker', 'id' => 'thu_start_time', 'placeholder'=>'Start Date']) }}
                        {{ Form::input('text', 'thu_end_time', null, ['class' => 'timepicker', 'id' => 'thu_end_time', 'placeholder'=>'End Date']) }}
                        {{ switch_btn_group(['fieldName'=>'Thursday','onVal'=>'Active','offVal'=>'Inactive'])}}
                        <span id="errorEmployeeId" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-2 control-label asterisk">Friday</label>
                    <div class="col-xs-9">
                        {{ Form::input('text', 'fri_start_time', null, ['class' => 'timepicker', 'id' => 'fri_start_time', 'placeholder'=>'Start Date']) }}
                        {{ Form::input('text', 'fri_end_time', null, ['class' => 'timepicker', 'id' => 'fri_end_time', 'placeholder'=>'End Date']) }}
                        {{ switch_btn_group(['fieldName'=>'Friday','onVal'=>'Active','offVal'=>'Inactive'])}}
                        <span id="errorEmployeeId" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-2 control-label asterisk">Saturday</label>
                    <div class="col-xs-9">
                        {{ Form::input('text', 'sat_start_time', null, ['class' => 'timepicker', 'id' => 'sat_start_time', 'placeholder'=>'Start Date']) }}
                        {{ Form::input('text', 'sat_end_time', null, ['class' => 'timepicker', 'id' => 'sat_end_time', 'placeholder'=>'End Date']) }}
                        {{ switch_btn_group(['fieldName'=>'Saturday','onVal'=>'Active','offVal'=>'Inactive'])}}
                        <span id="errorEmployeeId" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="col-xs-10 taR pR0 mT20">
                    <input type="reset" id="reset" value="Reset" class="submit"/>
                    <input type="submit" id="create" value="Save && Close" class="submit"/>
                    <input type="submit" id="create" value="Save && Continue" class="submit"/>
                    <input type="submit" id="cancel" value="Cancel" class="submit"/>
                </div>
                {{ Form::close() }}
            </div>
        </section>
    </div>
@stop

@section('scripts')
<script>
    //**** For Country
    $("#employee_id").select2();
</script>
@stop