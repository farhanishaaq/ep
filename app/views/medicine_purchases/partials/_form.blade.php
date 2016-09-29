<style type="text/css">
    .hide {
        display: none;
    }
</style>

@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
    {{ Form::open(array('action' => 'inventory', 'class' =>"form-horizontal w100p ", 'id' => 'regForm','novalidate')) }}
@elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
    DDD
@endif
<h3 class="mT10 mB0 c3">Create Medicine Purchase Form</h3>
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

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#medicinePurchaseInfoTab" area-controls="medicinePurchaseInfoTab" role="tab" data-toggle="tab">Medicine Purchase Info</a></li>
    <li role="presentation"><a href="#medicinePurchaseDetailTab" area-controls="medicinePurchaseDetailTab" role="tab" data-toggle="tab">Medicine Purchase Detail</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="medicinePurchaseInfoTab">
        <section class="form-Section col-md-12 h300 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Medicine Purchase Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />


                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Business Unit:</label>
                    <div class="col-xs-6">
                        {{business_unit_drop_down($company_id)}}
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                {{--<div class="form-group col-xs-5 pR2 mB3">--}}
                    {{--<div class="col-xs-12">--}}
                        {{--{{business_unit_drop_down(1)}}--}}
                        {{--<span id="errorName" class="field-validation-msg"></span>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group col-xs-12">--}}
                    {{--<label class="col-xs-5 control-label asterisk">Follow Up Pres:</label>--}}
                    {{--<div class="col-xs-6">--}}
                        {{--{{follow_up_prescription_drop_down((isset($appointment))? $appointment->patient_id : $prescription->appointment->doctor->user->id)}}--}}
                        {{--<span id="errorName" class="field-validation-msg"></span>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Manufacturer:</label>
                    <div class="col-xs-6">
                        {{manufacturer_drop_down()}}
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                {{--<div class="form-group col-xs-6">--}}
                    {{--<label class="col-xs-5 control-label asterisk">Manufacturer:</label>--}}
                    {{--<div class="col-xs-6">--}}
                        {{--<input type="text" id="menufacturer_id" name="menufacturer_id" required="true" value="" class="form-control" placeholder="Manufacturer name">--}}
                        {{--<span id="errorName" class="field-validation-msg"></span>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Purchase Date:</label>
                    <div class="col-xs-6">
                        <input type="text" id="date" name="date" required="true" value="" class="form-control" placeholder="purchase date">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                {{--<div class="form-group col-xs-6">--}}
                    {{--<label class="col-xs-5 control-label asterisk">Purchase Code:</label>--}}
                    {{--<div class="col-xs-6">--}}
                        {{--<input type="text" id="purchase_code" name="purchase_code" required="true" value="" class="form-control" placeholder="purchase code">--}}
                        {{--<span id="errorName" class="field-validation-msg"></span>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Purchase Code:</label>
                    <div class="col-xs-6">
                        <input type="text" id="code" name="code" required="true" value="{{{ Form::getValueAttribute('code', null) }}}" class="form-control" placeholder="Purchase Code">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>
             </div>

        </section>

    </div>
    <div role="tabpanel" class="tab-pane" id="medicinePurchaseDetailTab">
        <section class="form-Section col-md-12 h300 fL">
            {{-- Medicine Purchase Detail --}}
            <div class="container w100p ofA h761">
                <h3 class="mT15 mB0 c3">Medicine Purchase Detail</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group mT30 list-group">
                    <a href="javascript:void(0)" class="col-xs-12 list-group-item list-group-item-action ">
                        <h3 class="col-xs-4">Medicine Purchase Detail</h3>
                        <h3 class="col-xs-3 fR">
                            <div class="fL mL5">Add Detail Row</div>
                            <button class="fR btn btn-default addButton" type="button"><i class="fa fa-plus"></i></button>
                        </h3>
                    </a>
                </div>
                @include('medicine_purchases.includes.detail_row')

            </div>
        </section>
    </div>
</div>




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
                    var $beforeCurrentRow = $('#detail-row-'+rowIndex);
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
                            .find('[name="purchase_quantity[-1]"]').attr('name', 'purchase_quantity[' + rowIndex + ']').end()
                            .find('[name="unit_price[-1]"]').attr('name', 'unit_price[' + rowIndex + ']').end()
                            .find('[name="medicine_id[-1]"]').attr('name', 'medicine_id[' + rowIndex + ']').end();


                    //** medicine_id select2
                    $('[name="medicine_id['+ rowIndex +']"]').select2({
                        tags: "true",
                        placeholder: "Medicine"
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



//        var patientId = $('#patient_id').val();
//        var appointmentId = $('#appointment_id').val();
//        var appointmentDate = $('#appointment_date').val();
//        var prescriptionNextCount = $('#prescriptionNextCount').val();
//        var PrescriptionCode = appointmentDate +'-'+ leftPad(patientId,"000") + leftPad(appointmentId,"000") + leftPad(prescriptionNextCount,"000");
//        $('#code').val(PrescriptionCode);

        var medicinePurchaseCode =

        //** medicine_id select2
        $('[name="medicine_id['+ rowIndex +']"]').select2({
            tags: "true",
            placeholder: "Medicine"
        });


        /**
         * business_unit_id select2
         */
        $('#business_unit_id').select2({
            tags: "true",
            placeholder: "Business unit"
        });

        $('#Manufacturer').select2({
            tags: "true",
            placeholder: "Manufacturer"
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
                url: "{{route('medicinePurchase.store')}}",
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


