@extends('layouts.master')

<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Create Schedule
@stop

@section('sliderContent')
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
@show


@section('content')

    @foreach($errors->all("<p class='error'>:message</p>") as $message)
        {{ $message }}
    @endforeach

    <br/>
    <div class="container">
        {{ Form::open(array('action' => 'DutydaysController@store', 'style' => 'padding: 40px', 'id' => 'regForm')) }}
        <section class="form-Section col-md-12 h695 fL">
            <div class="container w100p">
                <hr class="w95p fL mT0"/>
                <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>

                <h3 class="mT10 mB0 c3 taL">Enter Duty Days</h3>
                <hr class="w95p fL mT0"/>
                <label class="col-xs-3 control-label asterisk fL">Select Doctors*</label>

                <div class="col-xs-8 fL">

                    {{--Employee id will be stored in workingdays table as FK--}}
                    {{ Form::select('employee_id', $doctors->lists('name', 'id'), null, ['required' => 'true', 'id' => 'employee_id'] ); }}
                </div>
                <div class="form-group">
                    {{--<label class="col-xs-3 control-label asterisk fL">Select Doctors*</label>--}}

                    {{--<div class="col-xs-8 fL">--}}

                        {{--Employee id will be stored in workingdays table as FK--}}
                        {{--{{ Form::select('employee_id', $doctors->lists('name', 'id'), null, ['required' => 'true', 'id' => 'employee_id'] ); }}--}}
                    {{--</div>--}}
                    <label class="col-xs-3 control-label asterisk fL">Sunday</label>

                    <div class="col-xs-8 fL">

                        {{ Form::checkbox('Sunday', 'Sunday', null, ['id' => 'sunday']) }}
                        {{ Form::input('text', 'sun_start_time', null, ['class' => 'timepicker', 'id' => 'sun_start_time']) }}
                        {{ Form::input('text', 'sun_end_time', null, ['class' => 'timepicker', 'id' => 'sun_end_time']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label asterisk fL">Monday</label>

                    <div class="col-xs-8 fL">

                        {{ Form::checkbox('Monday', 'Monday', null, ['id' => 'monday']) }}
                        {{ Form::input('text', 'mon_start_time', null, ['class' => 'timepicker', 'id' => 'mon_start_time']) }}
                        {{ Form::input('text', 'mon_end_time', null, ['class' => 'timepicker', 'id' => 'mon_end_time']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label asterisk fL">Tuesday</label>

                    <div class="col-xs-8 fL">

                        {{ Form::checkbox('Tuesday', 'Tuesday', null, ['id' => 'tuesday']) }}
                        {{ Form::input('text', 'tue_start_time', null, ['class' => 'timepicker', 'id' => 'tue_start_time']) }}
                        {{ Form::input('text', 'tue_end_time', null, ['class' => 'timepicker', 'id' => 'tue_end_time']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label asterisk fL">Wednesday</label>

                    <div class="col-xs-8 fL">

                        {{ Form::checkbox('Wednesday', 'Wednesday', null, ['id' => 'wednesday']) }}
                        {{ Form::input('text', 'wed_start_time', null, ['class' => 'timepicker', 'id' => 'wed_start_time']) }}
                        {{ Form::input('text', 'wed_end_time', null, ['class' => 'timepicker', 'id' => 'wed_end_time']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label asterisk fL">Thursday</label>

                    <div class="col-xs-8 fL">

                        {{ Form::checkbox('Wednesday', 'Wednesday', null, ['id' => 'wednesday']) }}
                        {{ Form::input('text', 'thu_start_time', null, ['class' => 'timepicker', 'id' => 'thu_start_time']) }}
                        {{ Form::input('text', 'thu_end_time', null, ['class' => 'timepicker', 'id' => 'thu_end_time']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label asterisk fL">Friday</label>

                    <div class="col-xs-8 fL">

                        {{ Form::checkbox('Friday', 'Friday', null, ['id' => 'friday']) }}
                        {{ Form::input('text', 'fri_start_time', null, ['class' => 'timepicker', 'id' => 'fri_start_time']) }}
                        {{ Form::input('text', 'fri_end_time', null, ['class' => 'timepicker', 'id' => 'fri_end_time']) }}

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label asterisk fL">Saturday</label>

                    <div class="col-xs-8 fL">

                        {{ Form::checkbox('Saturday', 'Saturday', null, ['id' => 'saturday']) }}
                        {{ Form::input('text', 'sat_start_time', null, ['class' => 'timepicker', 'id' => 'sat_start_time']) }}
                        {{ Form::input('text', 'sat_end_time', null, ['class' => 'timepicker', 'id' => 'sat_end_time']) }}

                    </div>
                </div>

                <div class="col-xs-12 taR pR0 mT20">
                    <input type="reset" id="reset" value="Reset" class="submit"/>
                    <input type="submit" id="create" value="Save && Close" class="submit"/>
                    <input type="submit" id="create" value="Save && Continue" class="submit"/>
                    <input type="submit" id="cancel" value="Cancel" class="submit"/>
                </div>
                {{ Form::close() }}
            </div>
        </section>
    </div>

    </center>

    <br><br>

@stop