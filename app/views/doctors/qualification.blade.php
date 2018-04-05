<head>
   <link href="{{asset('css/doctorList.css')}}" rel="stylesheet">

</head>
{{--This fill CSS Save in CSS Folder As doctorList--}}
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
      Search Results
      {{--@if($doctors->count()>0)--}}
      {{--"{{$doctors[0]->cityName}}"--}}
      {{--@endif--}}
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
<div class="container-fluid pB10">
   <div class="row"></div>
   {{--
   <div class="block-header">
      --}}
      {{--
      <h3 style="margin-left: 50px;"><strong>EP-Sociale</strong></h3>
      --}}
      {{--
   </div>
   --}}
   {{--//Total Screen--}}
   <div class="col-md-12 col-sm-12  col-lg-12" style="background-color: whitesmoke">
      {{--//Left Panel--}}
      {{--Right Panel--}}
      <div class="col-md-12 col-sm-12  col-lg-12 card pT10" style="border-radius: 5px;">
         <h2 style="color:#01ADD5 ">{{$doctors[0]->code}}</h2>
         <h5>{{$doctors[0]->qualificationsDescription}}</h5>
      </div>
      <div class="col-md-12 col-sm-12  col-lg-12">
         @if($doctors->count()>0)
         @for($i=0; $i<sizeof($doctors);$i++)
         <span class="album" style="align-content: center">
            <div class="col-md-12 col-sm-12  col-lg-12  card listBox m0 " style="border-radius: 5px; padding-top: 10px; margin-bottom: 5px; height: 200px; padding: 20px ">
               <div class="col-md-2 col-sm-2 col-lg-2 p0">
                  {{--
                  <div class="col-md-10 col-sm-10  col-lg-10   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-2">
                     --}}
                     <div class="thumb-xl member-thumb " style="align-items: center; padding: 5px">
                        <img src="
                        @if(isset($doctors[$i]->photo))
                        {{asset('/'.$doctors[$i]->photo)}}
                        @else
                        @if($doctors[$i]->gender =="Male")
                        {{asset('uploads/maleUnknown.jpg')}}
                        @else
                        {{asset('uploads/femaleUnknown.jpg')}}
                        @endif
                        @endif
                        " style="border-radius: 5px;" height="100px" width="100px" alt="profile-image" >
                        <i class="zmdi zmdi-info" title="verified user"></i>
                     </div>
                     {{--
                  </div>
                  --}}
                  {{--
                  <div class="col-md-8 col-sm-8  col-lg-8   col-lg-offset-2 col-md-offset-2 col-sm-offset-2" style="text-align: center; border-radius:5px; margin-top:10px;border: 2px solid wheat; background-color: #01ADD5; color: white ">Exp. 15 year</div>
                  --}}
               </div>
               <div class="col-md-3 col-sm-3  col-lg-3 p0" >
                  <div class="col-xs-12 col-md-12 col-sm-12 p0" style="text-align: center">
                     <h4 align="center"><strong>
                        <a href="{{route('drProfile',$doctors[$i]->userId)}}">{{$doctors[$i]->full_name}}</a>
                        </strong>
                     </h4>
                     <p align="center" ><strong>
                     @if(isset($doctors[$i]->code))
                        {{$doctors[$i]->code}}
                     @else
                     Qualified
                     @endif
                     </strong></p>
                     {{--<span> <a href="#" style="color: red">websitk.ename.com</a> </span></p>--}}
                     <a href="{{route('drProfile',$doctors[$i]->userId)}}"><button  class="btn btn-raised btn-sm btn-1">View Profile</button></a>
                     {{--
                     <ul class="social-links list-inline m-t-10">
                        --}}
                        {{--
                        <li><a title="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                        --}}
                        {{--
                        <li><a title="twitter" href="#" ><i class="zmdi zmdi-twitter"></i></a></li>
                        --}}
                        {{--
                        <li><a title="instagram" href="3.html" ><i class="zmdi zmdi-instagram"></i></a></li>
                        --}}
                        {{--
                     </ul>
                     --}}
                  </div>
               </div>
               <div class="col-md-3 col-sm-3  col-lg-3" style="text-align: center">
                  <div style="">
                     <h5 align="center" ><strong style="color:  #01ADD5; font-size: 15px">Speciality:</strong><strong>
                        {{$doctors[$i]->specialityName}}
                        </strong>
                     </h5>
                     <p align="center" >
                        @if($doctors[$i]->start || $doctors[$i]->end)
                        @if($doctors[$i]->start)
                        {{$doctors[$i]->start}}
                        <strong>AM</strong>
                        @endif
                        @if($doctors[$i]->end)
                        <br><strong>To</strong><br>
                        {{$doctors[$i]->end}}
                        <strong>PM</strong>
                        @endif
                        @else
                        <b>Time Slots </b><br>
                        <strong>Not Yet Available</strong>
                        @endif
                     </p>
                  </div>
               </div>
               <div class="col-md-3 col-sm-3  col-lg-3">
                  <div style=" margin-top: 10px; text-align: center ">
                     <button type="button" class="btn btn-raised btn-sm btn-1" data-toggle="modal" data-target="#myModal"><strong>Call Now</strong></button>
                     {{--<button class="btn btn-raised btn-sm btn-warning" style="width: inherit ">Call Now</button>--}}
                     <br><span>Fee Range</span><br>
                     <span class="fs12">From <strong>{{$doctors[$i]->min_fee}} </strong>PKR <strong>
                     To</strong>
                     <strong>{{$doctors[$i]->max_fee}} </strong>PKR</span>
                  </div>
               </div>
            </div>
         </span>
         {{--
         <div class="col-md-1"></div>
         --}}
         @endfor
         @else
         {{--No Record Found Error--}}
         <div class="col-lg-offset-4 col-md-offset-4">
            <span><img src="{{asset('images/not_found.png')}}"></span><br>
         </div>
         @endif
         <!-- Modal -->
         <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4>Contact Detail</h4>
                  </div>
                  <div class="col-md-offset-4">
                     <img src="{{asset('images/dr_contact.jpg')}}" width="150px" height="150px">
                  </div>
                  <p style="text-align: center">Have a health related question?<br>
                     Would you like to connect to a doctor?
                  </p>
                  <h2 style="text-align:center ;color:  #01ADD5;">0900-78601</h2>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
         {{--Modal End--}}
      </div>
      <span class="center"><?php echo $doctors->links(); ?></span>
   </div>
</div>
<script src="{{asset('js/doctorListScript.js')}}"></script>
@stop