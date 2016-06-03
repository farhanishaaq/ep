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
    <div class="container">
        @foreach($errors->all("<p class='error'>:message</p>") as $message)
            {{ $message }}
        @endforeach
        <br/>
        {{ Form::open(array('action' => 'FamilyhistoriesController@store', 'style' => 'padding: 40px', 'id' => 'regForm')) }}
        <h3 class="mT10 mB0 c3 taL">Family History</h3>
        <hr class="w95p fL mT0"/>
        <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
        <section class="form-Section col-md-12 h695 fL">
            <div class="form-group">
                <label class="col-xs-4 control-label asterisk fL">Family Member Name</label>

                <div class="col-xs-7 fL">
                    {{ Form::input('text', 'f_member_name', null, array('required' => 'true','class'=>"form-control")) }}
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-4 control-label asterisk fL">Relation With Patient</label>

                <div class="col-xs-7 fL">
                    {{ Form::input('text', 'patient_relation', null, array('required' => 'true', 'class'=>"form-control")) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-4 control-label asterisk fL">Gender</label>

                <div class="col-xs-7 fL">
                    <label class="col-xs-4 control-label asterisk fL">
                        <input style="width: 30px" type="radio" required="true" name="gender" value="Male"
                               id="gender_0" class="form-control">
                        Male</label>

                    <label class="col-xs-4 control-label asterisk fL">
                        <input style="width: 30px" type="radio" required="true" name="gender" value="Female"
                               id="gender_1" class="form-control">
                        Female</label>

                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-4 control-label asterisk fL">Age</label>

                <div class="col-xs-7 fL">
                    <input type="number" id="age" required="true"
                           value="{{{ Form::getValueAttribute('age', null) }}}" name="age" class="form-control">

                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-4 control-label asterisk fL">Disease Notes</label>

                <div class="col-xs-7 fL">
                    <textarea id="diesease_note" name="diesease_note" required="true"
                              value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control"
                              placeholder="Enter Disease Notes"></textarea>
                </div>
            </div>
            <div class="col-xs-12 taR pR0 mT20">
                <input type="reset" id="reset" value="Reset" class="submit"/>
                <input type="submit" id="create" value="Save && Close" class="submit"/>
                <input type="submit" id="create" value="Save && Continue" class="submit"/>
                <input type="submit" id="cancel" value="Cancel" class="submit"/>
            </div>
            {{ Form::close() }}
        </section>
    </div>
    </section>
@stop