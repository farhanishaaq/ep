<section class="form-Section col-xs-12 h695 fL">
    <div class="container w100p">
        <h3 class="mT15 mB0 c3">Prescription Info</h3>
        <hr class="w95p fL mT0" />
        <hr class="w95p fL mT0" />

        <div class="form-group">

            <div class="col-xs-6">
                <div class="col-xs-5">
                    <label class=" control-label asterisk">Prescription Code: </label>
                </div>
                {{ $prescription->code }}
            </div>

            <div class="col-xs-6">
                <div class="col-xs-4">
                    <label class=" control-label asterisk">Visit Date: </label>
                </div>
                    {{ date('j F, Y', strtotime($prescription->appointment->date)) }}
            </div>
        </div>

        <div class="form-group">

            <div class="col-xs-6">
                <div class="col-xs-5">
                    <label class=" control-label asterisk">Follow Up Pres: </label></div>{{ $prescription->parent->code }}
            </div>

            <div class="col-xs-6">
                <div class="col-xs-4">
                    <label class=" control-label asterisk">Patient Name: </label>
                </div>
                {{ $prescription->appointment->patient->user->full_name }}
            </div>
        </div>

        <div class="form-group">


            <div class="col-xs-6">
                <div class="col-xs-5">
                    <label class=" control-label asterisk">Doctor Name: </label>
                </div>
                {{ $prescription->appointment->doctor->user->full_name }}

            </div>




            <div class="col-xs-6">
                <div class="col-xs-4">
                    <label class=" control-label asterisk">Refill: </label></div>
                <span align="center">{{ $prescription->refill }}</span>
            </div>
        </div>

        <div id="detailRowContainer">
            {{$_detail_row}}
        </div>
        <div col-xs-12>
             .
        </div>



        <div class="form-group">

            <div class="col-xs-6">
                <div class="col-xs-5">
                    <label class=" control-label asterisk">Procedure: <br></label>

                    {{ $prescription->test_procedures }}
                </div>
            </div>

            <div class="col-xs-6">
                <div class="col-xs-4">
                    <label class=" control-label asterisk">Note: </label>

                    {{ $prescription->check_up_note }}
                </div>

            </div>
        </div>

    </div>
</section>


