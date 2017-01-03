
<input type="hidden" id="patient_id" name="patient_id" value="" class="submit btn btn-default" />
<input type="hidden" id="appointment_id" name="appointment_id" value="" class="submit btn btn-default" />

<div class="row">
    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label">Weight</label>
        <div class="col-xs-6">
            <input type="text" id="weight" name="weight"
                   value="{{ $vitalSigns[0]->weight }}" class="form-control"
                   placeholder="kilograms">
            <span id="error_weight" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">Height</label>
        <div class="col-xs-6">
            <input type="text" id="height" name="height"
                   value="{{ $vitalSigns[0]->height }}" class="form-control"
                   placeholder="foots">
            <span id="error_height" class="field-validation-msg"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">BP systolic</label>
        <div class="col-xs-6">
            <input type="text" id="bp_systolic" name="bp_systolic"
                   value="{{ $vitalSigns[0]->bp_systolic }}" class="form-control"
                   placeholder="BP e.g 120">
            <span id="error_bp" class="field-validation-msg"></span>
        </div>
    </div>


    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">BP Dialostic</label>
        <div class="col-xs-6">
            <input type="text" id="bp_diastolic" name="bp_diastolic"
                   value="{{ $vitalSigns[0]->bp_diastolic }}" class="form-control"
                   placeholder="bp e.g 80">
            <span id="error_bp" class="field-validation-msg"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">Blood Group</label>
        <div class="col-xs-6">
            <input type="text" id="blood_group" name="blood_group"
                   value="{{ $vitalSigns[0]->blood_group }}" class="form-control"
                   placeholder="Blood Group">
            <span id="error_blood" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">Pulse Rate</label>
        <div class="col-xs-6">
            <input type="text" id="pulse_rate" name="pulse_rate"
                   value="{{ $vitalSigns[0]->pulse_rate }}" class="form-control"
                   placeholder="Pulse Rate">
            <span id="error_pulse_rate" class="field-validation-msg"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">Breathing</label>
        <div class="col-xs-6">
            <input type="text" id="respiration_rate" name="respiration_rate"
                   value="{{ $vitalSigns[0]->respiration_rate }}"
                   class="form-control" placeholder="Respiration Rate">
            <span id="error_rr" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">Body Temp</label>
        <div class="col-xs-6">
            <input type="text" id="temperature" name="temperature"
                   value="{{ $vitalSigns[0]->temperature }}" class="form-control"
                   placeholder="foriegn Height">
            <span id="error_blood" class="field-validation-msg"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">Gait Speed</label>
        <div class="col-xs-6">
            <input type="text" id="gait_speed" name="gait_speed"
                   value="{{ $vitalSigns[0]->gait_speed }}" class="form-control"
                   placeholder="distance/time ">
            <span id="error_gait" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">Addiction</label>
        <div class="col-xs-6">
            <input type="text" id="addiction" name="addiction"
                   value="{{ $vitalSigns[0]->addiction }}" class="form-control"
                   placeholder="cigrette etc">
            <span id="error_addiction" class="field-validation-msg"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">Socities</label>
        <div class="col-xs-6">
            <input type="text" id="communities" name="communities"
                   value="{{ $vitalSigns[0]->communities }}" class="form-control"
                   placeholder="gym etc">
            <span id="error_communities" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-6 control-label asterisk">Note</label>
        <div class="col-xs-6">
            <input type="text" id="note" name="note"
                   value="{{ $vitalSigns[0]->note }}" class="form-control"
                   placeholder="Extra Note">
            <span id="error_note" class="field-validation-msg"></span>
        </div>
    </div>
</div>

{{--<div class="modal-footer">--}}
    {{--@if($formMode == App\Globals\GlobalsConst::FORM_EDIT)--}}
        {{--<button type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit btn btn-default">Save</button>--}}
        {{--<button type="button" id="btnModalClose" class="btn btn-default" data-dismiss="modal">Close</button>--}}
    {{--@endif--}}
{{--</div>--}}

{{--</section>--}}


{{--@section('scripts')--}}
    {{--<link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">--}}
    {{--<script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>--}}
    {{--<script src="{{asset('js/view-pages/vital_signs/VitalSignsForm.js')}}"></script>--}}
    {{--<script>--}}
        {{--window.patientPrescriptionUrl = 0;--}}
        {{--$(document).ready(function () {--}}
            {{--var options = {--}}
                {{--saveCloseUrl: "{{route('patients.index')}}",--}}
                {{--VitalSignUrl: "{{route('vitalSignFetchHistory')}}"--}}
            {{--};--}}
            {{--var vitalSignsForm = new VitalSignsForm(window, document, options);--}}
            {{--vitalSignsForm.initializeAll();--}}
        {{--});--}}
    {{--</script>--}}
{{--@stop--}}