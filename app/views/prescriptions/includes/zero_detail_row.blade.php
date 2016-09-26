{{--Detail Row As At Zero Index--}}
<div class="form-group list-group h170" id="detail-row-{{$i}}" data-row-index="{{$i}}">
    <div class="col-xs-12">
        <a href="javascript:void(0)" class="col-xs-12 list-group-item list-group-item-action active  h55">
            <h4 class="col-xs-4">Row {{($i+1)}}</h4>
            <h4 class="col-xs-3 fR mT0">
                <div class="fL mL5 mT10">Remove Detail Row</div>
                <button class="fR btn btn-default removeButton" type="button"><i class="fa fa-minus"></i></button>
            </h4>
        </a>
        <a href="javascript:void(0)" class="col-xs-12 p5 list-group-item list-group-item-action h150">
            <div class="form-group col-xs-2 pR2 mB3">
                <div class="col-xs-12">
                    {{usage_type_drop_down($i)}}
                    <span id="error_usage_type" class="field-validation-msg h15"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB3">
                <div class="col-xs-12">
                    {{dosage_form_drop_down($i)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-5 pR2 mB3">
                <div class="col-xs-12">
                    {{Medicine_drop_down($i)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB3">
                <div class="col-xs-12 prescription-qty-unit-css">
                    <input type="text" id="quantity" name="usage_quantity[{{$i}}]" class="form-control col-xs-3" value="" placeholder="Qty">
                    {{dosage_strength_form_drop_down($i)}}
                    <span id="error_usage_quantity[0]" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB3">
                <div class="col-xs-12 prescription-qty-unit-css">
                    <input type="text" id="quantity" name="strength_quantity[{{$i}}]" class="form-control col-xs-3" value="" placeholder="Qty">
                    {{dosage_qty_unit_drop_down($i)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-4 pR2 mB3">
                <div class="col-xs-12 frequencies-multi-slct">
                    <input type="hidden" id="frequencies" name="frequencies[{{$i}}]" class="form-control col-xs-3" value="">
                    {{frequency_drop_down($i)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-6 pR2 mB3">
                <div class="col-xs-11">
                    <textarea type="text" id="extra_note" name="extra_note[{{$i}}]" rows="2" cols="20" class="form-control" placeholder="Extra Note">{{{ Form::getValueAttribute('extra_note', null) }}}</textarea>
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
        </a>
    </div>
</div>
