<head>
    <link href="{{asset('comment.css')}}" rel="stylesheet">
</head>
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Manage Articles
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
        {{--<div class="col-md-12 mL25 taL">Easy Physician</div>--}}
    </div>
</div>
@stop
@section('content')




    <div class="container mT20">
        {{--@if($action['condition'] == 'Request')--}}
            {{--<h1 class="mT10 mB0 c3" style="font-family: 'Marvel'; float: left;">Request Comments List</h1>--}}
            {{--<button  onclick="window.location = '{{ route('commentHistory')}}';" class="btn btn-style mT10 mB0" style="float: right;">Comment History <span class="glyphicon glyphicon-search"></span></button>--}}
        {{--@else--}}
            {{--<h1 class="mT10 mB0 c3" style="font-family: 'Marvel'; float: left;">All Comments List</h1>--}}
            {{--<button  onclick="window.location = '{{ route('commentsStatus')}}';" class="btn btn-style mT10 mB0" style="float: right;">Request Comments <span class="glyphicon glyphicon-search"></span></button>--}}

        {{--@endif--}}
        {{--<button class="mT10 mB0 c3" style="font-family: 'Marvel'; float: right;"><h3>Comment History</h3></button>--}}
        <hr class="w100p fL mT0" />
        <section id="form-Section">
            <!--========================================================
                                     Data Table
            =========================================================-->

            <table id="tblRecordsList" class="mT20 table table-hover table-striped display noShow">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Doctor_ID</th>
                    <th>Article Title</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                </thead>

                @foreach($articlestatus as $data)

                    <tbody>
                    <tr>
                        <td></td>
                        <td> {{$data->doctor_id }}</td>


                        <td ><a href="{{url('articles/'.$data->id)}}">{{$data->title }}</a></td>




                        <td>{{$data->created_at }}</td>
                        <td>@if($data->status==0)Not Approved @else Approved @endif</td>
                        <td>
                            <label class="switch">

                                <input type="checkbox" id="{{$data->id}}" onchange="articlestatus(this.id)"
                                       @if($data->status == "1" )
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
        <span class="center"><?php echo $articlestatus->links(); ?></span>
    </div>


    <script src="{{asset('js/emailAvailability.js')}}"></script>
@stop




@section('sliderContent')
@stop



