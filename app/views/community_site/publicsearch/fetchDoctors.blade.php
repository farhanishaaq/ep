@extends('layouts.master')
        <!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Find doctor
    @stop

    @section('sliderContent')
    @stop
            <!--========================================================
                          CONTENT
=========================================================-->
@section('content')
    <section id="content">
        <!-- start search bar -->
            {{ Form::open(['method'=>'POST','action'=>'searchDoctors','class'=>'navbar-form navbar-left','role'=>'search'])  }}

            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" placeholder="Search...">
            </div>
                <input type="submit" id="search" name="searchbutton" value="Serach" class="search" />
            {{ Form::close() }}

        <!-- end search bar -->
         <div class="row mT30" id="search-results">
            <div class="container mT20">
                <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Doctors</h1>
                <div class="brief-info">
                    @if($doctors_info != NULL)
                        @foreach($doctors_info as $doctor_info)
                        {{--<pre>--}}
                        {{--{{dd($doctor_info)}}--}}
                        {{--{{ get_collection_col_as_str($doctor_info->title,"title") }}--}}

                        <a itemprop="url" href=""><button class="pull-right btn btn-blue hidden-xs">View Details</button></a>
                        <a style="text-decoration: none;" href=""><h2 itemprop="name">{{ $doctor_info->full_name }}<img style="height: 100px; width: 100px;" itemprop="image" style="min-height:40px;min-width:40px" src="{{ URL::to('/') }}/images/{{$doctor_info->photo}}" alt="Sorry, image failed to load"></h2></a>
                        <h5 style="color: #014e78;"><td>{{ $doctor_info->name }}</td></h5>
                        <p class="degrees">{{ $doctor_info->gender }}</p>
                        <p><img style="height: 20px; width: 20px;" src="{{ URL::to('/') }}/images/location.png"> <span>Address:</span> <span itemprop="address" style="color: black">{{ $doctor_info->address }}</span></p>
                        <p><img style="height: 20px; width: 20px;" src="{{ URL::to('/') }}/images/fee_icon.jpg"> <span>Fee Range: </span> <span itemprop="priceRange" style="color: black">{{ $doctor_info->min_fee . '-' . $doctor_info->max_fee }}</span></p>
                        <p><span style="font-family: bold;">Day:</span> <span itemprop="day" style="color: black">{{ $doctor_info->day }}</span></p>
                        <p><span style="font-family: bold;">Stating Time:</span> <span itemprop="start" style="color: black">{{ $doctor_info->start }}</span></p>
                        <p><span style="font-family: bold;">Ending Time:</span> <span itemprop="end" style="color: black">{{ $doctor_info->end }}</span></p>
                        {{--<a itemprop="url" href=""><button class="btn btn-danger visible-xs">View Details</button></a>--}}
                    @endforeach
                    @else
                        <p>Sorry, you have not any record</p>
                    @endif
                </div>
            </div>

        </div>
    </section>
@stop



    <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
    <script src="{{asset('js/view-pages/doctors/FindDoctors.js')}}"></script>
    <script>

        {{--$(document).ready(function () {--}}

            {{--var options = {--}}
                {{--vsScheduleViewUrl: "{{route('fetchDoctors')}}"--}}
            {{--};--}}

            {{--var findDoctors = new FindDoctors(window, document, options);--}}
            {{--findDoctors.initializeAll();--}}

        {{--});--}}
    </script>
