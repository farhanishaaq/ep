@extends('previous_diseases.layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Previous Disease
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('content2')
    <section id="content">
        
		<div class = "user_logo">
			<div class="header_1 wrap_3 color_3" style="color: #fff; padding-top: 20px">
                        Manage Previous Disease
            </div>
		</div>


		<!--========================================================
                                     Data Table
            =========================================================-->
            <center style="margin-top: 7%;">
        @if(Auth::user()->role != 'Doctor') 
            <center>{{ link_to_route('previous_diseases', 'Add New Disease', ['id' => $patient->id], ['class' => 'btn_1'])}}</center>
            		<br>
        @endif
                <table id="example" style=" border: 1px solid black" class="display" cellspacing="0" width="80%">
                <thead>
                    <tr>
                        <th style="width: 20%">Disease Name</th>


                        
                        <th style="width: 25%">Manage</th>
                    </tr>
                </thead>

                <tbody>

                @if(($previousDiseases) != null)
                    @foreach($previousDiseases as $previousDisease)
                        <tr>
                            <td>{{{ $previousDisease->disease_name }}}</td>


                            
                            <td>
                            {{ link_to_route('previousDiseases.show', 'View', [$previousDisease->id], ['class' => 'data_table_btn', 'style' => 'margin-bottom: 2px'])}}
                        @if(Auth::user()->role != 'Doctor') 
                            {{ link_to_route('previousDiseases.edit', 'Edit', [$previousDisease->id], ['class' => 'data_table_btn'])}}
                        @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{ $previousDiseases->appends(['id' => $patient->id])->links('partials.pagination') }}
            </center>

     
@stop

