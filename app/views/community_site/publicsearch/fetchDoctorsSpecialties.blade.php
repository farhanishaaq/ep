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
        <div class="row mT30">
        <!-- start search bar -->
            {{ Form::open(['method'=>'POST','action'=>'searchAllDoctors','class'=>'navbar-form navbar-left','role'=>'search'])  }}

                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                </div>

             <input type="submit" id="search" name="searchbutton" value="Serach" class="search" />
            {{ Form::close() }}

        <!-- end search bar -->
        </div>

        <div class="row mT30">
            @foreach($doctors_specialties_list as $dlist)
                {{--<div class="col-md-1">--}}
                <div class="col-md-2 col-sm-2 col-xs-2">
                    {{--{{$dlist->name}}--}}
                    <div class="box_1">
                        <a href="{{route('fetchDoctors',[$dlist->name])}}" class="" title="Department of {{$dlist->name}}">
                            <img style="height: 100px; width: 100px;" itemprop="image" style="min-height:40px;min-width:40px" src="images/{{$dlist->photo}}" alt="Sorry, image failed to load">
                        </a>
                        {{--<a href="{{URL::route('fetchDoctors',array($dlist->id))}}" class="icon_3" title="Department of {{$dlist->name}}"></a>--}}


                    </div>
                </div>
            @endforeach

        </div>
    </section>
@stop