
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Create Appointment
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Health Articles
        </div>
    </div>
@stop

@section('sliderContent')
@stop


@section('content')




<?php $image = '/articleimage'.'/'.$articles->id.'/'.$articles->bannar_image?>

    <main class="site-main">

        <!-- Page Content -->
        <div class="container">

            <div class="col-xl-12 col-lg-12 col-md-12 col-12 " style="padding-top: 10px">
                <img class="col-xl-12 col-lg-12 col-md-12 col-12" style="max-height: 400px" src="{{asset($image)}}" alt="Post" />
            </div>

            <!-- Container -->
            <div class="container">
                <div class="row">

                    <div class="ft-ctbox clearfix">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 " style="color: #0d638f; font-size: xx-large " >
                            {{ $articles->title}}
                        </div>
                      {{ $articles->article_text}}

                    </div>


                </div>
            </div>





        </div>
    </main>











@stop