        @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
            {{ Form::open(array('action' => 'PatientsController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm', 'onsubmit' => 'checkForm()')) }}
        @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
            {{Form::model($patient, ['route' => ['patients.update', $patient->id], 'method' => 'put' , 'class' => "form-horizontal w100p ", 'id' => 'regForm'])}}
        @endif
        <h3 class="mT10 mB0 c3">Create Patient Form</h3>
        <hr class="w95p fL mT0" />
        <p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
        {{-- Start Errors Code Container Block --}}
        @if(count($errors))
        <ul class="error-container">
            <li>Solve Following Errors!</li>
            <li>
                <ul>
                    @foreach($errors->all("<li>:message</li>") as $message)
                            {{ $message }}
                    @endforeach
                </ul>
            </li>
        </ul>
        @endif
        {{-- End Errors Code Container Block --}}
        <section class="form-Section col-md-6 h695 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">User Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Patient Name</label>
                    <div class="col-xs-6">
                        <input type="text" id="name" name="name" required="true" value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control" placeholder="Employee Name">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Date of Birth</label>
                    <div class="col-xs-6">
                        <input type="text" id="dob" name="dob" required="true" value="{{{ Form::getValueAttribute('dob', null) }}}" class="form-control" placeholder="Date of Birth">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>
                @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Password</label>
                        <div class="col-xs-6">
                            <input type="password" id="password" name="password" required="true" value="{{{ Form::getValueAttribute('password', null) }}}" class="form-control" placeholder="Password">
                            <span id="errorPassword" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Confirm Password</label>
                    <div class="col-xs-6">
                        <input type="password" id="confirm_password" name="confirm_password" required="true" value="{{{ Form::getValueAttribute('password', null) }}}" class="form-control" placeholder="Confirm Password">
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Email</label>
                    <div class="col-xs-6">
                        <input type="email" id="email" name="email" required="true" value="{{{ Form::getValueAttribute('email', null) }}}" class="form-control" placeholder="Email">
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Gender</label>
                    <div class="col-xs-6">

                        {{radio_btn_group(array( 'Male' => 'Male', 'None' => '' , 'Female' => 'Female' ),'gender')}}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Age</label>
                    <div class="col-xs-6">
                        <input type="number" id="age" name="age" required="true" value="{{{ Form::getValueAttribute('age', null) }}}" class="form-control" placeholder="Age">
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">City</label>
                    <div class="col-xs-6">
                        <input type="text" id="city" name="city" required="true" value="{{{ Form::getValueAttribute('city', null) }}}" class="form-control" placeholder="City">
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Country</label>
                    <div class="col-xs-6">
                        {{country_drop_down()}}
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>
            </div>
        </section>
        <section class="form-Section col-md-6 h695 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">&nbsp;</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />


                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Address</label>
                    <div class="col-xs-6">
                        <input type="text" id="address" name="address" required="true" value="{{{ Form::getValueAttribute('address', null) }}}" class="form-control" placeholder="Address">
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Mobile</label>
                    <div class="col-xs-6">
                        <input type="text" id="phone" name="phone" value="{{{ Form::getValueAttribute('phone', null) }}}" class="form-control" placeholder="Mobile">
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">CNIC</label>
                    <div class="col-xs-6">
                        <input type="text" id="cnic" name="cnic" required="true" value="{{{ Form::getValueAttribute('cnic', null) }}}" class="form-control" placeholder="cnic">
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Additional Info</label>
                    <div class="col-xs-6">
                        <textarea type="text" id="note" name="note" rows="7" cols="20" class="form-control" placeholder="note">{{{ Form::getValueAttribute('note', null) }}}</textarea>
                        <span id="errorNote" class="field-validation-msg"></span>
                    </div>
                </div>

            </div>
        </section>
        <div class="col-xs-12 taR pR0 mT20">
            <input type="reset" id="reset" value="Reset" class="submit" />
            <input type="submit" id="createClose" value="Save and Close" class="submit" />
            <input type="submit" id="createContinue" name="createContinue" value="Save and Continue" class="submit" />
            <input type="submit" id="cancel" value="Cancel" class="submit" />
        </div>
        {{ Form::close() }}