            <style type="text/css">
                .hide {
                    display: none;
                }
            </style>
        @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
            {{ Form::open(array('action' => 'PrescriptionsController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm', 'onsubmit' => 'checkForm()')) }}
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
        <section class="form-Section col-md-6 h695 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Prescription Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <input name="patient_id" type="hidden" value="{{ $appointment->patient->id }}">
                <input name="appointment_id" type="hidden" value="{{ $appointment->id }}">

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Current Visit Date*</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ (isset($appointment))?  date('j F, Y', strtotime($appointment->date)) :  date('j F, Y', strtotime($prescription->appointment->date)) }}</label>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Doctor Name*</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ (isset($appointment))? $appointment->employee->name : $prescription->appointment->employee->name}}</label>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Prescription Code:</label>
                    <div class="col-xs-6">
                        <input type="text" id="code" name="code" required="true" value="{{{ Form::getValueAttribute('code', null) }}}" class="form-control" placeholder="Prescription Code">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Inventory Medicines:</label>

                    <div class="col-xs-6 hAi">
                        {{ Form::select("medicineName[]", [null => 'Select first medicine']+$medicines, null, ['id' => 'medicineName', 'class'=> 'medicinesCss']) }}
                        <input type="text" class="form-control" name="med_qty[]" placeholder="quantity" />
                        <button class="btn btn-default addButton" type="button"><i class="fa fa-plus"></i></button>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div id="moreMedicine" class="form-group hide actual">
                    <label class="col-xs-5 control-label asterisk">Inventory Medicines:</label>
                    <div class="col-xs-6 hAi">
                        {{ Form::select("medicineName[]", [null => 'Select first medicine']+$medicines, null, ['id' => 'medicineName', 'class'=> 'medicinesCss']) }}
                        <input type="text" class="form-control" name="med_qty[]" placeholder="quantity" />
                        <button class="btn btn-default removeButton" type="button"><i class="fa fa-minus"></i></button>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

            </div>
        </section>

        <section class="form-Section col-md-6 h695 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3"></h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Other Medicines:</label>
                    <div class="col-xs-6 hAi">
                        <textarea id="medicines" name="medicines" class="form-control" rows="7" cols="20" placeholder="Other medicines...">{{{ Form::getValueAttribute('medicines', null) }}}</textarea>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Note:</label>
                    <div class="col-xs-6 hAi">
                        <textarea id="note" name="note" class="form-control" rows="7" cols="20" placeholder="Note">{{{ Form::getValueAttribute('note', null) }}}</textarea>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Procedure:</label>
                    <div class="col-xs-6 hAi">
                        <textarea id="procedure" name="procedure" class="form-control" rows="7" cols="20" placeholder="Procedure">{{{ Form::getValueAttribute('procedure', null) }}}</textarea>
                        <span id="errorName" class="field-validation-msg"></span>
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


    <script type="text/javascript">
        $(document).ready(function () {
            bookIndex = 0;
            $('#regForm').on('click', '.addButton', function () {
                bookIndex++;
                var $template = $('#moreMedicine'),
                        $clone = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-book-index', bookIndex)
                                .insertBefore($template);

                // Update the name attributes
                $clone.find('[name="medicine"]').attr('name', 'medicineName[' + bookIndex + ']').end().find('[name="med_qty"]').attr('name', 'quantity[' + bookIndex + ']').end();
                /*$('.medicinesCss').select2({
                    tags: "true",
                    placeholder: "Select an option"
                 });*/
            })
            // Remove button click handler
            .on('click', '.removeButton', function () {
                var $row = $(this).parents('.actual'),
                index = $row.attr('data-book-index');
                // Remove element containing the fields
                $row.remove();
            });

            $('.medicinesCss').select2({
                tags: "true",
                placeholder: "Select an option"
             });
        });
    </script>

