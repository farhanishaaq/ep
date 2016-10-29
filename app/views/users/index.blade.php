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
        {{ link_to_route('users.create', 'Register Employee', '', ['class' => 'btn_1'])}}
        <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
            <thead>
                <tr>
                    <th>ID</th>
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
            @if(($users) != null)
                @if(($users->count()))
                @foreach($users as $u)
                    <tr class="row-data">
                        <td>{{{ $u->id }}}</td>
                        <td>{{{ $u->full_name }}}</td>
                        <td>{{{ $u->email }}}</td>
                        <td>{{{ $u->gender }}}</td>
                        <td>{{{ $u->role }}}</td>
                        <td>{{{ $u->businessUnit->name }}}</td>
                        <td>{{{ $u->status }}}</td>
                        <td>
                        {{ link_to_route('users.show', '', [$u->id], ['class' => 'btn-view-icon fL','title'=> 'View Record'])}}
                        @if($u->role == 'Administrator' || $u->role == 'Super User')
                            <span class="fL">&nbsp;|&nbsp;</span><a href="javascript:void(0)" class="btn-edit-disable-icon fL" title="Edit Record not allowed"></a>
                        @else
                            <span class="fL">&nbsp;|&nbsp;</span>{{ link_to_route('users.edit', '', [$u->id], ['class' => 'btn-edit-icon fL','title'=> 'Edit Record'])}}
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
    </section>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    if($('#tblRecordsList tr.row-data').length){
        $('#tblRecordsList').DataTable({
            "columnDefs": [
                {
                    "targets": 7,
                    "orderable": false
                },
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                },
            ],
            "order": [[ 0, "desc" ]],
            "lengthMenu": [20, 40, 60, 80, 100],
            "pageLength": "{{\App\Globals\GlobalsConst::LIST_DATA_LIMIT}}"
        });
    }
} );
</script>
@stop
