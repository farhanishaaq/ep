
<section class="form-Section col-xs-12 h695 fL">
<div class="container w100p">
    <h3 class="mT15 mB0 c3">Vital Sign Information</h3>
    <hr class="w95p fL mT0" />
    <hr class="w95p fL mT0" />

    <input type="hidden" id="patient_id" name="patient_id" value="" class="submit btn btn-default" />
    <input type="hidden" id="appointment_id" name="appointment_id" value="" class="submit btn btn-default" />

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label">Weight</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->weight }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Height</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->height }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">BP systolic</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->bp_systolic }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>


    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">BP Dialostic</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->bp_diastolic }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Blood Group</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->blood_group }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Pulse Rate</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->pulse_rate }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Breathing Rate</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->respiration_rate }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Body Temp</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->temperature }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Gait Speed</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->gait_speed }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Addiction</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->addiction }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Healthy Socities</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->communities }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Note</label>
        <div class="col-xs-6">
            <label class="form-control">{{{ $vitalSigns[0]->note }}}</label>
            <span id="errorName" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="modal-footer">

        <button type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit btn btn-default">Save</button>

        <button type="button" id="btnModalClose" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
</section>