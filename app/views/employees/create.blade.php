{{-- employees.layouts.master --}}
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Employee Registration
@stop

@section('redBar')
<div class = "user_logo">
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
    <div class="container">

        {{ Form::open(array('action' => 'EmployeesController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm', 'onsubmit' => 'checkForm()')) }}
        <h3 class="mT10 mB0 c3">Create Employee Form</h3>
        <hr class="w95p fL mT0" />
        <p class="col-xs-11 fL taR">Required Fields <kbd>*</kbd></p>
        <section class="form-Section col-md-6 mT5 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">User Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Employee Name</label>
                    <div class="col-xs-6">
                        <input type="text" id="name" name="name" required="true" value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control" placeholder="Employee Name">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Password</label>
                    <div class="col-xs-6">
                        <input type="password" id="password" name="password" required="true" value="{{{ Form::getValueAttribute('password', null) }}}" class="form-control" placeholder="Password">
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Confirm Password</label>
                    <div class="col-xs-6">
                        <input type="password" id="confirm_password" name="confirm_password" required="true" value="{{{ Form::getValueAttribute('password', null) }}}" class="form-control" placeholder="Password">
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Email</label>
                    <div class="col-xs-6">
                        <input type="email" id="email" name="email" required="true" value="{{{ Form::getValueAttribute('password', null) }}}" class="form-control" placeholder="Password">
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8">Gender</label>
                    <div class="col-xs-6">
                        <label class="switch switch-green">
                            <input type="checkbox" required="true" class="switch-input">
                            {{--<span class="switch-label" data-on="Yes" data-off="No"></span>--}}
                            <span class="switch-label" data-on="Male" data-off="Female"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <span id="errorGender" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Age</label>
                    <div class="col-xs-6">
                        <input type="number" id="age" name="age" required="true" value="{{{ Form::getValueAttribute('age', null) }}}" class="form-control" placeholder="Age">
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">City</label>
                    <div class="col-xs-6">
                        <input type="text" id="city" name="city" required="true" value="{{{ Form::getValueAttribute('city', null) }}}" class="form-control" placeholder="City">
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Country</label>
                    <div class="col-xs-6">
                        <select id="country" name="country" required="true" value="{{{ Form::getValueAttribute('country', null) }}}" class="form-control" placeholder="country">
                        </select>
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>
            </div>
        </section>
        <section class="form-Section col-md-6 T5 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">&nbsp;</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />


                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Address</label>
                    <div class="col-xs-6">
                        <input type="text" id="address" name="address" required="true" value="{{{ Form::getValueAttribute('address', null) }}}" class="form-control" placeholder="Address">
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Mobile</label>
                    <div class="col-xs-6">
                        <input type="text" id="mobile" name="mobile" required="true" value="{{{ Form::getValueAttribute('mobile', null) }}}" class="form-control" placeholder="Mobile">
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">CNIC</label>
                    <div class="col-xs-6">
                        <input type="text" id="cnic" name="cnic" required="true" value="{{{ Form::getValueAttribute('cnic', null) }}}" class="form-control" placeholder="cnic">
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Role</label>
                    <div class="col-xs-6">
                        <select id="role" name="role" required="true">
                          <option selected value="" disabled>Select Role</option>
                          {{--<option value="Administrator">Administrator</option>--}}
                          <option value="Doctor">Doctor</option>
                          <option value="Accountant">Accountant</option>
                          <option value="Receptionist">Receptionist</option>
                          <option value="Lab Manager">Lab Manager</option>
                        </select>
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Branch Name</label>
                    <div class="col-xs-6">
                        <select id="bole" name="branch" required="true">
                            <option value="N/A" selected disabled>Select Branch</option>
                            <option value="DHA">DHA</option>
                            <option value="Gulberg">Gulberg</option>
                            <option value="Canal View">Canal View</option>
                            <option value="Garden Town">Garden Town</option>
                            <option value='Johar Town'>Johar Town</option>
                        </select>
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-5 control-label mT8">Status</label>
                    <div class="col-xs-6">
                        <label class="switch switch-green">
                            <input type="checkbox" required="true" class="switch-input">
                            {{--<span class="switch-label" data-on="Yes" data-off="No"></span>--}}
                            <span class="switch-label" data-on="Active" data-off="Inactive"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <span id="errorStatus" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label mT8 asterisk">Additional Info</label>
                    <div class="col-xs-6">
                        <textarea type="text" id="note" name="note" rows="7" cols="20" class="form-control" placeholder="note">{{{ Form::getValueAttribute('cnic', null) }}}</textarea>
                        <span id="errorNote" class="field-validation-msg"></span>
                    </div>
                </div>

            </div>
        </section>
        <div class="col-xs-12 taR pR72">
            <input type="reset" id="reset" value="Reset" class="submit" />
            <input type="submit" id="create" value="Save && Close" class="submit" />
            <input type="submit" id="create" value="Save && Continue" class="submit" />
            <input type="submit" id="cancel" value="Cancel" class="submit" />
        </div>
        {{ Form::close() }}
    </div>
@stop