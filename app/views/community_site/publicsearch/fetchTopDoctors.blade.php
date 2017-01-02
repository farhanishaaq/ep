@extends('layouts.master')
        <!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Top doctors List
    @stop

    @section('sliderContent')
    @stop
            <!--========================================================
                          CONTENT
=========================================================-->
@section('content')
    <section id="content">
        {{--<div class="container">--}}
            <div class="col-md-2 col-xs-12" style="position: relative; margin-top: 100px; ">

                <div style="float: left;"><label class="control-label asterisk">Filter by fees</label></div>
                <div style="margin-top: 50px"><input type="text" id="range" value="" name="range" /></div>

            </div>

            <div class="col-md-9 col-xs-12">
                <div class="container mT20">

                    <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Top Doctors List</h1>
                    <div class="brief-info">
                        <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name & Rating</th>
                                <th>Speciality</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Fees</th>
                                <th>Duty Days</th>
                            </tr>
                            </thead>
                         <tbody>
                        @if($doctors_list != NULL)
                            @foreach($doctors_list as $user_info)
                                <tr class="row-data">
                                {{--<div class="col-md-9 col-sm-9" style="float: left; padding: 10px;">--}}

                                    {{--<div class="col-md-3 col-sm-3" style="float: left;">--}}
                                        <td><a href="{{route('fetchDoctorDetails',[$user_info->id])}}"><img style="height: 100px; width: 100px;" itemprop="image" style="min-height:40px;min-width:40px" src="{{ URL::to('/') }}/images/{{$user_info->photo}}" alt="Sorry, image failed to load"></a></td>
                                    {{--</div>--}}

                                    <td><a style="text-decoration: none;" href="{{route('fetchDoctorDetails',[$user_info->id])}}"><h2 itemprop="name">{{ $user_info->full_name }}</h2> <div style="float: right;"><span style="font-family: strong; width: 30px; height: 30px; font-size: 18px; background-color: blue; color:white;">{{ $user_info->current_rating }}/5</span></div></a></td>
                                    <td><p class="degrees">{{ $user_info->name }}</p></td>
                                    <td><p class="degrees">{{ $user_info->gender }}</p></td>
                                    <td><p><img style="height: 20px; width: 20px;" src="{{ URL::to('/') }}/images/location.png"> <span>Address:</span> <span itemprop="address" style="color: black">{{ $user_info->address }}</span></p></td>
                                    <td><p><img style="height: 20px; width: 20px;" src="{{ URL::to('/') }}/images/fee_icon.jpg"> <span>Fee Range: </span> <span itemprop="priceRange" style="color: black">{{ $user_info->min_fee . '-' . $user_info->max_fee }}</span></p></td>

                                    @if($user_info->day && $user_info->start && $user_info->end)
                                        <td><p><span style="font-family: strong;">Working Days:</span> <span itemprop="day" style="color: black">{{ $user_info->day }}</span>
                                            <span style="font-family: strong;"> & Working Hours: </span><span itemprop="start" style="color: black">{{ $user_info->start }}</span><span> - </span><span itemprop="end" style="color: black">{{ $user_info->end }}</span>
                                        </p></td>
                                    @else
                                        <td><p>Sorry, Working days did not exist, Please contact us for appointment</p>
                                    @endif
                                    {{--<div style="border-color: red;">--}}
                                        {{--<span style=" font-family:Arial; font-size: 14px; background-color: white; color:black;">{{ $user_info->status }}</span>--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                               </tr>
                            @endforeach
                        @else
                            <p style="font-family: strong;">Sorry, you have not any record</p>
                        @endif
                        </tbody>
                        </table>
                    </div>

                </div>
            {{--</div>--}}

    </div>
    </section>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tblRecordsList').DataTable();

            $("#range").ionRangeSlider({
                hide_min_max: true,
                keyboard: true,
                min: 0,
                max: 5000,
                from: 1000,
                to: 4000,
                type: 'double',
                step: 1,
                prefix: "$",
                grid: true
            });
//            $("#range").ionRangeSlider({
//                type: "double",
//                min: 1000,
//                max: 5000,
//                from: 2000,
//                to: 4000,
//                step: 100,
//                onStart: function (data) {
//                    console.log(data);
//                },
//                onChange: function (data) {
//                console.log(data);
//            },
//            onFinish: function (data) {
//                console.log(data);
//            },
//            onUpdate: function (data) {
//                console.log(data);
//            }
//        });
        } );

    </script>
@stop

