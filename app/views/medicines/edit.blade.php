{{-- users.layouts.master --}}
@extends('layouts.master')
        <!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Medicine Edit
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

    <div class="container">
        {{$_form}}
    </div>
@stop

@section('scripts')
    <script src="{{asset('js/view-pages/users/MedicineForm.js')}}"></script>
    <script>
        $(document).ready(function(){

            var options = {
                saveCloseUrl: "{{route('medicines.index')}}",
                formMode: '{{$formMode}}'
            };

            var medicineForm = new MedicineForm(window,document,options);
            medicineForm.initializeAll();
        });
    </script>
@stop0