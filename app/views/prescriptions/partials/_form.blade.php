            <style type="text/css">
                .hide {
                    display: none;
                }
            </style>
        @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
            {{ Form::open(array('action' => 'PrescriptionsController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm', 'novalidate')) }}
        @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
            DDD
        @endif
        <h3 class="mT10 mB0 c3">Create Prescription Form</h3>
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
        <section class="form-Section col-md-12 h1126 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Prescription Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <input id="patient_id" name="patient_id" type="hidden" value="{{ $appointment->patient->id }}">
                <input id="appointment_id" name="appointment_id" type="hidden" value="{{ $appointment->id }}">
                <input id="appointment_date" name="appointment_date" type="hidden" value="{{ date('Ymd', strtotime($appointment->date)) }}">
                <input id="prescriptionNextCount" name="prescriptionNextCount" type="hidden" value="{{ $prescriptionNextCount }}">

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Appointment Date*</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ (isset($appointment))?  date('j F, Y', strtotime($appointment->date)) :  date('j F, Y', strtotime($prescription->appointment->date)) }}</label>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Appointment Type</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ (isset($appointment)) ? get_appointment_status_name($appointment->status) : '---'}}</label>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Patient Name*</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ (isset($appointment))? $appointment->patient->user->full_name : $prescription->appointment->doctor->user->full_name}}</label>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Doctor Name*</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ (isset($appointment))? $appointment->doctor->user->full_name : $prescription->appointment->doctor->user->full_name}}</label>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Prescription Code:</label>
                    <div class="col-xs-6">
                        <input type="text" id="code" name="code" required="true" value="{{{ Form::getValueAttribute('code', null) }}}" class="form-control" placeholder="Prescription Code">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Follow Up Pres:</label>
                    <div class="col-xs-6">
                        {{follow_up_prescription_drop_down((isset($appointment))? $appointment->patient_id : $prescription->appointment->doctor->user->id)}}
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Check Up Note:</label>
                    <div class="col-xs-6">
                        <textarea type="text" id="check_up_note" name="check_up_note" rows="2" cols="20" class="form-control" placeholder="Check Up Note">{{{ Form::getValueAttribute('extra_note', null) }}}</textarea>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Refill:</label>
                    <div class="col-xs-6">
                        <input type="text" id="refill" name="refill"  value="{{{ Form::getValueAttribute('code', null) }}}" class="form-control" placeholder="Refill" required="required">
                        <span id="error_refill" class="field-validation-msg"></span>
                    </div>
                </div>
            </div>
            {{-- Prescription Detail --}}
            <div class="container w100p ofA h761">
                <h3 class="mT15 mB0 c3">Prescription Detail</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group mT30 list-group">
                    <a href="javascript:void(0)" class="col-xs-12 list-group-item list-group-item-action ">
                        <h3 class="col-xs-4">Prescription Detail Data</h3>
                        <h3 class="col-xs-3 fR">
                            <div class="fL mL5">Add Detail Row</div>
                            <button class="fR btn btn-default addButton" type="button"><i class="fa fa-plus"></i></button>
                        </h3>
                    </a>
                </div>
                @include('prescriptions.includes.detail_row')

            </div>
        </section>

        <div class="col-xs-12 taR pR0 mT20">
            <input type="reset" id="reset" value="Reset" class="submit" />
            <input type="submit" id="createClose" value="Save and Close" class="submit" />
            <input type="submit" id="createContinue" name="createContinue" value="Save and Continue" class="submit" />
            <input type="submit" id="cancel" value="Cancel" class="submit" />
        </div>
        {{ Form::close() }}


    <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
    <script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>
    <script src="{{asset('js/view-pages/prescriptions/PrescriptionForm.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {


            var options = {

            };

            var prescriptionForm = new PrescriptionForm(window,document,options);
            prescriptionForm.initializeAll();
        });
    </script>

