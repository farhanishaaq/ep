<head>
    <link href="{{asset('comment.css')}}" rel="stylesheet">
</head>
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
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'; float: left;">Comments List</h1>
        <button  onclick="window.location = '{{ route('commentHistory')}}';" class="btn btn-style mT10 mB0" style="float: right;">Comment History <span class="glyphicon glyphicon-search"></span></button>

        {{--<button class="mT10 mB0 c3" style="font-family: 'Marvel'; float: right;"><h3>Comment History</h3></button>--}}
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
                    <th>Doctor_ID</th>
                    <th>Patient_ID</th>
                    <th>Comments Details</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                 <tbody>
                @foreach ($data as $dataComment)
                    <tr>
                        <td>{{$dataComment->doctor_id}}</td>
                        <td>{{$dataComment->patient_id}}</td>
                        <td>{{$dataComment->comments}}</td>
                        <td>{{$dataComment->created_at}}</td>
                        <td>
                            <label class="switch">

                            <input type="checkbox" id="{{$dataComment->commentId}}" onchange="statusUpdate(this.id)"
                             @if($dataComment->status == "Approved" )
                             checked
                            @endif
                            >
                            <span class="slider round"></span>
                                                        </label>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>

    <script src="{{asset('js/emailAvailability.js')}}"></script>
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


