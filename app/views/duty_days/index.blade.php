@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Employees
@stop

@section('redBar')
    <div class = "user_logo">        <div class="header_1 wrap_3 color_3 login-bar">{{Auth::user()->company->name}}
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
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Duty Days</h1>
        <hr class="w100p fL mT0" />
        <section id="form-Section">
            <!--========================================================
                                     Data Table
            =========================================================-->
            {{ link_to_route('dutyDays.create', 'Create Duty Days', '', ['class' => 'btn_1'])}}
            <table id="tblRecordsList" class="mT20 table table-hover table-striped display w100p">
                <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dutyDays as $dutyDay)
                    <tr class="row-data">
                        <td>{{{ $dutyDay->doctor->employee->user->full_name }}}</td>
                        <td>
                             @if(is_dr_duty_days_exists($dutyDay->doctor->employee->user->id))
                                <span class="fL">&nbsp;|&nbsp;</span><a href="#myModal" class="btn-view-duty-day-icon fL openScheduleView" title="Dr. {{$dutyDay->doctor->employee->user->full_name}} Schedule View"  data-toggle="modal" data-target="#myModal" dr-schedule-view-url="{{route('dutyDays2.show',[$dutyDay->doctor->employee->user->id])}}"></a>
                            @else
                                <span class="fL">&nbsp;|&nbsp;</span><a href="javascript:void(0);" class="btn-add-duty-day-icon fL openScheduleFrom" title="Dr. {{$dutyDay->doctor->employee->user->full_name}} Schedule Form"  dr-schedule-form-url="{{route('dutyDays.create',['doctor_id'=> $dutyDay->doctor->employee->user->id])}}"></a>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>

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

@stop
