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
            <section class="form-Section col-md-6 h1000 fL">

                <div class="container w100p">
                    <h3 class="mT15 mB0 c3">Appointment Basic Info</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Code</label>
                        <div class="col-xs-6">
                            <input type="text" id="code" name="code" value="{{{ Form::getValueAttribute('expected_fee', 0) }}}" class="form-control" placeholder="Code">
                            <span id="error_code" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Select Doctor</label>
                        <div class="col-xs-6">
                            {{ make_doctor_drop_down($doctors, Form::getValueAttribute('doctor_id', null)) }}
                            <span id="error_doctor_id" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Select Patient</label>
                        <div class="col-xs-6">
                            {{ Form::select('patient_id', ["" => 'Select Patient'] + $patients->lists('full_name', 'id'), null, ['id' => 'patient_id'] ); }}
                            <span id="error_patient_id" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Status</label>
                        <div class="col-xs-6">
                            {{--{{ Form::select('status', ['0' => 'Reserved', '1' => 'Waiting',
                      '2' => 'Check-in', '3' => 'No Show', '4' => 'Cancelled', '5' => 'Closed'], null, ['required' => 'true', 'id' => 'status'] ); }}
                      --}}
                      {{ Form::select('status', ["" => 'Select Status']+ GlobalsConst::$APPOINTMENT_STATUSES, null, ['required' => 'true', 'id' => 'status'] ); }}
                            <span id="error_status" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Checkup Detail</label>
                        <div class="col-xs-6 hAi">
                            <textarea type="text" id="checkup_detail" name="checkup_detail" rows="7" cols="20" class="form-control" placeholder="note">{{{ Form::getValueAttribute('checkup_reason', null) }}}</textarea>
                            <span id="error_checkup_detail" class="field-validation-msg"></span>
                        </div>
                    </div>
                </div>

                {{--Payment Info--}}
                <div class="container w100p">
                    <h3 class="mT15 mB0 c3">Payment Info</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Expected Fee</label>
                        <div class="col-xs-6">
                            <input type="number" id="expected_fee" name="expected_fee" value="{{{ Form::getValueAttribute('expected_fee', 0) }}}" class="form-control" placeholder="0">
                            <span id="error_expected_fee" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Payment Status</label>
                        <div class="col-xs-6">
                            {{ Form::select('payment_status', \App\Globals\GlobalsConst::$PAYMENT_STATUS, Form::getValueAttribute('payment_status', null), ['id' => 'payment_status'] ); }}
                            <span id="error_payment_status" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Discount Amount</label>
                        <div class="col-xs-6">
                            <input type="number" id="discount_amount" name="discount_amount" value="{{{ Form::getValueAttribute('discount_amount', 0) }}}" class="form-control" placeholder="0">
                            <span id="error_discount_amount" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Paid Fee</label>
                        <div class="col-xs-6">
                            <input type="number" id="paid_fee" name="paid_fee" value="{{{ Form::getValueAttribute('paid_fee', null) }}}" class="form-control" placeholder="0">
                            <span id="error_paid_fee" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Remaining Fee</label>
                        <div class="col-xs-6">
                                <input type="number" id="remaining_fee" name="remaining_fee" value="{{{ Form::getValueAttribute('remaining_fee', null) }}}" class="form-control" placeholder="0" readonly="readonly">
                            <span id="error_remaining_fee" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-xs-5 control-label asterisk">Total Paid</label>
                        <div class="col-xs-6">
                            <input type="number" id="total_paid" name="total_paid" value="{{{ Form::getValueAttribute('remaining_fee', null) }}}" class="form-control" placeholder="0" readonly="readonly">
                            <span id="errorFee" class="field-validation-msg"></span>
                        </div>
                    </div>
                </div>

            </section>
            <section class="form-Section col-md-6 h1000 fL">
                <div class="container w100p">
                    <h3 class="mT15 mB0 c3">&nbsp;</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Select Date</label>
                        <div class="col-xs-6">
                            {{--<input type="text" id="date" name="date" required="true" value="{{{ Form::getValueAttribute('date', null) }}}" class="form-control" placeholder="mm/dd/yyyy">--}}
                             <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" id="date" name="date" required="true" value="{{{ retrieve_date_for_input('date')}}}" readonly >
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <span id="errorDate" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Select Time Slot</label>
                        <div class="col-xs-6">
                            @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
                                <select id="time_slot_id" name="time_slot_id" required="true">
                                    <option> Select Time slot </option>
                                </select>
                            @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
                                {{ Form::select('time_slot_id', $timeSlotsByAppointmentDate, Form::getValueAttribute('date', $timeSlot), ['required' => 'true', 'id' => 'time_slot_id'] ); }}
                            @endif
                            <span id="errorTimeslotId" class="field-validation-msg"></span>
                        </div>
                    </div>

                </div>
                <div class="container w100p">
                    <div id="fCalendar" class="col-xs-12 m0A"></div>
                </div>
            </section>
            <div class="col-xs-12 taR pR0 mT20">
                <input type="reset" id="reset" value="Reset" class="submit" />
                <input type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit" />
                <input type="submit" id="saveContinue" name="saveContinue" value="Save and Continue" class="submit" />
                <input type="button" id="cancel" name="cancel" value="Cancel" class="submit" onclick="goTo('{{route("appointments.index")}}')" />
            </div>
        {{ Form::close() }}
        @section('scripts')
            <link rel="stylesheet" href="{{asset('plugins/calendar/css/fullcalendar.min.css')}}" type="text/css">
            <script src="{{asset('plugins/calendar/js/fullcalendar.min.js')}}"></script>
            <script src="{{asset('js/view-pages/appointments/AppointmentForm.js')}}"></script>
            <script>
                $(document).ready(function(){
                    var options = {
                        saveCloseUrl: "{{route('appointments.index')}}",
                        urlToFetchTimeSlots : "{{route('fetchTimeSlotsAndBookedAppointments')}}",
                        formMode: '{{$formMode}}'
                    };
                    var appointmentForm = new AppointmentForm(window,document,options);
                    appointmentForm.initializeAll();
                });
            </script>
        @stop