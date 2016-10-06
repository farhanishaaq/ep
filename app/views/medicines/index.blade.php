{{--@extends('medicines.layouts.master')--}}
{{--<!--========================================================--}}
                          {{--TITLE--}}
{{--=========================================================-->--}}
{{--@section('title')--}}
    {{--Medicines--}}
{{--@stop--}}


{{--<!--========================================================--}}
                          {{--CONTENT--}}
{{--=========================================================-->--}}
{{--@section('content2')--}}
    {{--<section id="content">--}}
        {{----}}
		{{--<div class = "user_logo">--}}
			{{--<div class="header_1 wrap_3 color_3" style="color: #fff; padding-top: 20px">--}}
                            {{--Medicines--}}

            {{--</div>--}}
		{{--</div>--}}


		{{--<!--========================================================--}}
                                     {{--Data Table--}}
            {{--=========================================================-->--}}
            {{--<center style="margin-top: 7%;">--}}

        {{--@if(Auth::user()->role != 'Doctor') --}}
            {{--<center>{{ link_to_route('medicines.create', 'Add Medicine', null, ['class' => 'btn_1'])}}</center>--}}
            		{{--<br>--}}
        {{--@endif--}}
                {{--<table id="example" style=" border: 1px solid black" class="display" cellspacing="0" width="80%">--}}
                {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th style="width: 20%">Medicine Name</th>--}}
                        {{--<th style="width: 20%">Quantity</th>--}}
                        {{--<th style="width: 25%">Manage</th>--}}
                    {{--</tr>--}}
                {{--</thead>--}}

                {{--<tbody>--}}

                    {{--@foreach($medicines as $medicine)--}}
                        {{--<tr>--}}
                            {{--<td>{{{ $medicine->name }}}</td>--}}
                            {{--<td>{{{ $medicine->quantity }}}</td>--}}
                            {{--<td>--}}
                            {{--{{ link_to_route('medicines.show', 'View', [$medicine->id], ['class' => 'data_table_btn', 'style' => 'margin-bottom: 2px'])}}--}}
                        {{--@if(Auth::user()->role != 'Doctor') --}}
                            {{--{{ link_to_route('medicines.edit', 'Edit', [$medicine->id], ['class' => 'data_table_btn'])}}--}}
                        {{--@endif--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}

                {{--</tbody>--}}
            {{--</table>--}}
            {{--{{ $medicines->links('partials.pagination') }}--}}
            {{--</center>--}}

     {{----}}
{{--@stop--}}

@extends('layouts.master')
        <!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Medicines
@stop

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
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
    <div class="container mT20">
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Medicines List</h1>
        <hr class="w100p fL mT0" />
        <section id="form-Section">
            <!--========================================================
                                     Data Table
            =========================================================-->
            @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'Receptionist')
                {{-- link_to_route('prescriptions.create', 'Create Prescription', '', ['class' => 'btn_1']) --}}
            @endif
            <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
                <thead>
                    <tr>
                        <th>Medicine Name</th>
                        <th>Description</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    {{$_list}}
                </tbody>
            </table>
        </section>
    </div>
@stop
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            if($('#tblRecordsList tr.row-data').length){
                $('#tblRecordsList').DataTable({
                    "columnDefs": [ {
                        "targets": 3,
                        "orderable": false
                    } ]
                });
            }
        } );
    </script>
@stop



