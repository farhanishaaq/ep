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
                        <input class="flipkart-navbar-input col-xs-11" type="" placeholder="Search for Products, Brands and more" name="medince" id="searchMed"/>
                        <button class="flipkart-navbar-button col-xs-1">
                            <svg width="15px" height="15px">
                                <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
    </div>
      <div class="container">
    <div class="col-md-12 col-sm-12  col-lg-12 card listBox" style="border-radius: 5px; padding-top: 10px; ">
        <div class="col-md-5">
            <div class="post-box">
                <img src="{{asset('/images/medicines-l.jpg')}}" style="margin-bottom: 10px; height:250px;"><br>


                          <br>
            </div>
        </div>
        <div class="col-md-7">
            <span class="post-category"><a href="{{url('medicineDetail/1')}}" title="Travel" style="font-size: 20px;">4 Ways to Avoid Side Effects of Radiotherapy</a></span><br>
            <h5 style="color: #808080">company name</h5>
            <br>
            <span>
                        <div class="show-read-more"><h3>Medicine Detail</h3>In this scientific era radiotherapy is used to treat the wide range of abnormalities from skin scars to cancer. It is really a marvelous technology and works for satisfied results. But it still has so....
                            <span class="more-text">me side effects. Don’t be afraid of those unwanted effects, these can be avoided. Read how can you minimize side effects of this therapy?
Side Effects of Radiotherapy: Changes in special area which is treated</span></div>

                        </span>
            <a href="" title="Read More">Read More</a>
        </div>
       </div>

       </div>

    <div class="container">
        <div class="col-md-12 col-sm-12  col-lg-12 card listBox" style="border-radius: 5px; padding-top: 10px; ">
            <div class="col-md-5">
                <div class="post-box">
                    <img src="{{asset('/images/medicines-l.jpg')}}" style="margin-bottom: 10px; height:250px;"><br>


                    <br>
                </div>
            </div>
            <div class="col-md-7">
                <span class="post-category"><a href="" title="Travel" style="font-size: 20px;">4 Ways to Avoid Side Effects of Radiotherapy</a></span><br>
                <h5 style="color: #808080">company name</h5>
                <br>
                <span>
                        <div class="show-read-more"><h3>Medicine Detail</h3>In this scientific era radiotherapy is used to treat the wide range of abnormalities from skin scars to cancer. It is really a marvelous technology and works for satisfied results. But it still has so....
                            <span class="more-text">me side effects. Don’t be afraid of those unwanted effects, these can be avoided. Read how can you minimize side effects of this therapy?
Side Effects of Radiotherapy: Changes in special area which is treated</span></div>

                        </span>
                <a href="" title="Read More">Read More</a>
            </div>
        </div>

    </div>





<br>
    <br>
    <br>





    <link href="{{ asset('css/medicine.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/medicine.js')}}" type="text/javascript"></script>


@endsection
@stop