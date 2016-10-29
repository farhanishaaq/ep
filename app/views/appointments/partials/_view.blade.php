        <h3 class="mT10 mB0 c3">Appointment View</h3>
        <hr class="w95p fL mT0" />
        <p class="col-xs-12 fL taR"></p>

        <section class="form-Section col-md-12 h695 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Appointment Basic Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Appointment Date</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $appointment->date }}</label>
                        <span id="errorStatus" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Time Slot</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $appointment->timeslot->slot }}</label>
                        <span id="errorStatus" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Select Doctor</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $appointment->doctor->user->full_name }}</label>
                        <span id="errorEmployeeId" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Select Patient</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $appointment->patient->user->full_name }}</label>
                        <span id="errorPatientId" class="field-validation-msg"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Status</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ GlobalsConst::$APPOINTMENT_STATUSES[$appointment->status] }}</label>
                        <span id="errorStatus" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Checkup Fee</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $appointment->paid_fee }}</label>
                        <span id="errorFee" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Checkup Reason</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $appointment->checkup_detail }}</label>
                        <span id="errorStatus" class="field-validation-msg"></span>
                    </div>
                </div>
            </div>
        </section>
        <div class="col-xs-12 taR pR0 mT20">
            <input type="button" id="cancel" value="Go Back" onclick="goTo('{{URL::previous()}}')" />
        </div>
