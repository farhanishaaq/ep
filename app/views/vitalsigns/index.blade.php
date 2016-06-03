@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Manage Vital Signs
@stop

@section('redBar')
<div class = "user_logo">
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
    <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">ADD Vital Sign</h1>
    <hr class="w100p fL mT0" />
    <section id="form-Section">
        <!--========================================================
                                 Data Table
        =========================================================-->
        <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
            <thead>
                <tr >
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th style="width: 25%">Action</th>
                </tr>
            </thead>

            <tbody>
                @if(($appointments) != null)
                @foreach($appointments as $appointment)
                <tr class="row-data">
                    <td>{{{ $appointment->patient->name }}}</td>
                    <td>{{{ $appointment->employee->name }}}</td>
                    <td>{{{ $appointment->date }}}</td>
                    <td>{{{ $appointment->timeslot->slot }}}</td>
                    <td>
                    @if(Auth::user()->role == 'Receptionist')
                    {{ link_to_route('vitalsigns.create', '', ['id'=>$appointment->id], ['class' => 'btn-add_vsign-icon fL','title'=> 'Add Vital Sign'])}}
                    @elseif( Auth::user()->role == 'Doctor')
                    <span class="fL">&nbsp;|&nbsp;</span>
                    {{ link_to_route('vitalsigns.show', '', ['id' => $appointment->id], ['class' => 'btn-view-icon fL','title'=> 'View Record'])}}
                    @endif
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
        {{ $appointments->appends(['id' => $patient_id])->links('partials.pagination') }}
    </section>
</div>
@stop
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        if ($('#tblRecordsList tr.row-data').length) {
            $('#tblRecordsList').DataTable({
                "columnDefs": [{
                        "targets": 5,
                        "orderable": false
                    }]
            });
        }
    });
</script>
@stop
