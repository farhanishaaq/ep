        @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
            {{ Form::open(array('action' => 'AppointmentsController@store', 'class' => 'form-horizontal w100p', 'id' => 'regForm')) }}
        @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
            {{ Form::model($appointment, ['route' => ['appointments.update', $appointment->id], 'method' => 'put' ,'class' => 'form-horizontal w100p ', 'id' => 'regForm'])}}
        @endif
        <h3 class="mT10 mB0 c3">Create Appointment Form</h3>
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
 <section class="form-Section col-md-6 h400 fL">
                <div class="container w100p">
                    <h3 class="mT15 mB0 c3">Appointment Basic Info</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Select Doctor</label>
                        <div class="col-xs-6">
                    {{ Form::select('employee_id', $doctors->lists('name', 'id'), null, ['required' => 'true', 'id' => 'employee_id'] ); }}
                            <span id="errorEmployeeId" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Select Date</label>
                        <div class="col-xs-6">
                            <input type="date" id="date" name="date" required="true" value="{{{ Form::getValueAttribute('date', null) }}}" class="form-control" placeholder="mm/dd/yyyy">
                            <span id="errorDate" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Select Time Slot</label>
                        <div class="col-xs-6">
                            {{ Form::select('timeslot_id', [1=>'19:36:57'], null, ['required' => 'true', 'id' => 'time_slot_id'] ); }}
                            <span id="errorTimeslotId" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Select Patient</label>
                        <div class="col-xs-6">
                            {{ Form::select('patient_id', $patients->lists('name', 'id'), null, ['required' => 'true', 'id' => 'patient_id'] ); }}
                            <span id="errorPatientId" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Status</label>
                        <div class="col-xs-6">
                            {{ Form::select('status', ['0' => 'Reserved', '1' => 'Waiting',
                      '2' => 'Check-in', '3' => 'No Show', '4' => 'Cancelled', '5' => 'Closed'], null, ['required' => 'true', 'id' => 'status'] ); }}
                            <span id="errorStatus" class="field-validation-msg"></span>
                        </div>
                    </div>
                </div>
            </section>
            <section class="form-Section col-md-6 h400 fL">
                <div class="container w100p">
                    <h3 class="mT15 mB0 c3">&nbsp;</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Checkup Reason</label>
                        <div class="col-xs-6">
                            <textarea type="text" id="checkup_reason" name="checkup_reason" rows="7" cols="20" class="form-control" placeholder="note">{{{ Form::getValueAttribute('checkup_reason', null) }}}</textarea>
                            <span id="errorStatus" class="field-validation-msg"></span>
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