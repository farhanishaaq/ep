{{--<section class="form-Section col-md-12 h610 fL" >--}}

@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
    {{ Form::open(array('action' => 'vitalSigns.store', 'class' =>"form-horizontal w100p ", 'id' => 'vitalSignsForm','enctype' => 'multipart/form-data', 'novalidate')) }}
@elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
    {{Form::model($vitalSign, ['route' => ['vitalSigns.store',1], 'method' => 'put' , 'class' => "form-horizontal w100p ", 'id' => 'vitalSignsForm'])}}
@endif
{{--<form action="vitalSigns" method="post" id="vitalSignsForm" enctype="multipart/form-data">--}}

    <div class="form-group">

        <div class="col-xs-6">
            {{ vitalsigns_drop_down($params=['created_at'=>'id'],$patient_id)}}
            <span id="error_patient" class="field-validation-msg"></span>
        </div>
        <button type="button" id="btnModalNew" class="btn btn-default" data-dismiss="modal">New</button>
    </div>

        <?php
                if(isset($patient_id) && isset($appointment_id)){ ?>
                    <input type="hidden" id="patient_id" name="patient_id" value="{{$patient_id}}" class="submit btn btn-default" />
                    <input type="hidden" id="appointment_id" name="appointment_id" value="{{$appointment_id}}" class="submit btn btn-default" />
        <?php }?>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label">Weight</label>
        <div class="col-xs-7">
            <input type="number" id="weight" name="weight"
                   value="{{$vitalSign  ? $vitalSign->weight : Form::getValueAttribute('weight', null)}}" class="form-control"
                   placeholder="kilograms">
            <span id="error_weight" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Height</label>
        <div class="col-xs-7">
            <input type="number" id="height" name="height"
                   value="{{{ $vitalSign  ? $vitalSign->height :Form::getValueAttribute('height', null) }}}" class="form-control"
                   {{--value="{{ (isset($vitalSign))? $vitalSign->height : Form::getValueAttribute('height', null)  }}" class="form-control"--}}
                   placeholder="foots">
            <span id="error_height" class="field-validation-msg"></span>
        </div>
    </div>
    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">BP systolic</label>
        <div class="col-xs-7">
            <input type="number" id="bp_systolic" name="bp_systolic"
                   value="{{{ $vitalSign  ? $vitalSign->bp_systolic : Form::getValueAttribute('bp_systolic', null) }}}" class="form-control"
                   placeholder="e.g 120">
            <span id="error_bp" class="field-validation-msg"></span>
        </div>
    </div>


    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">BP Dialostic</label>
        <div class="col-xs-7">
            <input type="number" id="bp_diastolic" name="bp_diastolic"
                   value="{{{ $vitalSign  ? $vitalSign->bp_diastolic : Form::getValueAttribute('bp_diastolic', null) }}}" class="form-control"
                   placeholder="e.g 80">
            <span id="error_bp" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Blood Group</label>
        <div class="col-xs-7">
            <input type="text" id="blood_group" name="blood_group"
                   value="{{{ $vitalSign  ? $vitalSign->blood_group : Form::getValueAttribute('blood_group', null) }}}" class="form-control"
                   placeholder="Blood Group">
            <span id="error_blood" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Pulse Rate</label>
        <div class="col-xs-7">
            <input type="number" id="pulse_rate" name="pulse_rate"
                   value="{{{ $vitalSign  ? $vitalSign->pulse_rate : Form::getValueAttribute('pulse_rate', null) }}}" class="form-control"
                   placeholder="Pulse Rate">
            <span id="error_pulse_rate" class="field-validation-msg"></span>
        </div>
    </div>


    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Breathing Rate</label>
        <div class="col-xs-7">
            <input type="number" id="respiration_rate" name="respiration_rate"
                   value="{{{ $vitalSign  ? $vitalSign->respiration_rate : Form::getValueAttribute('respiration_rate', null) }}}"
                   class="form-control" placeholder="Respiration Rate">
            <span id="error_rr" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Body Temp</label>
        <div class="col-xs-7">
            <input type="number" id="temperature" name="temperature"
                   value="{{{ $vitalSign  ? $vitalSign->temperature : Form::getValueAttribute('temperature', null) }}}" class="form-control"
                   placeholder="in foriegn Height ">
            <span id="error_blood" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Gait Speed</label>
        <div class="col-xs-7">
            <input type="number" id="gait_speed" name="gait_speed"
                   value="{{{ $vitalSign  ? $vitalSign->gait_speed : Form::getValueAttribute('gait_speed', null) }}}" class="form-control"
                   placeholder="distance/time ">
            <span id="error_gait" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Addiction</label>
        <div class="col-xs-7">
            <input type="text" id="addiction" name="addiction"
                   value="{{{ $vitalSign  ? $vitalSign->addiction : Form::getValueAttribute('addiction', null) }}}" class="form-control"
                   placeholder="Alcohol etc">
            <span id="error_addiction" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Healthy Socities</label>
        <div class="col-xs-7">
            <input type="text" id="communities" name="communities"
                   value="{{{ $vitalSign  ? $vitalSign->communities : Form::getValueAttribute('communities', null) }}}" class="form-control"
                   placeholder="gym etc">
            <span id="error_communities" class="field-validation-msg"></span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <label class="col-xs-5 control-label asterisk">Note</label>
        <div class="col-xs-7">
            <input type="text" id="note" name="note"
                   value="{{{ $vitalSign  ? $vitalSign->note : Form::getValueAttribute('note', null) }}}" class="form-control"
                   placeholder="Extra Note">
            <span id="error_note" class="field-validation-msg"></span>
        </div>
    </div>

{{--</form>--}}
<div class="modal-footer">

            <button type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit btn btn-default">Save</button>

             <button type="button" id="btnModalClose" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
{{--</section>--}}


@section('scripts')
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
    <script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>
    <script src="{{asset('js/view-pages/vital_signs/VitalSignsForm.js')}}"></script>
    <script>
        window.patientPrescriptionUrl = 0;
        $(document).ready(function () {
            var options = {
                saveCloseUrl: "{{route('patients.index')}}",
                VitalSignUrl: "{{route('vitalSignFetchHistory')}}"
            };
            var vitalSignsForm = new VitalSignsForm(window, document, options);
            vitalSignsForm.initializeAll();
        });
    </script>
@stop