@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Add New Allergy
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Add New Allergy
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
            <h3 class="mT10 mB0 c3">Create Allergy Form</h3>
            <hr class="w95p fL mT0" />
            <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
               <section class="form-Section col-md-12 h400 fL">
                <div class="container w100p">
                    <h3 class="mT15 mB0 c3">Allergy Basic Info</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />
                    <div class="form-group">
                        <label class="col-xs-3 control-label asterisk">Allergy Name*</label>
                        <div class="col-xs-8">
                            <input type="text" id="allergy_name" name="allergy_name" required="true" value="{{{ Form::getValueAttribute('allergy_name', null) }}}" class="form-control" placeholder="Allergy Name">
                            <span id="errorAllergyName" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label asterisk">Allergy Note</label>
                        <div class="col-xs-8">
                            <textarea type="text" id="allergy_note" name="allergy_note" rows="7" cols="20" class="form-control" placeholder="note">{{{ Form::getValueAttribute('allergy_note', null) }}}</textarea>
                            <span id="errorAllergyNote" class="field-validation-msg"></span>
                        </div>
                    </div>
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