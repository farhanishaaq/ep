@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Edit Doctor
@stop

@section('redBar')
    <div >

    </div>
@stop

@section('sliderContent')
@stop
@section('content')
    {{--<div class="container">--}}

<?php $id=0; ?>

    @foreach($drRecord as $profile)
        <?php $id = $profile->id ?>
    {{--</div>--}}
    <div class=" container-fluid" style="max-width: 1200px;">
        {{--{{$drRecord->fname}}--}}
        {{--{{ $i=0 }}--}}


        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <div class="card card-topline-aqua">
                        <div class="card-body no-padding height-9">
                            <div class="row">
                                <div class="profile-userpic">
                                    <img src="{{ asset('images/dp.svg') }}" class="img-responsive" alt=""> </div>
                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> {{ $profile->full_name }} </div>
                                <div class="profile-usertitle-job"> Gynaecologist </div>
                            </div>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Fee:</b> <div class="profile-desc-item pull-right">{{$profile->max_fee}}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>Exprience</b> <div class="profile-desc-item pull-right">10Year</div>
                                </li>
                                <li class="list-group-item">
                                    <b>Rating</b> <div class="profile-desc-item pull-right">11,172</div>
                                </li>
                                <li class="list-group-item">
                                    <b>Degree</b>
                                    <div class="profile-desc-item pull-right">{{$profile->code}}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>Designation</b>
                                    <div class="profile-desc-item pull-right"></div>
                                </li>
                            </ul>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <div class="profile-userbuttons">
                                <button type="button" class="btn btn-circle green-bgcolor btn-sm">Get Appointment</button>
                                <button type="button" class="btn btn-circle red btn-sm">Ask a question</button>
                            </div>
                            <!-- END SIDEBAR BUTTONS -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header>About Me</header>
                        </div>
                        <div class="card-body no-padding height-9">
                            <div class="profile-desc">
                                {{$profile->additional_info}}

                            </div>



                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Gender </b>
                                    <div class="profile-desc-item pull-right">{{ $profile->gender }}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>Operation Done </b>
                                    <div class="profile-desc-item pull-right">30+</div>
                                </li>

                            </ul>
                            {{--star rating/--}}




                            <section class='rating-widget'>

                                <!-- Rating Stars Box -->
                                <div class='rating-stars text-center'>
                                    <ul id='stars'>
                                        <li class='star' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>

                            </section>

                            {{--star rating/--}}
                        </div>
                    </div>

                </div>

                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="card">
                            <div class="card-head card-topline-aqua">
                                <header></header>
                            </div>
                            <div class="card-body no-padding height-9">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="tabbable-line">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab1" data-toggle="tab"> About Me </a></li>

                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active fontawesome-demo" id="tab1">
                                                        <div class="row">
                                                            <div id="biography" >
                                                                <div class="row">
                                                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                                                        <br>
                                                                        <p class="text-muted">{{ $profile->full_name }}</p>
                                                                    </div>
                                                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                                                        <br>
                                                                        <p class="text-muted">{{$profile->cell}}</p>
                                                                    </div>
                                                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                                                        <br>
                                                                        <p class="text-muted">{{$profile->email}}</p>
                                                                    </div>
                                                                    <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                                                        <br>
                                                                        <p class="text-muted">{{$profile->address}}</p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <p class="m-t-30">Completed my graduation in Gynaecologist Medicine from the well known and renowned institution of India – SARDAR PATEL MEDICAL COLLEGE, BARODA in 2000-01, which was affiliated to M.S. University. I ranker in University exams from the same university from 1996-01.</p>
                                                                <p>Worked as  Professor and Head of the department ; Community medicine Department  at Sterline Hospital, Rajkot, Gujarat from 2003-2015 </p>

                                                                <br>
                                                                <h4 class="font-bold">Education</h4>
                                                                <hr>
                                                                <ul>
                                                                    <li>{{$profile->code}}</li>
                                                                    <li>{{$profile->title}}</li>
                                                                    <li>{{$profile->description}}</li>
                                                                    <li>{{$profile->institute}}</li>

                                                                </ul>
                                                                <br>
                                                                <h4 class="font-bold">Experience</h4>
                                                                <hr>
                                                                <ul>
                                                                    <li>One year rotatory internship from April-2009 to march-2010 at B. J. Medical College, Ahmedabad.</li>
                                                                    <li>Three year residency at V.S. General Hospital as a resident in orthopedics from April - 2008 to April - 2011.</li>
                                                                    <li>I have worked as a part time physiotherapist in Apang manav mandal from 1st june 2004 to 31st jan 2005.</li>
                                                                    <li>Clinical and Research fellowship in Scoliosis at Shaurashtra University and Medical Centre (KUMC) , Krishna Hospital  , Rajkot from April 2013 to June 2013.</li>
                                                                    <li>2.5 Years Worked at Mahatma Gandhi General Hospital, Surendranagar.</li>
                                                                    <li>Consultant Orthopedics Surgeon Jalna 2 years.</li>
                                                                </ul>

                                                                <br>
                                                                <h4 class="font-bold">Professional Affiliations </h4>
                                                                <hr>
                                                                <ul>
                                                                    <li>Life member: Association of Spine Surgeons’ of India.</li>
                                                                    <li>Life member: Gujarat Orthopaedic Association.</li>
                                                                    <li>Life Member: The Indian Society for Bone and Mineral Research (ISBMR).</li>
                                                                    <li>Life member: Ahmedabad Orthopaedic Society</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


                    <!-- END PROFILE CONTENT -->
                    {{--start comment-module--}}
               <div class="detailBox" style="padding-right: 100px; padding-left: 100px">
                   @endforeach
                 <h3 class="detailBox">Comments on Doctor's Checkup</h3>
                    @foreach($drComments as $comment)
                           <div class="actionBox">
                            <ul class="commentList">
                                <li>
                                    <div class="commenterImage">
                                        <img src="http://placekitten.com/50/50" />
                                    </div>
                                    <div class="commentText">
                                        <p class="">{{$comment->comments}}</p> <span class="date sub-text">{{$comment->created_at}}</span>

                                    </div>
                                </li>

                            </ul>
                        </div>
                        @endforeach
                    </div>

                            <form class="form-inline" role="form" action="{{route('comment')}}" method="post" >


                                <div class="form-group" style="padding-left: 200px">
                                    <input class="form-control" type="text" placeholder="Your comments" name="addComment" style="min-width: 800px " />
                                    <input class="form-control" type="hidden" value="{{$id}}" name="Doctro_id" >

                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    {{--<input  type="hidden"  name="commenttoken" value=" {{csrf_token()}}" />--}}

                                    <button class="btn btn-default" name="submit" type="submit" style="min-width: 800px">Comment</button>
                                </div>
                            </form>



                    {{--end comment-module --}}



                     <br><br>
                    <br><br>

    <!-- start js include path -->
    <!-- start js include path -->
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- bootstrap -->
    <script src="{{ asset('js/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>

    <!--
            <script src="js/jquery.slimscroll.js"></script>
            <script src="js/app.js" type="text/javascript"></script>
    -->
    <script type="text/javascript"> $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>
    <script src=" {{ asset('js/profile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/layout.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/starRating.js') }}" type="text/javascript"></script>
@stop






