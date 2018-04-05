
<head>
    <link href="{{asset('css/doctorList.css')}}" rel="stylesheet">
</head>
{{--This fill CSS Save in CSS Folder As doctorList--}}
@extends('layouts.master')
<!--========================================================
   TITLE
   =========================================================-->
@section('title')
    Doctor Duty Days
@stop
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">
            Duty Days
        </div>
    </div>
@stop
@section('sliderContent')
@stop
<!--========================================================
   CONTENT
   =========================================================-->
@section('content')
<br>
{{--{{dd($doctors)}}--}}
            <div class="container">
            <div class="row">
            @if(!empty($doctors))
            @if($doctors[0]->day != '')
            <a href="{{route('dutyDays.create').'?'.'doctor_id='.$doctors[0]->doctorsId}}"><button class="btn btn-raised btn-sm btn-1">Add Duty Days</button></a>
            <br>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Days</th>
                    <th>Time Start</th>
                    <th>Time End</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($doctors as $doctor)
                  <tr>
                          <td><ol></ol></td>
                          <td>{{$doctor->day}}</td>
                          <td>{{$doctor->start}}</td>
                          <td>{{$doctor->end}}</td>
                        </tr>
                  @endforeach
                </tbody>
              </table>
              @else
              <div style="margin-top: 150px; margin-bottom: 200px;">
              <a href="{{route('dutyDays.create').'?'.'doctor_id='.$doctors[0]->doctorsId}}" style=" margin-left: 45%"><button class="btn btn-raised btn-sm btn-1">Add Duty Days</button></a>
              <h2 class="center" style="color: dimgray;">No Duty Days Set for Now!</h2>
              </div>
              @endif
              @else
              <div style="margin-top: 150px; margin-bottom: 250px;">
                            <h2 class="center" style="color: dimgray;">Not Allowed Yet!</h2>
                            <h6 class="center" style="color: red">Approvel Problem!</h6>
                            </div>
              @endif
            </div>
            </div>

@stop
