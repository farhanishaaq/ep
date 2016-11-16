{{-- Patient Vital Signs Detail --}}
<div id="patientVitalSigns" class="modal fade" role="dialog">
    <div class="modal-dialog w800">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Vital Signs</h4>
            </div>
            <div id="vitalSignHistory" class="modal-body row">

                <tbody id="vitalSignsViewTbody">

                </tbody>

                @if($_form)
                    {{$_form}}
                @endif
            </div>

        </div>

    </div>
</div>
