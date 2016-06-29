@extends('previous_diseases.layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Previous Diseases Details
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('content1')
    <section id="content">

		<div class = "user_logo">
			<div class="header_1 wrap_3 color_3" style="color: #fff; padding-top: 20px">
                        Previous Diseases Details
            </div>
		</div>
		<br><br><br>
@stop

@section('content2')

	   <center>
            <div id="regForm" style="border: 4px solid #129894; width: 800px; height: 100%; background-color: #EBEBEB">
                <table class="row_border" style=" border-radius: 10px; margin: 5%;" width="621" height="200">
              <tr>
                <td width="272" height="55"><label>Disease Name:</label> </td>
                <td width="333"><label>{{{ $previousDisease->disease_name}}}</label></td>
                </tr>


                <tr>
                <td width="272"><label>Disease Notes:</label></td>
                <td width="333"><label><div style="width: 333px; word-wrap: break-word">{{{ $previousDisease->disease_notes }}}</div></label></td>
                </tr>

            </table>
            <center>
                  <section style="margin-bottom: 10%">
                     {{ link_to_route('previousDiseases.index', 'Back', ['id' => $previousDisease->patient_id], ['class' => 'btn_3']) }}
                  </section>
             </center>
            </div>
        </center>

		<br><br>

     
@stop