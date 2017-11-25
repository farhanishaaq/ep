@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Comments
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
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Comments List</h1>
        <hr class="w100p fL mT0" />
        <section id="form-Section">
            <!--========================================================
                                     Data Table
            =========================================================-->
            @if(Auth::user()->role == 'Administrator')
                 link_to_route('prescriptions.create', 'Create Prescription', '', ['class' => 'btn_1'])
            @endif
            <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
                <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Comments Details</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
<tr></tr>
<tr></tr>
                @foreach ($commentPatient as $comment)
                                <tr>
                                <td>{{$comment->comments}}</td>
                                </tr>

                                 @endforeach

                </tbody>
            </table>
        </section>
    </div>
@stop
{{--@section('scripts')--}}
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function() {--}}
            {{--if($('#tblRecordsList tr.row-data').length){--}}
                {{--$('#tblRecordsList').DataTable({--}}
                    {{--"columnDefs": [ {--}}
                        {{--"targets": 3,--}}
                        {{--"orderable": false--}}
                    {{--} ]--}}
                {{--});--}}
            {{--}--}}
        {{--} );--}}
    {{--</script>--}}
{{--@stop--}}


