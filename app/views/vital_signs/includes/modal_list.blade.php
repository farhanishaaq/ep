{{-- Patient Vital Signs Detail --}}
<div id="patientVitalSigns" class="modal fade" role="dialog">
    <div class="modal-dialog w800">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Vital Signs List</h4>
            </div>
            <div class="modal-body row">
                @if($_view)
                    {{$_view}}
                @endif
            </div>

        </div>

    </div>
</div>


@section('scripts')
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
    <script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>
    <script src="{{asset('js/view-pages/vital_signs/VitalSignsList.js')}}"></script>
    <script>
        window.patientPrescriptionUrl = 0;
        $(document).ready(function () {
            var options = {
                saveCloseUrl: "{{route('patients.index')}}",
                VitalSignUrl: "{{route('fetchappointmentsbypatientid')}}"
            };


        });
    </script>
@stop