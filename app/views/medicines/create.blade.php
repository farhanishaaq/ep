@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Employee Registration
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
    <!--========================================================
                              CONTENT
    =========================================================-->


@section('content')
    @foreach($errors->all("<p class='error'>:message</p>") as $message)
        {{ $message }}
    @endforeach
    <div class="container">


        {{ Form::open(array('action' => 'MedicinesController@store', 'style' => 'padding: 40px', 'id' => 'regForm')) }}

        <h3 class="mT10 mB0 c3">Enter Medicines</h3>
        <hr class="w95p fL mT0"/>
        <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
        <section class="form-Section col-md-6 h695 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Medicine Info</h3>
                <hr class="w95p fL mT0"/>
                <hr class="w95p fL mT0"/>
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Medicine Name</label>

                    <div class="col-xs-6">
                        <input type="text" id="name" name="name" required="true"
                               value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control"
                               placeholder="Medicine Name">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Quantity</label>

                    <div class="col-xs-6">
                        <input type="text" id="quantity" name="quantity" required="true"
                               value="{{{ Form::getValueAttribute('password', null) }}}" class="form-control"
                               placeholder="quantity">
                        <span id="errorQuantity" class="field-validation-msg"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Description</label>

                    <div class="col-xs-6">
                        <textarea type="text" id="note" name="description" rows="7" cols="20" class="form-control"
                                  placeholder="Description">{{{ Form::getValueAttribute('note', null) }}}</textarea>
                        <span id="errorDescription" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="col-xs-12 taR pR0 mT20">
                    <input type="reset" id="reset" value="Reset" class="submit"/>
                    <input type="submit" id="create" value="Save && Close" class="submit"/>
                    <input type="submit" id="create" value="Save && Continue" class="submit"/>
                    <input type="submit" id="cancel" value="Cancel" class="submit"/>
                </div>
            </div>
        </section>

        {{ Form::close() }}
    </div>


@stop