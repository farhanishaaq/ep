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

    @if(isset($params))

        <div class="container">
            <div class="col-md-12 col-sm-12  col-lg-12 " style="border-radius: 5px; padding-top: 10px; ">


                        <img src="{{asset($params['jpgfile'])}}" style="margin-bottom: 10px; min-height:350px; "><br>



                        <br>


            </div>



                <div class="col-md-12">
                    {{--<span class="post-category"><a href="{{url('medicineDetail/1')}}" title="Travel" style="font-size: 20px;">Detail of Medicine</a></span><br>--}}
                     <h2> <span class="Post-category" style="color: #0AA0D3 ">{{$params['MedicineName']}}</span> </h2>

                    <span> <div class="show-read-more" style="font-size: large"><h3 class="text_2 color_7 maxheight1">Medicine Detail</h3> {{$params['xmlfile']}} </div>

                        </span>

                </div>
            </div>



        {{--@foreach($params as $new)--}}


        {{--@endforeach--}}
        {{--@endif--}}
    @else

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



    @endif




<br>
<br>
<br>




<script src="{{asset('js/medicine.js')}}" type="text/javascript"></script>
<link href="{{ asset('css/medicine.css') }}" rel="stylesheet">


@endsection
@stop