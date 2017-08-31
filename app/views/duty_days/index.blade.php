@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Employees
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
    </div>
</div>
@stop

@section('sliderContent')
@stop


<!--========================================================
                          CONTENT
=========================================================-->
<?php $cols = 5; ?>
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
            @if(($dutyDays) != null)
                @if(($dutyDays->count()))
                @foreach($dutyDays as $dutyDay)
                    <tr class="row-data">
                        <td>{{{ $dutyDay->doctor->employee->user->full_name }}}</td>
                        <td>
                            <span class="fL">&nbsp;&nbsp;</span><a href="#myModal" class="btn-view-duty-day-icon fL openScheduleView" title="Dr. {{$dutyDay->doctor->employee->user->full_name}} Schedule View"  data-toggle="modal" data-target="#myModal" dr-schedule-view-url="{{route('dutyDays.show',[$dutyDay->doctor->employee->user->id])}}"></a>
{{--                            {{ link_to_route('dutyDays.show', '', [$dutyDay->doctor->id], ['class' => 'btn-view-icon fL','title'=> 'View Record'])}}--}}
                        {{--<span class="fL">&nbsp;|&nbsp;</span>{{ link_to_route('dutyDays.edit', '', [$dutyDay->employee->id], ['class' => 'btn-edit-icon fL','title'=> 'Edit Record'])}}--}}
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="7"> There is no record found</td>
                    </tr>
                @endif
            @else
                <tr>
                    <td colspan="7"> There is no record found</td>
                </tr>
            @endif
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
<script type="text/javascript">
$(document).ready(function() {
    if($('#tblRecordsList tr.row-data').length){
        $('#tblRecordsList').DataTable({
            "columnDefs": [ {
            "targets": 1,
            "orderable": false
            } ]
        });
    }
} );
</script>
@stop

