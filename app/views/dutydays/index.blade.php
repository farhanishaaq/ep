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
@section('content')
<div class="container mT20">
    <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Duty Days</h1>
    <hr class="w100p fL mT0" />
    <section id="form-Section">
        <!--========================================================
                                 Data Table
        =========================================================-->
        {{ link_to_route('dutydays.create', 'Create Duty Days', '', ['class' => 'btn_1'])}}
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
                        <td>{{{ $dutyDay->employee->name }}}</td>
                        <td>
                        {{ link_to_route('dutydays.show', '', [$dutyDay->employee->id], ['class' => 'btn-view-icon fL','title'=> 'View Record'])}}
                        <span class="fL">&nbsp;|&nbsp;</span>{{ link_to_route('dutydays.edit', '', [$dutyDay->employee->id], ['class' => 'btn-edit-icon fL','title'=> 'Edit Record'])}}
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
        {{ $dutyDays->links('partials.pagination') }}
    </section>
</div>
@stop

@section('scripts')
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

