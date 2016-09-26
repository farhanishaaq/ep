<?php
$TEMPLATE_INDEX = \App\Globals\GlobalsConst::TEMPLATE_INDEX;
?>
{{--Detail Row As At Zero Index--}}
<div id="detail-row-0" class="form-group list-group h170" data-row-index="0">
    <div class="col-xs-12">
        <a href="javascript:void(0)" class="col-xs-12 list-group-item list-group-item-action active  h55">
            <h4 class="col-xs-4">Row 1</h4>
            <h4 class="col-xs-3 fR mT0">
                <div class="fL mL5 mT10">Remove Detail Row</div>
                <button class="fR btn btn-default removeButton" type="button"><i class="fa fa-minus"></i></button>
            </h4>
        </a>
        <a href="javascript:void(0)" class="col-xs-12 p5 list-group-item list-group-item-action h130">
            <div class="form-group col-xs-3 pR2 mB0">
                <div class="col-xs-12">
                    {{Medicine_drop_down()}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB0">
                <div class="col-xs-12">
                    <input type="text" id="quantity" name="purchase_quantity[0]" class="form-control col-xs-3" value="" placeholder="Purchase quantity">
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB0">
                <div class="col-xs-12">
                    <input type="text" id="unit_price" name="unit_price[0]" class="form-control col-xs-3" value="" placeholder="Unit price">
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>

            <div class="form-group col-xs-3 pR2 mB0">
                <div class="col-xs-12">
                    <input type="text" id="total_price" name="total_price" class="form-control col-xs-3" value="" placeholder="Total price">
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
        </a>
    </div>
</div>


{{--Detail Row As Template--}}
<div id="detailRowTemplate" class="form-group list-group h170 dN">
    <div class="col-xs-12 prnt3">
        <a href="javascript:void(0)" class="col-xs-12 list-group-item list-group-item-action active  h55">
            <h4 class="col-xs-4">Row <span class="row-count-display">1</span></h4>
            <h4 class="col-xs-3 fR mT0 prnt1">
                <div class="fL mL5 mT10">Remove Detail Row</div>
                <button class="fR btn btn-default removeButton" type="button"><i class="fa fa-minus"></i></button>
            </h4>
        </a>
        <a href="javascript:void(0)" class="col-xs-12 p5 list-group-item list-group-item-action h130">

            <div class="form-group col-xs-3 pR2 mB0">
                <div class="col-xs-12">
                    {{medicine_drop_down($TEMPLATE_INDEX)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB0">
                <div class="col-xs-12">
                    <input type="text" id="purcahse_quantity" name="purchase_quantity[{{$TEMPLATE_INDEX}}]" class="form-control col-xs-3" value="" placeholder="Purchase quantity">
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB0">
                <div class="col-xs-12">
                    <input type="text" id="unit_price" name="unit_price[{{$TEMPLATE_INDEX}}]" class="form-control col-xs-3" value="" placeholder="Unit price">
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB0">
                <div class="col-xs-12">
                    <input type="text" id="total_price" name="total_price" class="form-control col-xs-3" value="" placeholder="Total price">
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
        </a>
    </div>
</div>