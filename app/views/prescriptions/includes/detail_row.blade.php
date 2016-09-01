{{--Detail Row As At Zero Index--}}
<div id="detail-row-0" class="form-group list-group h450" data-row-index="0">
    <div class="col-xs-12">
        <a href="javascript:void(0)" class="col-xs-12 list-group-item list-group-item-action active  h55">
            <h4 class="col-xs-4">Row 1</h4>
            <h4 class="col-xs-3 fR mT0">
                <div class="fL mL5 mT10">Remove Detail Row</div>
                <button class="fR btn btn-default removeButton" type="button"><i class="fa fa-minus"></i></button>
            </h4>
        </a>
        <a href="javascript:void(0)" class="col-xs-12 list-group-item list-group-item-action h400">
            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Usage Type*</label>
                <div class="col-xs-6">
                    {{usage_type_drop_down()}}
                    <span id="error_usage_type" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Dosage Form*</label>
                <div class="col-xs-6">
                    {{dosage_form_drop_down()}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Medicine*</label>
                <div class="col-xs-6">
                    {{--<select id="medicine_id" name="medicine_id[0]" ><option value="">Select Medicine</option></select>--}}
                    {{Medicine_drop_down()}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Strength*</label>
                <div class="col-xs-6">
                    {{dosage_strength_form_drop_down()}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Quantity*</label>
                <div class="col-xs-6 prescription-qty-unit-css">
                    <input type="text" id="quantity" name="usage_quantity[0]" class="form-control col-xs-3" value="">
                    {{dosage_qty_unit_drop_down()}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Frequency*</label>
                <div class="col-xs-6 multi-select">
                    {{frequency_drop_down()}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Conditional Note</label>
                <div class="col-xs-6 auto-height-content">
                    <textarea type="text" id="conditional_note[0]" name="conditional_note[0]" rows="7" cols="20" class="form-control" placeholder="Conditional Note">{{{ Form::getValueAttribute('conditional_note', null) }}}</textarea>
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Extra Note</label>
                <div class="col-xs-6">
                    <textarea type="text" id="extra_note" name="extra_note" rows="7" cols="20" class="form-control" placeholder="Extra Note">{{{ Form::getValueAttribute('extra_note', null) }}}</textarea>
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
        </a>
    </div>
</div>

{{--Detail Row As Template--}}
<div id="detailRowTemplate" class="form-group list-group h450 dN">
    <div class="col-xs-12 prnt3">
        <a href="javascript:void(0)" class="prnt2 col-xs-12 list-group-item list-group-item-action active  h55">
            <h4 class="col-xs-4">Row <span class="row-count-display">1</span></h4>
            <h4 class="col-xs-3 fR mT0 prnt1">
                <div class="fL mL5 mT10">Remove Detail Row</div>
                <button class="fR btn btn-default removeButton" type="button"><i class="fa fa-minus"></i></button>
            </h4>
        </a>
        <a href="javascript:void(0)" class="col-xs-12 list-group-item list-group-item-action h400">
            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Usage Type*</label>
                <div class="col-xs-6">
                    {{usage_type_drop_down(-1)}}
                    <span id="error_usage_type" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Dosage Form*</label>
                <div class="col-xs-6">
                    {{dosage_form_drop_down(-1)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Medicine*</label>
                <div class="col-xs-6">
                    <select id="medicine_id" name="medicine_id[-1]" ><option value="">Select Medicine</option></select>
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Strength*</label>
                <div class="col-xs-6">
                    {{dosage_strength_form_drop_down(-1)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Quantity*</label>
                <div class="col-xs-6 prescription-qty-unit-css">
                    <input type="text" id="quantity" name="quantity[-1]" class="form-control col-xs-3" value="">
                    {{dosage_qty_unit_drop_down(-1)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Frequency*</label>
                <div class="col-xs-6 multi-select">
                    {{frequency_drop_down(-1)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Conditional Note</label>
                <div class="col-xs-6 auto-height-content">
                    <textarea type="text" id="conditional_note" name="conditional_note[-1]" rows="7" cols="20" class="form-control" placeholder="Conditional Note"></textarea>
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-6">
                <label class="col-xs-5 control-label asterisk">Extra Note</label>
                <div class="col-xs-6">
                    <textarea type="text" id="extra_note" name="extra_note[-1]" rows="7" cols="20" class="form-control" placeholder="Extra Note"></textarea>
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
        </a>
    </div>
</div>