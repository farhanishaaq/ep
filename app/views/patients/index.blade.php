@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Patients
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
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Manage Patients</h1>
        <hr class="w100p fL mT0" />
        <section id="form-Section">

		<!--========================================================
                                     Data Table
            =========================================================-->
            {{ link_to_route('patients.create', 'Register Patient', '', ['class' => 'btn_1'])}}
            <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Patient ID</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Manage</th>
                    </tr>
                </thead>

                <tbody>


                    @foreach($patients as $patient)
                        <tr class="row-data">
                            <td>{{{ $patient->name }}}</td>
                            <td>{{{ $patient->patient_id }}}</td>
                            <td>{{{ $patient->age }}} - Years</td>
                            <td>{{{ $patient->gender }}}</td>
                            <td>{{{ $patient->phone }}}</td>
                            <td>
                            {{ link_to_route('patients.show', '', [$patient->id], ['class' => 'btn-view-icon fL', 'style' => 'margin-bottom: 2px'])}}
                        
                            {{ link_to_route('patients.edit', '', [$patient->id], ['class' => 'btn-edit-icon fL'])}}

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $patients->links('partials.pagination') }}
        </section>


    </div>
@stop

