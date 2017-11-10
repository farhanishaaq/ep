<head>
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
</head>

@extends('layouts.master')
<!--========================================================
   TITLE
   =========================================================-->
@section('title')
    EP-Sociale Doctors
@stop
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">
            Searched "Dermatologist / Skin Specialist" in Lahore
        </div>
    </div>
@stop
@section('sliderContent')
@stop
<!--========================================================
   CONTENT
   =========================================================-->
@section('content')

    <!-- Page Loader -->
    <div class="container-fluid">
        <div class="row"></div>
        <div class="block-header">
            <h4 style="margin-left: 50px;">EP-Sociale</h4>
        </div>
        <div class="col-md-12 col-sm-12  col-lg-12">
            <div class="col-md-3 col-sm-3  col-lg-3">
                <div class="card">
                    <div class="body">
                        <div class="member-card verified">
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="zmdi zmdi-more-vert"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Edit</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Delete</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Block</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="thumb-xl member-thumb">
                            <img src="{{asset('images/random-avatar3.jpg')}}" class="img-circle" alt="profile-image">
                            <i class="zmdi zmdi-info" title="verified user"></i>
                        </div>
                        <div>
                            <h4 class="m-b-5">Dr. Sheraz</h4>
                            <p class="text-muted">Dentist<span> <a href="#" class="text-pink">websitename.com</a> </span></p>
                        </div>
                        <p class="text-muted">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
                        <a href="profile.html"  class="btn btn-raised btn-sm">View Profile</a>
                        <ul class="social-links list-inline m-t-10">
                            <li><a title="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                            <li><a title="twitter" href="#" ><i class="zmdi zmdi-twitter"></i></a></li>
                            <li><a title="instagram" href="3.html" ><i class="zmdi zmdi-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>


            {{--Right Panel--}}
            <div class="col-md-9 col-sm-9  col-lg-9" style="background-color: whitesmoke">

                {{--@foreach ($userData as $userdata)--}}
                    @for($i=0; $i<sizeof($doctors);$i++)




                    <div class="col-md-12 col-sm-12  col-lg-12 card" style="border-radius: 25px; padding-top: 10px; ">
                        <div class="col-md-3 col-sm-3  col-lg-3 align-center">
                            <div class="thumb-xl member-thumb " style="align-items: center">
                                <img src="{{asset('images/random-avatar3.jpg')}}" class="img-circle" alt="profile-image" >
                                <i class="zmdi zmdi-info" title="verified user"></i>
                                <div class="col-md-12" style=" border-radius:25px; margin-top:10px;border: 2px solid wheat; background-color: #00adef; color: white ">Exp. 15 year</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3  col-lg-3" >
                            <div class="col-xs-12 col-md-12 col-sm-12" style="text-align: center">
                                <h4 align="center"><strong>{{$userData[$i]->full_name}}</strong></h4>
                                <p align="center" >Skin Specialist <span> <a href="#" style="color: red">websitename.com</a> </span></p>
                                <a style="" href="profile.html"  class="btn btn-raised btn-sm">View Profile</a>
                                <ul class="social-links list-inline m-t-10">
                                    <li><a title="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a title="twitter" href="#" ><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a title="instagram" href="3.html" ><i class="zmdi zmdi-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3  col-lg-3" style="text-align: center">
                            <div style="">
                                <h5 align="center" ><strong>Signature Skin Care</strong></h5>
                                <p align="center" >(@foreach($dutyData[$i] as $dutydata)
                                        {{$dutydata->start}}
                                    @endforeach AM - @foreach($dutyData[$i] as $dutydata)
                                        {{$dutydata->end}}
                                    @endforeach PM)</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3  col-lg-3">
                            <div style=" margin-top: 15px; text-align: center ">

                                <button class="btn btn-raised btn-sm btn-warning" style="width: inherit ">Call Now</button>
                                <p>Fee Starting</p>
                                <p> <strong>{{$doctors[$i]->min_fee}}PKR</strong> To
                                    <strong>{{$doctors[$i]->max_fee}}PKR</strong></p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@stop

