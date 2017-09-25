<section class="form-Section col-xs-12 h695 fL">
    <div class="container w100p">
        <h3 class="mT15 mB0 c3">Prescription Info</h3>
        <hr class="w95p fL mT0" />
        <hr class="w95p fL mT0" />

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Visit Date*</label>
            <div class="col-xs-6">
                <label class="form-control">{{ date('j F, Y', strtotime($prescription->appointment->date)) }}</label>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Doctor Name*</label>
            <div class="col-xs-6">
                <label class="form-control">{{ $prescription->appointment->doctor->user->full_name }}</label>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Prescription Code:</label>
            <div class="col-xs-6">
                <label class="form-control">{{ $prescription->code }}</label>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>
        <div id="detailRowContainer">
            {{$_detail_row}}
        </div>
        <div col-xs-12>
             .
        </div>
        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Other Medicines:</label>
            <div class="col-xs-6">
                <label class="form-control">{{ $prescription->other_medicines == '' ? 'none' : $prescription->other_medicines}}</label>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Note:</label>
            <div class="col-xs-6 hAi">
                <label class="form-control">{{ $prescription->check_up_note }}</label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Procedure:</label>
            <div class="col-xs-6 hAi">
                <label class="form-control">{{ $prescription->test_procedures }}</label>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>
    </div>
</section>


