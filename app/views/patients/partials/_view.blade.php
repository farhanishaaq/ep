        <h3 class="mT10 mB0 c3">Patient View</h3>
        <hr class="w95p fL mT0" />
        <p class="col-xs-12 fL taR"></p>
        <section class="form-Section col-md-12 h695 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Patient Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Patient Name</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->name }}</label>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Date of Birth</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->dob }}</label>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Email</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->email }}</label>
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Gender</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->gender }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Age</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->age }}</label>
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">City</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->city }}</label>
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Country</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->country }}</label>
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Address</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->address }}</label>
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Mobile</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->phone }}</label>
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">CNIC</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->cnic }}</label>
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Additional Info</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $patient->note }}</label>
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>

            </div>
        </section>
        <div class="col-xs-12 taR pR0 mT20">
            <input type="button" id="cancel" value="Go Back" onclick="goTo('{{URL::previous()}}')" />
        </div>