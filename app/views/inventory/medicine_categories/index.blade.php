@extends('layouts.master')
        <!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Medicine Category
@stop

@section('redBar')
    <div class = "user_logo">        <div class="header_1 wrap_3 color_3 login-bar">{{Auth::user()->company->name}}
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
        <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Medicine Category List</h1>
        <hr class="w100p fL mT0" />
        <section id="form-Section">
            <!--========================================================
                                     Data Table
            =========================================================-->
            {{ link_to_route('medicineCategories.create', 'Register Category', '', ['class' => 'btn_1'])}}
            <table id="tblRecordsList" class="mT20 table table-hover table-striped display">
                <thead>
                <tr>
                    <th>Manufacturer</th>
                    <th>Name</th>
                    <th>Dosage Form</th>
                    <th>Description</th>
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


