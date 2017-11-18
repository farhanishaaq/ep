<head>
    <link href="{{asset('css/doctorList.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>



function submitForm() {
var city = document.getElementsByName('city');
var speciality = document.getElementsByName('speciality');
var cityLength = city.length;
var specialityLength = speciality.length;
                                                //For City Select
for (var i = 0; i< cityLength; i++)
{
if (city[i].checked)
{
 cityId = city[i].value;
  break;
}
}
                                                //For Speciality Select
for (var j = 0; j< specialityLength; j++)
{
if (speciality[j].checked)
{
specialityId = speciality[j].value;
  break;
}
}
   getDoctors += "route('getDoctors/'" + cityId + "/0/" + specialityId + ")";
   alert(getDoctors);
   }
</script>
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
            Searched "
{{$doctors[0]->specialityName}}

            " in Lahore
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
            <h3 style="margin-left: 50px;"><strong>EP-Sociale</strong></h3>
        </div>

                                                                                                    {{--//Total Screen--}}
        <div class="col-md-12 col-sm-12  col-lg-12" style="background-color: whitesmoke">
                                                                                                       {{--//Left Panel--}}
            <div class="col-md-3 col-sm-3  col-lg-3">
                <div class="col-md-12 col-sm-12  col-lg-12 card " style="border-radius: 5px; padding-top: 10px; ">


                                {{--Cities List at Left Panel Of Doctor List--}}
                        {{--{{ Form::open(array('method'=>'GET','url' => 'getDoctors'))}}--}}
<form method="GET" action="{{'+getDoctors+'}}">



 <div class="panel-heading" role="tab" id="headingOne">
    <h4 class="panel-title s-18">
       <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#cities"  aria-controls="collapseOne" style="width: 100%" ><strong>City</strong></button>
    </h4>
 </div>
 <div id="cities" class="collapse">
    <div class="panel-body">
       <div class="chbxs listm">
       @foreach($cities as $city)
        <div class="chbx">
                    <input value="{{$city->id}}" type="radio" name="city"  >
                    <label for="fc_1185">
                       <div style="padding-top: 10px"> {{$city->name}} </div>
                    </label>
                 </div>
       @endforeach
          <div class="clearfix"></div>
       </div>
    </div>
 </div>
 {{--Speciality--}}
  <div class="panel-heading" role="tab" id="headingOne">
     <h4 class="panel-title s-18">
        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#speciality"  aria-controls="collapseOne" style="width: 100%" ><strong>Specility</strong></button>
     </h4>
  </div>
  <div id="speciality" class="collapse">
     <div class="panel-body">
        <div class="chbxs listm">
               @foreach($specialities as $speciality)
           <div class="chbx">
              <input value="{{$speciality->id}}" type="radio" name="speciality"  >
              <label for="fc_1185">
                 <div style="padding-top: 10px"> {{$speciality->name}} </div>
              </label>
           </div>
         @endforeach
           <div class="clearfix"></div>
        </div>
     </div>
  </div>

 <div class="doctorSearchOption">
    <div class="col-lg-2 col-md-2 pd2">
       <button type="submit" onclick="submitForm()" class="btn btn-raised btn-sm btn-1">Search &nbsp; <span class="glyphicon glyphicon-search"></span></button>
    </div>
 </div>
                        {{--{{ Form::close() }}--}}
                        </form>
    </div>
 </div>


            {{--Right Panel--}}
            <div class="col-md-9 col-sm-9  col-lg-9">

                {{--@foreach ($doctors as $doctors)--}}
                    @for($i=0; $i<sizeof($doctors);$i++)

                    <div class="col-md-12 col-sm-12  col-lg-12 card listBox" style="border-radius: 5px; padding-top: 10px; ">
                        <div class="col-md-3 col-sm-3 col-lg-3">

                        <div class="col-md-10 col-sm-10  col-lg-10   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-2">
                            <div class="thumb-xl member-thumb " style="align-items: center">
                                <img src="{{asset('images/random-avatar3.jpg')}}" class="img-circle" alt="profile-image" >
                                <i class="zmdi zmdi-info" title="verified user"></i>
                            </div>
                         </div>
                         <div class="col-md-8 col-sm-8  col-lg-8   col-lg-offset-2 col-md-offset-2 col-sm-offset-2" style="text-align: center; border-radius:25px; margin-top:10px;border: 2px solid wheat; background-color: #01ADD5; color: white ">Exp. 15 year</div>
                        </div>
                        <div class="col-md-3 col-sm-3  col-lg-3" >
                            <div class="col-xs-12 col-md-12 col-sm-12" style="text-align: center">
                                <h4 align="center"><strong>
                                {{$doctors[$i]->full_name}}

                                </strong></h4>
                                <p align="center" >

                               <strong>{{$doctors[$i]->code}}</strong><br>

                                     <span> <a href="#" style="color: red">websitk.ename.com</a> </span></p>
                                <a style="" href="{{route('drProfile',$doctors[$i]->doctorsId)}}"  class="btn btn-raised btn-sm">View Profile</a>
                                <ul class="social-links list-inline m-t-10">
                                    <li><a title="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a title="twitter" href="#" ><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a title="instagram" href="3.html" ><i class="zmdi zmdi-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3  col-lg-3" style="text-align: center">
                            <div style="">
                                <h5 align="center" ><strong>Speciality:

                                            {{$doctors[$i]->specialityName}}
                                        </strong></h5>

                                <p align="center" >(

                                        {{$doctors[$i]->start}}
                                    <strong>AM</strong>)<br><strong>To</strong><br>
                                        {{$doctors[$i]->end}}
                                    <strong>PM</strong>)</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3  col-lg-3">
                            <div style=" margin-top: 10px; text-align: center ">
<button type="button" class="btn btn-raised btn-sm btn-1" data-toggle="modal" data-target="#myModal"><strong>Call Now</strong></button>
                                {{--<button class="btn btn-raised btn-sm btn-warning" style="width: inherit ">Call Now</button>--}}
                                <p>Fee Starting</p>
                                <p> <strong>{{$doctors[$i]->min_fee}} </strong>PKR <strong>
                                To</strong>
                                    <strong>{{$doctors[$i]->max_fee}} </strong>PKR</p>
                            </div>
                        </div>
                    </div>
                @endfor
                 <!-- Modal -->
                 <div class="modal fade" id="myModal" role="dialog">
                     <div class="modal-dialog modal-sm">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4>Contact Detail</h4>
                         </div>
                         <div class="col-md-offset-4">
                         <img src="{{asset('images/dr_contact.jpg')}}" width="150px" height="150px"></div>
                           <p style="text-align: center">Have a health related question?<br>

                              Would you like to connect to a doctor?</p>

                          <h2 style="text-align:center ;color:  #01ADD5;">0900-78601</h2>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>

                </div>
            </div>
@stop

    {{--<h2>City</h2>--}}
                    {{--{{ Form::open(array('url' => 'getDoctors/2/9')) }}--}}
                    {{--<label for="male">Karachi</label>--}}
                    {{--<input type="radio" name="gender" id="male" value="male"><br>--}}
                    {{--<label for="female">Lahore</label>--}}
                    {{--<input type="radio" name="gender" id="female" value="female"><br>--}}
                    {{--<label for="other">Gujranwala</label>--}}
                    {{--<input type="radio" name="gender" id="other" value="other"><br><br>--}}
                    {{--<input type="submit" value="Submit">--}}
                  {{--{{ Form::close()}}--}}


                        {{--<div class="member-card verified">--}}
                            {{--<ul class="header-dropdown">--}}
                                {{--<li class="dropdown">--}}
                                    {{--<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="zmdi zmdi-more-vert"></i></a>--}}
                                    {{--<ul class="dropdown-menu pull-right">--}}
                                        {{--<li><a href="javascript:void(0);" class=" waves-effect waves-block">Edit</a></li>--}}
                                        {{--<li><a href="javascript:void(0);" class=" waves-effect waves-block">Delete</a></li>--}}
                                        {{--<li><a href="javascript:void(0);" class=" waves-effect waves-block">Block</a></li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="thumb-xl member-thumb">--}}
                            {{--<img src="{{asset('images/random-avatar3.jpg')}}" class="img-circle" alt="profile-image">--}}
                            {{--<i class="zmdi zmdi-info" title="verified user"></i>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<h4 class="m-b-5">Dr. Shahid</h4>--}}
                            {{--<p class="text-muted">Dentist<span> <a href="#" class="text-pink">websitename.com</a> </span></p>--}}
                        {{--</div>--}}
                        {{--<p class="text-muted">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>--}}
                        {{--<a href="profile.html"  class="btn btn-raised btn-sm">View Profile</a>--}}
                        {{--<ul class="social-links list-inline m-t-10">--}}
                            {{--<li><a title="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>--}}
                            {{--<li><a title="twitter" href="#" ><i class="zmdi zmdi-twitter"></i></a></li>--}}
                            {{--<li><a title="instagram" href="3.html" ><i class="zmdi zmdi-instagram"></i></a></li>--}}
                        {{--</ul>--}}