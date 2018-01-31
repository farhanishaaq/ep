<head>
    <link href="{{asset('comment.css')}}" rel="stylesheet">
</head>
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Doctors
@stop

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Portal Doctor Requests
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
    @if($action['condition'] == 'Request')
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'; float: left;">Doctor Request List</h1>
        <button  onclick="window.location = '{{ route('doctorAllRequest')}}';" class="btn btn-style mT10 mB0" style="float: right;">Doctors History <span class="glyphicon glyphicon-search"></span></button>
        @else
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'; float: left;">All Doctors Status</h1>
        <button  onclick="window.location = '{{ route('doctorStatus')}}';" class="btn btn-style mT10 mB0" style="float: right;">Doctor Request<span class="glyphicon glyphicon-search"></span></button>

@endif
        {{--<button class="mT10 mB0 c3" style="font-family: 'Marvel'; float: right;"><h3>Comment History</h3></button>--}}
        <hr class="w100p fL mT0" />
        <section id="form-Section">
            <!--========================================================
                                     Data Table
            =========================================================-->
            @if(Auth::user()->role == 'Administrator')
                 link_to_route('prescriptions.create', 'Create Prescription', '', ['class' => 'btn_1'])
            @endif
            <table id="tblRecordsList" class="mT20 table table-hover table-striped display noShow">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>User_Id</th>
                    <th>User_Type</th>
                    <th>Doctor Profile</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Case_Rejection</th>

                </tr>
                </thead>
                 <tbody>
                @foreach ($data as $dataDoctors)
                    <tr>
                        <td></td>
                        <td>{{$dataDoctors->id}}</td>
                        <td>{{$dataDoctors->user_type}}</td>
                        <td>
                        <span class="pT0">
                        <a style="" href="{{route('drProfile',$dataDoctors->id)}}"  class="btn btn-raised btn-sm">View Profile</a>
                        </span>
                        </td>
                        <td>{{$dataDoctors->created_at}}</td>

                        <td>
                            <label class="switch">


                             @if($dataDoctors->status == "Active" )
                            <input type="checkbox" id="{{$dataDoctors->id}}" onchange="doctorStatusUpdate(this.id)"
                             checked>
                             @elseif($dataDoctors->status == "Inactive")
                            <input type="checkbox" id="{{$dataDoctors->id}}" onchange="doctorStatusUpdate(this.id)">
                             @elseif($dataDoctors->status == "Rejected")
                            <input class="alert-warning" type="checkbox" id="{{$dataDoctors->id}}" onchange="doctorStatusUpdate(this.id)">
                            @endif

                            <span class="slider round"></span>
                                                        </label>
                        </td>
                        @if($dataDoctors->user_type == "Rejected")
                        <td>
                        <input type="button" class="btn-danger" value="Reject">
                        </td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>
        </section>
<span class="center"><?php echo $data->links(); ?></span>
    </div>

    <script src="{{asset('js/commentStatus.js')}}"></script>
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


