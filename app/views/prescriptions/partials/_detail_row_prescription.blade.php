<?php
$TEMPLATE_INDEX = \App\Globals\GlobalsConst::TEMPLATE_INDEX;
$i = 0;
$usage_type = null;
$strength_quantity = null;
$dosage_strength = null;
$usage_quantity = null;
$quantity_unit = null;
$frequencies = null;
$extra_note = null;

$prescriptionsDetailsCount = count($prescriptionsDetails);
$rowCounter = $prescriptionsDetailsCount == 0 ? 1 : $prescriptionsDetailsCount;
?>
{{-- Detail Row As At Zero Index --}}
@if(($prescriptionsDetails) != null)
    @if(($prescriptionsDetails->count()))
        @foreach($prescriptionsDetails as $k => $pd)
            <?php
            $i = --$rowCounter;
            $usage_type         = $pd->usage_type;
            $strength_quantity  = $pd->strength_quantity;
            $dosage_strength    = $pd->dosage_strength;
            $usage_quantity     = $pd->usage_quantity;
            $quantity_unit      = $pd->quantity_unit;
            $frequencies        = $pd->frequencies;
            $extra_note         = $pd->extra_note;

            ?>
            @include('prescriptions.includes.zero_detail_row_2')
        @endforeach
    @else
        @include('prescriptions.includes.zero_detail_row_2')
    @endif
@else
    @include('prescriptions.includes.zero_detail_row_2')
@endif
<span id="checkUpImgPath" class="dN">{{$prescriptionCheckUpImgPath}}</span>



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
            <div class="form-group col-xs-2 pR2 mB3">
                <div class="col-xs-12">
                    {{usage_type_drop_down($TEMPLATE_INDEX)}}
                    <span id="error_usage_type" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB3">
                <div class="col-xs-12">
                    {{dosage_form_drop_down($TEMPLATE_INDEX)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-5 pR2 mB3">
                <div class="col-xs-12">
                    {{medicine_drop_down($TEMPLATE_INDEX)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB3">
                <div class="col-xs-12 prescription-qty-unit-css">
                    <input type="text" id="st_quantity" name="strength_quantity[{{$TEMPLATE_INDEX}}]" class="form-control col-xs-3" value="" placeholder="Qty">
                    {{dosage_strength_form_drop_down($TEMPLATE_INDEX)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-3 pR2 mB3">
                <div class="col-xs-12 prescription-qty-unit-css">
                    <input type="text" id="quantity" name="usage_quantity[{{$TEMPLATE_INDEX}}]" class="form-control col-xs-3" value="" placeholder="Qty">
                    {{dosage_qty_unit_drop_down($TEMPLATE_INDEX)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-4 pR2 mB3">
                <div class="col-xs-12 frequencies-multi-slct multi-select">
                    <input type="hidden" id="frequencies" name="frequencies[{{$TEMPLATE_INDEX}}]" class="form-control col-xs-3" value="">
                    {{frequency_drop_down($TEMPLATE_INDEX)}}
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group col-xs-6 pR2 mB3">
                <div class="col-xs-11">
                    <textarea type="text" id="extra_note" name="extra_note[{{$TEMPLATE_INDEX}}]" rows="2" cols="20" class="form-control" placeholder="Extra Note">{{{ Form::getValueAttribute('extra_note', null) }}}</textarea>
                    <span id="errorName" class="field-validation-msg"></span>
                </div>
            </div>
        </a>
    </div>
</div>


{{--Prescription Photo Upload Plugin HTML As Template--}}
<div id="prescriptionPhotoTemplate" class="dN">
    <div class="file-preview previousCheckUpPhoto">
        <div class="close fileinput-remove">×</div>
        <div class=" file-drop-zone">
            <div class="file-preview-thumbnails"><div class="file-initial-thumbs"><div class="file-preview-frame file-preview-initial" id="preview-1475066414124-init_0" data-fileindex="init_0" data-template="image"><div class="kv-file-content">
                            <img src="http://localhost/ep/public/images/alis.png" class="kv-preview-data file-preview-image" title="prescription_dumy.png" alt="prescription_dumy.png" style="width:auto;height:160px;">
                        </div><div class="file-thumbnail-footer">
                            <div class="file-footer-caption" title="Previous CheckUp Photo">Previous CheckUp Photo <br><samp>(908.52 KB)</samp></div>
                            <div class="file-thumb-progress hide"><div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                        0%
                                    </div>
                                </div></div> <div class="file-actions">
                                <div class="file-footer-buttons">
                                    <button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" data-url="" data-key="1"><i class="glyphicon glyphicon-trash text-danger"></i></button>
                                    <button type="button" class="kv-file-zoom btn btn-xs btn-default" title="View Details"><i class="glyphicon glyphicon-zoom-in"></i></button>     </div>
                                <span class="file-drag-handle drag-handle-init text-info" title="Move / Rearrange"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
                                <div class="file-upload-indicator" title=""></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div></div>
            <div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
            <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
        </div>
    </div>
</div>



<script src="{{asset('js/view-pages/prescriptions/PrescriptionDetailForm.js')}}"></script>
<script type="text/javascript">

    var rowCount = "{{ ($prescriptionsDetailsCount == 0) ? 0 : ($prescriptionsDetailsCount - 1)}}";
    window.PrescriptionDetailRowIndex = parseInt(rowCount);
    var options = {};

    var prescriptionDetailForm = new PrescriptionDetailForm(window, document, options);
    prescriptionDetailForm.initializeAll();


</script>