@extends('layouts.master')
        <!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Patients
@stop

@section('redBar')
    <div class="user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
            {{--<div class="col-md-12 mL25 taL">Easy Physician</div>--}}
        </div>
    </div>
    @stop

    @section('sliderContent')
    @stop
            <!--========================================================
                          CONTENT
=========================================================-->

@section('content')
    <div class="container mT20">
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Manage Patients</h1>
        <hr class="w100p fL mT0"/>
        <section id="form-Section">

            <!--========================================================
                                         Data Table
                =========================================================-->
            {{ link_to_route('patients.create', 'Register Patient', '', ['class' => 'btn_1'])}}
            <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Last Visit</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Cell</th>
                    <th>Manage</th>
                </tr>
                </thead>

                <tbody>


                @foreach($patients as $patient)
                    <tr class="row-data">
                        <td>{{{ $patient->user->id }}}</td>
                        <td>{{{ $patient->user->full_name }}}</td>
                        <td>{{{ $patient->id }}}</td>
                        <td>{{{ get_age_from_dob($patient->user->dob) }}} - Years</td>
                        <td>{{{ $patient->user->gender }}}</td>
                        <td>{{{ $patient->user->cell }}}</td>
                        <td id="vitalSignHistory">
                            {{ link_to_route('patients.show', '', [$patient->id], ['class' => 'btn-view-icon fL', 'style' => 'margin-bottom: 2px'])}}

                            <span class="fL">&nbsp;|&nbsp;</span>{{ link_to_route('patients.edit', '', [$patient->id], ['class' => 'btn-edit-icon fL'])}}
                            <span class="fL">&nbsp;|&nbsp;</span><a href="javascript:void(0);" class="btn-view-prescription-icon fL viewPresc" title="Prescriptions of {{$patient->user->full_name}}" data-toggle="modal" data-target="#myModal" patient-prescription-url="{{route('patientPrescriptions',['patientId'=>$patient->id])}}"></a>
                            <span class="fL">&nbsp;|&nbsp;</span><a href="javascript:void(0);" class="glyphicon glyphicon-heart fL viewPresc appointmentsModalLink" title="Appointment list with Vital Signs of {{$patient->user->full_name}}" data-toggle="modal" data-target="#appointmentsModal"  patient_id="{{{ $patient->id }}}"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </section>

    </div>

    @include('appointments.includes.appointmentModal')

    {{--Patient Priccriptions Modal--}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Prescriptions List</h4>
                </div>
                <div class="modal-body row">
                    <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Date</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody id="prescriptionTbody">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" id="btnSave" name="btnSave" class="btn btn-default" >Save</button>--}}
                    <button type="button" id="btnModalClose" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@stop

@section('scripts')

    <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
    <script src="{{asset('js/view-pages/patients/PatientsList.js')}}"></script>
    <script>
        window.patientPrescriptionUrl = 0;
        $(document).ready(function () {

            var options = {
                saveCloseUrl: "{{route('patients.index')}}",
                listCols: '8',
                vsScheduleViewUrl: "{{route('fetchAppointmentsByPatientId')}}"
            };

            var patientsList = new PatientsList(window, document, options);
            patientsList.initializeAll();


            //****BS-Modal Show Event
//            $('#appointmentsModal').on('show.bs.modal', function () {
            $(".appointmentsModalLink").click(function(){
                var patientIdVal = $(this).attr('patient_id');

                $.ajax({
                    type: "GET",
                    url: "{{ route('fetchAppointmentsByPatientId') }}",
                    data: {patientId: patientIdVal},
                    success: function(response) {
                        if(response == "Error"){

                        }else{
                            $('#appointmentsViewTbody').html(response);
                            $('#appointmentsModal').show();

                            //vital signs according to appointment
                                $("#timeSlotLink").click(function ()
                                {
                                    var patientIdValforVS = $(this).attr('data');

                                    $.ajax({
                                        type: "GET",
                                        url: "{{ route('fetchVitalSignsByPatientId') }}",
                                        data: {patientId: patientIdValforVS},
                                        success: function (response) {
                                            if (response == "Error") {
                                                $('.vitalSignsResponse').html('You have got an error');
                                            } else {

                                                $('.vitalSignsResponse').html(response);

                                            }
                                        }


                                    });
                                });
                        }
                    }
                });
            });
        });
    </script>
@stop
