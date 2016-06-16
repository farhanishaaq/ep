@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Allergy
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Manage Companies</div>
</div>
@stop

@section('sliderContent')
@stop
<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
<?php
$pId = ($patient) ? $patient->id : "";
?>
<div class="container mT20">
    <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Users List</h1>
    <hr class="w100p fL mT0" />
    <section id="form-Section">
        <!--========================================================
                                 Data Table
        =========================================================-->

        @if(Auth::user()->role != 'Doctor')
            {{ link_to_route('allergies.create', 'Add New Allergy', ['id' => $pId], ['class' => 'btn_1'])}}
        @endif
        <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
            <thead>
                <tr>
                    <th>Allergy Name</th>
                    <th>Allergy Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(($allergies) != null)
                    @foreach($allergies as $allergy)
                        <tr class="row-data">
                            <td>{{{ $allergy->allergy_name }}}</td>
                            <td>{{{ substr($allergy->allergy_note, 0, 50) }}}</td>
                            <td>
                            {{ link_to_route('allergies.show', '', [$allergy->id], ['class' => 'btn-view-icon fL','title'=> 'View Record'])}}

                            @if(Auth::user()->role != 'Doctor')
                                <span class="fL">&nbsp;|&nbsp;</span>{{ link_to_route('allergies.edit', '', [$allergy->id], ['class' => 'btn-edit-icon fL', 'title'=> 'Edit Record'])}}
                            @else
                                <span class="fL">&nbsp;|&nbsp;</span><a href="javascript:void(0)" class="btn-edit-disable-icon fL" title="Edit Record not allowed"></a>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="3"> There is no record found</td>
                </tr>
                @endif
            </tbody>
        </table>
        @if($allergies)
            {{ $allergies->appends(array('id' => $pId))->links('partials.pagination') }}
        @endif
    </section>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {

    if($('#tblRecordsList tr.row-data').length){
        $('#tblRecordsList').DataTable({
            "columnDefs": [ {
            "targets": 2,
            "orderable": false
            } ]
        });
    }

} );
</script>
@stop