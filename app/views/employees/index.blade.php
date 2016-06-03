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
    <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Users List</h1>
    <hr class="w100p fL mT0" />
    <section id="form-Section">
        <!--========================================================
                                 Data Table
        =========================================================-->
        {{ link_to_route('employees.create', 'Register Employee', '', ['class' => 'btn_1'])}}
        <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @if(($employees) != null)
                @if(($employees->count()))
                @foreach($employees as $employee)
                    <tr class="row-data">
                        <td>{{{ $employee->name }}}</td>
                        <td>{{{ $employee->email }}}</td>
                        <td>{{{ $employee->gender }}}</td>
                        <td>{{{ $employee->role }}}</td>
                        <td>{{{ $employee->branch }}}</td>
                        <td>{{{ $employee->status }}}</td>
                        <td>
                        {{ link_to_route('employees.show', '', [$employee->id], ['class' => 'btn-view-icon fL','title'=> 'View Record'])}}
                        @if($employee->role == 'Administrator' || $employee->role == 'Super User')
                            <span class="fL">&nbsp;|&nbsp;</span><a href="javascript:void(0)" class="btn-edit-disable-icon fL" title="Edit Record not allowed"></a>
                        @else
                            <span class="fL">&nbsp;|&nbsp;</span>{{ link_to_route('employees.edit', '', [$employee->id], ['class' => 'btn-edit-icon fL','title'=> 'Edit Record'])}}
                        @endif
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
        {{ $employees->links('partials.pagination') }}
    </section>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    if($('#tblRecordsList tr.row-data').length){
        $('#tblRecordsList').DataTable({
            "columnDefs": [ {
            "targets": 6,
            "orderable": false
            } ]
        });
    }
} );
</script>
@stop
