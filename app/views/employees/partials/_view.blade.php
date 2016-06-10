        <h3 class="mT10 mB0 c3">Employee View</h3>
        <hr class="w95p fL mT0" />
        <p class="col-xs-12 fL taR"></p>
        <section class="form-Section col-md-6 h695 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">User Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Employee Name</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->name }}</label>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Email</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->email }}</label>
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Gender</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->gender }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Age</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->age }}</label>
                        <span id="errorPassword" class="field-validation-msg"></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">City</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->city }}</label>
                        <span id="errorCity" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Country</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->country }}</label>
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
                        <label class="form-control">{{ $employee->address }}</label>
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Mobile</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->phone }}</label>
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">CNIC</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->cnic }}</label>
                        <span id="errorAddress" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Role</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->role }}</label>
                        <span id="errorRole" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Branch Name</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->branch }}</label>
                        <span id="errorBranch" class="field-validation-msg"></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-5 control-label">Status</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->status }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Additional Info</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $employee->note }}</label>
                        <span id="errorNote" class="field-validation-msg"></span>
                    </div>
                </div>

            </div>
        </section>
        <div class="col-xs-12 taR pR0 mT20">
            <input type="button" id="cancel" value="Go Back" onclick="goTo('{{URL::previous()}}')" />
        </div>
