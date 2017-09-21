@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Companies
@stop

@section('redBar')
    <div class = "user_logo">        <div class="header_1 wrap_3 color_3 login-bar">            @if(isset(Auth::user()->company->name))            {{Auth::user()->company->name}}            @else                Easy Physician            @endif
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

	   <center>
            <div id="regForm" style="border: 4px solid #129894; width: 800px; height: 100%; background-color: #EBEBEB">
                <table class="row_border" style=" border-radius: 10px; margin: 5%;" width="621" height="720">
              <tr>
                    <td width="272" height="55"><label>Company Name:</label> </td>
                    <td width="333"><label>{{ $company->name }}</label></td>
              </tr>
              <tr>
                  <td width="272" height="55"><label>Company Address:</label> </td>
                  <td width="333"><label>{{ $company->address }}</label></td>
              </tr>
              <tr>
                <td width="272" height="55"><label>Admin Name:</label> </td>
                <td width="333"><label>{{ $admin->full_name }}</label></td>
                </tr>
              <tr>
                <td width="272" height="55"><label>     Email:</label></td>
                <td width="333"><label>{{ $admin->email }}</label></td>
                </tr>
              <tr>
                <td width="272" height="55"><label>      Gender:</label></td>
                <td width="333"><label>{{ $admin->gender }}</label> </td>
                </tr>
                <tr>
                <td width="272" height="55"><label>      Age:</label></td>
                <td width="333"><label>{{ $admin->age }}</label></td>
                </tr><tr>
                <td width="272" height="55"><label>     Admin City:</label></td>
                <td width="333"><label>{{ $admin->city }}</label></td>
                </tr>
                <tr>
                     <td width="272" height="55"><label>     Admin Country:</label></td>
                     <td width="333"><label>{{ $admin->country }}</label></td>
                 </tr>
                <tr>
                <td width="272" height="55"><label>     Admin Address:</label></td>
                <td width="333"><label>{{ $admin->address }}</label></td>
                </tr>
                <tr>
                <td width="272" height="55"><label>      Phone:</label></td>
                <td width="333"><label>{{ $admin->phone }}</label></td>
                </tr>
                <tr>
                    <td width="272" height="55"><label>      CNIC:</label></td>
                    <td width="333"><label>{{ $admin->cnic }}</label></td>
                 </tr>
                <tr>
                <td width="272" height="55"><label> Role:</label></td>
                <td width="333"><label>{{ $admin->role }}</label></td></tr>
                <tr>
                <td width="272" height="55"><label> Branch Name:</label></td>
                <td width="333"><label>{{ $admin->branch }}</label></td></tr>
                <tr>
                  <td width="272" height="55"><label> Status:</label></td>
                  <td width="333"><label>{{ $admin->status }}</label></td>
                </tr>
                <tr>
                <td width="272"><label>Additional Info:</label></td>
                <td width="333"><label><div style="width: 333px; word-wrap: break-word">{{ $admin->note }}</div></label></td>
                </tr>

            </table>
            <center>
                  <section style="margin-bottom: 10%">
                     {{ link_to_route('companies.index', 'Back', '', ['class' => 'btn_3']) }}
                  </section>
             </center>
            </div>
        </center>

		<br><br>

    
@stop