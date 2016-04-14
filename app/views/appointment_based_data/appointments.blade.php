@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Select Appointment
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Manage Appointments</div>
</div>
@stop

@section('sliderContent')
@stop

<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
    <div class="container mT20">
    <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Users List</h1>
    <hr class="w100p fL mT0" />
    <section id="form-Section">
        <!--========================================================
                                 Data Table
        =========================================================-->
        @if(Auth::user()->role != 'Doctor' && isset($pId))
            {{ link_to_route('allergies.create', 'Add New Allergy', ['id' => $pId], ['class' => 'btn_1'])}}
        @endif-->
        <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Checkup Fee</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($appointments)
                    @if(isset($clinics) && ($clinics) != null)
                        @if(($clinics->count()))
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{{ $appointment->patient->name }}}</td>
                                    <td>{{{ $appointment->employee->name }}}</td>
                                    <td>{{{ date('j F, Y', strtotime($appointment->date)) }}}</td>
                                    <td>{{{ $appointment->timeslot->slot }}} </td>
                                    <td>
                                        @if(($appointment->checkupfee) != null)
                                            {{ $appointment->checkupfee->checkup_fee . '-/Rs'}}
                                        @else
                                            Unpaid
                                        @endif
                                    </td>
                                    <td>
                                        @if($flag == 'vitals')
                                            @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'Receptionist')
                                                {{ link_to_route('vitalsigns.create', 'Add', ['id' => $appointment->id], ['class' => 'data_table_btn'])}}
                                            @elseif(Auth::user()->role == 'Doctor')
                                                {{ link_to_route('vitalsigns.show', '', ['id' => $appointment->id], ['class' => 'btn-view-icon fL'])}}
                                            @endif
                                        @elseif($flag == 'prescription')
                                                {{ link_to_route('prescriptions.create', 'Add', ['id' => $appointment->id], ['class' => 'data_table_btn'])}}
                                        @elseif($flag == 'test')
                                                {{ link_to_route('labtests.index', 'Select', ['id' => $appointment->id], ['class' => 'data_table_btn'])}}
                                        @elseif($flag == 'proc')
                                             {{ link_to_route('diagonosticprocedures.create', 'Add', ['id' => $appointment->id], ['class' => 'data_table_btn'])}}
                                        @elseif($flag == 'check_fee')
                                            @if(Auth::user()->role == "Accountant")
                                                @if(($appointment->checkupfee) != null)
                                                    {{ link_to_route('checkupfees.show', '', ['id' => $appointment->id], ['class' => 'btn-view-icon fL'])}}
                                                    {{ link_to_route('checkupfees.edit', 'Edit', ['id' => $appointment->id], ['class' => 'data_table_btn'])}}
                                                @else
                                                    {{ link_to_route('checkupfees.create', 'Add', ['id' => $appointment->id], ['class' => 'data_table_btn'])}}
                                                @endif
                                            @else
                                             {{ link_to_route('checkupfees.create', 'Add', ['id' => $appointment->id], ['class' => 'data_table_btn'])}}
                                            @endif
                                        @elseif($flag == 'test_fee')
                                             {{ link_to_route('labtests.index', 'Select', ['id' => $appointment->id, 'flag' => 'test_fee'], ['class' => 'data_table_btn'])}}
                                        @elseif($flag == 'pres_print')
                                            {{ link_to_route('prescriptions.show', 'Select', ['id' => $appointment->id, 'flag' => 'print'], ['class' => 'data_table_btn'])}}
                                        @elseif($flag == 'test_print')
                                            {{ link_to_route('labtests.index', 'Select', ['id' => $appointment->id, 'flag' => 'print'], ['class' => 'data_table_btn'])}}
                                        @elseif($flag == 'checkup_invoice')
                                            {{ link_to_route('checkupfees.show', '', ['id' => $appointment->id, 'flag' => 'checkup_invoice'], ['class' => 'btn-view-icon fL'])}}
                                        @elseif($flag == 'test_invoice')
                                            {{ link_to('test_invoice_print?id='.$appointment->id, 'Print', ['class' => 'data_table_btn'])}}
                                        @elseif($flag == 'pdf_record')
                                            {{ link_to('pdf?id='.$appointment->id, 'Save PDF', ['class' => 'data_table_btn'])}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6"> There is no record found</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td colspan="6"> There is no record found</td>
                        </tr>
                    @endif
                @endif
            </tbody>
        </table>
        @if($flag == 'pdf_record')
            {{ $appointments->appends(['id' => $patient->id])->links('partials.pagination') }}
        @else
            {{ $appointments->links('partials.pagination') }}
        @endif
    </section>
</div>
@stop

