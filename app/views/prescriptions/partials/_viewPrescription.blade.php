<style type="text/css">
    .hide {
        display: none;
    }
</style>
<h3 class="mT10 mB0 c3">View Prescription</h3>
<hr class="w95p fL mT0" />
<p class="col-xs-12 fL taR"></p>
<section class="form-Section col-md-12 h695 fL">
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
                <label class="form-control">{{{ $prescription->appointment->employee->name }}}</label>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Prescription Code:</label>
            <div class="col-xs-6">
                <label class="form-control">{{{ $prescription->code }}}</label>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        @if($medicines)
            @if(count($medicines))
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Medicines:</label>

                    <div class="col-xs-6 hAi">
                        <table class="table tblSchedule">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($medicines as $m)
                            <tr>
                                <td>{{$m->name}}</td>
                                <td>{{$m->pivot->quantity}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            @endif
        @endif


        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Other Medicines:</label>
            <div class="col-xs-6">
                <label class="form-control">{{{ $prescription->medicines == '' ? 'none' : $prescription->medicines}}}</label>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Note:</label>
            <div class="col-xs-6 hAi">
                <label class="form-control">{{{ $prescription->note }}}</label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Procedure:</label>
            <div class="col-xs-6 hAi">
                <label class="form-control">{{{ $prescription->procedure }}}</label>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>
    </div>
</section>
<div class="col-xs-12 taR pR0 mT20">
    <input type="button" id="cancel" value="Go Back" onclick="goTo('{{URL::previous()}}')" />
</div>

