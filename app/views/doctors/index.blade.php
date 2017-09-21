@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Doctors
@stop

@section('redBar')
    <div class = "user_logo">        <div class="header_1 wrap_3 color_3 login-bar">            @if(isset(Auth::user()->company->name))            {{Auth::user()->company->name}}            @else                Easy Physician            @endif
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
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Manage Doctors</h1>
        <hr class="w100p fL mT0" />
        <section id="form-Section">

		<!--========================================================
                                     Data Table
            =========================================================-->
            {{ link_to_route('doctors.create', 'Add New Doctor', '', ['class' => 'btn_1'])}}
            <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
                <thead>
                    <tr>
                        <th>ID</th>
                        @if(current_user_type() == \App\Globals\GlobalsConst::SUPER_ADMIN)
                            <?php $cols = 7?>
                            <th>Company</th>
                            <th>Business Unit</th>
                        @elseif(current_user_type() == \App\Globals\GlobalsConst::ADMIN)
                            <?php $cols = 6?>
                            <th>Business Unit</th>
                        @endif
                        <th>Doctor Name</th>
                        <th>Specialty</th>
                        <th>Qualification</th>
                        <th>Cell</th>
                        <th>Manage</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr class="row-data">
                            <?php
                            $doctorId = $user->id;
                            $medicalSpecialties = isset($user->doctor->medicalSpecialties) ? $user->doctor->medicalSpecialties : null;
                            $qualifications = isset($user->doctor->qualifications) ? $user->doctor->qualifications : null;
                            ?>
                            <td>{{{ $user->id }}}</td>
                            @if(current_user_type() == \App\Globals\GlobalsConst::SUPER_ADMIN)
                                <td>{{{ $user->employee->doctor->user->company->name }}}</td>
                                <td>{{{ $user->employee->doctor->user->businessUnit->name }}}</td>
                            @elseif(current_user_type() == \App\Globals\GlobalsConst::ADMIN)
                                <td>{{{ $user->employee->doctor->user->businessUnit->name }}}</td>
                            @endif
                            <td>{{{ $user->employee->doctor->user->full_name }}}</td>
                            <td>{{{ get_collection_col_as_str($medicalSpecialties) }}}</td>
                            <td>{{{ get_collection_col_as_str($qualifications,'code') }}}</td>
                            <td>{{{ $user->employee->doctor->user->cell }}}</td>
                            <td>
                            {{ link_to_route('doctors.show', '', [$doctorId], ['class' => 'btn-view-icon fL', 'style' => 'margin-bottom: 2px'])}}

                            <span class="fL">&nbsp;|&nbsp;</span>{{ link_to_route('doctors.edit', '', [$doctorId], ['class' => 'btn-edit-icon fL'])}}
                            @if(is_dr_duty_days_exists($doctorId))
                                    <span class="fL">&nbsp;|&nbsp;</span><a href="#myModal" class="btn-view-duty-day-icon fL openScheduleView" title="Dr. {{$user->full_name}} Schedule View"  data-toggle="modal" data-target="#myModal" dr-schedule-view-url="{{route('dutyDays.show',[$user->id])}}"></a>
                                @else
                                    <span class="fL">&nbsp;|&nbsp;</span><a href="javascript:void(0);" class="btn-add-duty-day-icon fL openScheduleFrom" title="Dr. {{$user->full_name}} Schedule Form"  dr-schedule-form-url="{{route('dutyDays.create',['doctor_id'=> $user->id])}}"></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>

    {{--Patient Priccriptions Modal--}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Duty Days View</h4>
                </div>
                <div id="scheduleViewTbody" class="modal-body row">

                </div>
                <div class="modal-footer">
                    {{--<button type="button" id="btnSave" name="btnSave" class="btn btn-default" >Save</button>--}}
                    <button type="button" id="btnModalClose"dl class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('js/view-pages/doctors/DoctorsList.js')}}"></script>
    <script type="text/javascript">
        window.patientPrescriptionUrl = 0;
        $(document).ready(function() {
            var options = {
                listCols: '{{$cols}}'
            };
            var doctorsList = new DoctorsList(window,document,options);
            doctorsList.initializeAll();
        } );
    </script>
@stop
