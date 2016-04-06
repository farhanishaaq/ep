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
    <center>
        <div class="container">

            {{ Form::open(array('action' => 'DrugusagesController@store',  'class' =>"form-horizontal w100p ", 'id' => 'regForm','onsubmit' => 'checkForm()')) }}
            <h3 class="mT10 mB0 c3 taL">Add Drug Usages</h3>
            <hr class="w95p fL mT0"/>
            <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
            <section class="form-Section col-md-12 h695 fL">
                <div class="container w100p">
                    <h3 class="mT10 mB0 c3 taL">Add Drug Usages</h3>
                    <hr class="w95p fL mT0"/>
                    <div class="form-group">
                        <label class="col-xs-4 control-label asterisk fL">Drug Name*</label>

                        <div class="col-xs-7 fL">
                            <input type="text" id="drug_name" name="drug_name" required="true"
                                   value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control"
                                   placeholder="Drug Name e.g Panadol">
                            <span id="errorName" class="field-validation-msg"></span>
                            {{--{{ Form::input('text', 'drug_name', null, array('required' => 'true')) }}--}}
                        </div>


                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label asterisk fL">Usage Note*</label>

                        <div class="col-xs-7 fL">
                            <textarea id="usage_note" name="usage_note" required="true"
                                      value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control"
                                      placeholder="Enter Usage Detail For Medicine Here"></textarea>
                            <span id="errorName" class="field-validation-msg"></span>
                            {{--{{ Form::input('text', 'drug_name', null, array('required' => 'true')) }}--}}
                        </div>
                    </div>


                    {{--</div>--}}
                    {{--<td width="272"><label>Usage Note:</label></td>--}}
                    {{--<td width="333"--}}
                    {{--height="350">{{ Form::textarea('usage_note', null, array('rows' => '7', 'cols' => '20', 'placeholder' => 'note', "style" => "font-size: 1.2em; margin-top: 2px; resize: none;") ) }}</td>--}}
                    {{--</tr>--}}
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
    </center>

    <br><br>


@stop