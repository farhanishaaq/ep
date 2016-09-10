            <style type="text/css">
                .hide {
                    display: none;
                }
            </style>
        @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
            {{ Form::open(array('action' => 'PrescriptionsController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm')) }}
        @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
            DDD
        @endif
        <h3 class="mT10 mB0 c3">Create Employee Form</h3>
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
                        <input type="text" id="parent_id" name="parent_id" required="true" value="{{{ Form::getValueAttribute('code', null) }}}" class="form-control" placeholder="Prescription Code">
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


    <script type="text/javascript">
        $(document).ready(function () {
            rowIndex = 0;
            $('#regForm').on('click', '.addButton', function () {

                var availableRowsCount = $('[id^="detail-row-"]').length;
                console.log(availableRowsCount);
                if(availableRowsCount > 1 ){
                    var $beforeCurrentRow = $('#detail-row-'+rowIndex);
                }else{
                    var $beforeCurrentRow = $('#detail-row-'+0)
                    rowIndex = 0;
                }
                rowIndex++;
                var $template = $('#detailRowTemplate');
                var $clone = $template
                                .clone()
                                .removeClass('dN')
                                .removeAttr('id')
                                .attr('id','detail-row-' + rowIndex)
                                .attr('data-row-index', rowIndex)
                                .addClass('removablRow')
                                .insertBefore($beforeCurrentRow);

                console.log($clone);
                // Update the name attributes
                $clone.find('.row-count-display').html(rowIndex+1).end()
                        .find('[name="usage_type[-1]"]').attr('name', 'usage_type[' + rowIndex + ']').end()
                        .find('[name="dosage_form[-1]"]').attr('name', 'dosage_form[' + rowIndex + ']').end()
                        .find('[name="medicine_id[-1]"]').attr('name', 'medicine_id[' + rowIndex + ']').end()
                        .find('[name="strength_quantity[-1]"]').attr('name', 'strength_quantity[' + rowIndex + ']').end()
                        .find('[name="dosage_strength[-1]"]').attr('name', 'dosage_strength[' + rowIndex + ']').end()
                        .find('[name="usage_quantity[-1]"]').attr('name', 'usage_quantity[' + rowIndex + ']').end()
                        .find('[name="quantity_unit[-1]"]').attr('name', 'quantity_unit[' + rowIndex + ']').end()
                        .find('[name="frequencies[-1]"]').attr('name', 'frequencies[' + rowIndex + ']').end()
                        .find('[name="extra_note[-1]"]').attr('name', 'extra_note[' + rowIndex + ']').end();

                //** usage_type select2
                $('[name="usage_type['+ rowIndex +']"]').select2({
                    tags: "true",
                    placeholder: "Dosage Type"
                 });

                //** dosage_form select2
                $('[name="dosage_form['+ rowIndex +']"]').select2({
                    tags: "true",
                    placeholder: "Dosage Form"
                 });

                //** medicine_id select2
                $('[name="medicine_id['+ rowIndex +']"]').select2({
                    tags: "true",
                    placeholder: "Medicine"
                 });

                //** dosage_strength select2
                $('[name="dosage_strength['+ rowIndex +']"]').select2({
                    tags: "true",
                    placeholder: "Dosage Strength"
                 });

                //** quantity_unit select2
                $('[name="quantity_unit['+ rowIndex +']"]').select2({
                    tags: "true",
                    placeholder: "Select Unit"
                 });

                //** frequencies select2
                $('[name="frequencies['+ rowIndex +']"]').select2({
                    tags: "true",
                    placeholder: "Frequencies"
                 });
            })

            // Remove button click handler
            .on('click', '.removeButton', function () {
//                var $row = $(this).parents('.actual');
                var $row = $(this).parents('.removablRow');

                var index = $row.attr('data-row-index');
//                console.log($row);
                // Remove element containing the fields
                $row.remove();
            });



            var patientId = $('#patient_id').val();
            var appointmentId = $('#appointment_id').val();
            var appointmentDate = $('#appointment_date').val();
            var prescriptionNextCount = $('#prescriptionNextCount').val();
            var PrescriptionCode = appointmentDate +'-'+ leftPad(patientId,"000") + leftPad(appointmentId,"000") + leftPad(prescriptionNextCount,"000");
            $('#code').val(PrescriptionCode);


            /**
             * usage_type select2
             */
            $('#usage_type').select2({
                tags: "true",
                placeholder: "Usage Type"
            });


            /**
             * dosage_form select2
             */
            $('#dosage_form').select2({
                tags: "true",
                placeholder: "Dosage Form"
            });

            /**
             * medicine_id select2
             */
            $('#medicine_id').select2({
                tags: "true",
                placeholder: "Medicine"
            });

            /**
             * dosage_strength select2
             */
            $('#dosage_strength').select2({
                tags: "true",
                placeholder: "Strength"
            });

            /**
             * quantity_unit select2
             */
            $('#quantity_unit').select2({
                tags: "true",
                placeholder: "Unit"
            });

            /**
             * frequencies select2
             */
            $('#frequencies').select2({
                tags: "true",
                placeholder: "Frequencies"
            });

            /**
             * Form Submit Button Event
             */
//            $(s.dataFormId).submit(function(e){
            $('#regForm').submit(function(e){
                e.preventDefault();
                var frm = $(this);
                // console.log(frm.serialize());
//                var validator = s.validationRulesForForm(frm);

                /*if (frm.valid()) {
                    var formData = frm.serialize();
                    var saveUrl = frm.attr('action') || "";

                }else{
                    showMsg('Invalid Form!',window.MESSAGE_TYPE_ERROR);
                }*/
                var formData = frm.serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{route('prescriptions.store')}}",
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if(response.success){
                            showMsg(response.message,window.MESSAGE_TYPE_SUCCESS);
                            if(saveCloseClicked){
                                goTo(s.saveCloseUrl);
                            }else{
                                window.location.reload();
                            }
                        }
                    }
                });
                return false;
            });
        });
    </script>

