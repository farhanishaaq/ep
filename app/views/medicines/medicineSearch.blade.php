{{-- users.layouts.master --}}
@extends('layouts.master')
        <!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Search Medicines
@stop

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar"> Medicine Search
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

    <div id="flipkart-navbar">

            <div class="row row2">
                <div class="col-sm-2">
                    <h4 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ Madicine Search</span></h4>
                    <h3 style="margin:0px;"><span class="largenav"></span></h3>
                </div>


                <div class="flipkart-navbar-search smallsearch col-sm-8 col-xs-11">
                    <div class="row">
                        <form class="form-inline" method="get" action="{{route('medicineDetail')}}">
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <input class="flipkart-navbar-input col-xs-11" type="" placeholder="Search for Products, Brands and more" name="medicine" id="searchMed"/>
                        <button class="flipkart-navbar-button col-xs-1">
                            <svg width="15px" height="15px">
                                <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                            </svg>
                        </button>

                        </form>

                    </div>
                    <br>
                </div>

            </div>
    </div>

    @if(isset($params))

         <div class="container">
    <div class="col-md-12 col-sm-12  col-lg-12 card listBox" style="border-radius: 5px; padding-top: 10px; ">
        <div class="col-md-5">
            <div class="post-box">
                <img src="{{asset($params['jpgfile'])}}" style="margin-bottom: 10px; height:250px;"><br>



                          <br>
            </div>
        </div>
           <div>





           </div>



        <div class="col-md-7">
            {{--<span class="post-category"><a href="{{url('medicineDetail/1')}}" title="Travel" style="font-size: 20px;">Detail of Medicine</a></span><br>--}}
            <a href="{{url("medicineResutl",$params['medicineid'])}}"> <h2> <span class="text_2 color_7 maxheight1" style="color: #0AA0D3 ">{{$params['MedicineName']}}</span> </h2></a>

            <span> <div class="show-read-more"><h3 class="text_2 color_7 maxheight1">Medicine Detail</h3> {{$params['xmlfile']}} </div>

                        </span>
            <a href="{{url("medicineResutl",$params['medicineid'])}}" title="Read More">Read More</a>
        </div>
       </div>

       </div>


    @endif
    @if(!isset($params))
    <div class="container">
        <div class="col-md-12 col-sm-12  col-lg-12 card listBox" style="border-radius: 5px; padding-top: 10px; ">
            <div class="col-md-5">
                <div class="post-box">
                    <img src="{{asset('/images/medicines-l.jpg')}}" style="margin-bottom: 10px; height:250px;"><br>


                    <br>
                </div>
            </div>
            <div class="col-md-7">
               <h2> <span class="text_2 color_7 maxheight1" >Drug Abuse and Addiction</span></h2>

                <span>
                        <div class="show-read-more"><h3>What is drug addiction?</h3>
                            <span class="more-text">Addiction is defined as a chronic, relapsing brain disease that is characterized by compulsive drug seeking and use, despite harmful consequences.† It is considered a brain disease because drugs change the brain—they change its structure and how it works. These brain changes can be long-lasting, and can lead to the harmful behaviors seen in people who abuse drugs.</span></div>

                        </span>

            </div>
        </div>

    </div>
    <section id="content">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="box_1">
                        <div class="icon_1"></div>
                        <h3 class="text_2 color_7 maxheight1"><a href="#">Fee Management</a></h3>
                        <p class="text_3 color_2 maxheight">
                            Online creation and generation of patient's Bills anywhere, anytime.
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box_1">
                        <div class="icon_2"></div>
                        <h3 class="text_2 color_7 maxheight1"><a href="#">Appointment on Phone</a></h3>
                        <p class="text_3 color_2 maxheight">
                            Now Appointment reservation also is just ahead of a Phone Call, by Receptionist.
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box_1">
                        <div class="icon_3"></div>
                        <h3 class="text_2 color_7 maxheight1"><a href="#">Patient Check-Up</a></h3>
                        <p class="text_3 color_2 maxheight">
                            Now Check your patients with much convinience by keeping medical records
                            Online.
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box_1">
                        <div class="icon_4"></div>
                        <h3 class="text_2 color_7 maxheight1"><a href="#">Administration</a></h3>
                        <p class="text_3 color_2 maxheight">
                            Now administrator could manage everything in the system using his full access rights.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>



@endif

    <br>
    <br>
    <br>



    <link href="{{ asset('css/medicine.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/medicine.js')}}" type="text/javascript"></script>


@endsection
@stop