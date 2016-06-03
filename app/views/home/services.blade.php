@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Services
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_services")
class="current"
@stop

<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
<section id="content">
    <div class="container">
        <div class="bg_1s mT30">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="element-item col-md-4 color_2">
                                    <div class="col-md-12">
                                        <div class="img-wrap">
                                            <img src="{{asset('images/admin.jpg')}}" alt="Image 1"/>
                                        </div>
                                        <div class="caption">
                                            <h3 class="text_2 color_2"><a href="#">Clinic Administration</a></h3>
                                            <p class="text_3" style="text-align: justify;">
                                                Now Administrator of the Clinic can manage all tasks with greater ease on a
                                                single click including Employees' Management and all of their functionalists.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-item col-md-4 color_2">
                                    <div class="col-md-12">
                                        <div class="img-wrap">
                                            <img src="images/index-2_img04.jpg" alt="Image 4"/>
                                        </div>
                                        <div class="caption">
                                            <h3 class="text_2 color_2"><a href="#">Appointment Reservation</a></h3>
                                            <p class="text_3" style="text-align: justify;">
                                                Now Receptionists can reserve appointments for patients with greater ease,
                                                without loosing any details regarding appointment using our Online Appointment Reservation service.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-item col-md-4 color_2">
                                    <div class="col-md-12">
                                        <div class="img-wrap">
                                            <img src="images/test.jpg" alt="Image 3"/>
                                        </div>
                                        <div class="caption">
                                            <h3 class="text_2 color_2"><a href="#">Lab Test's Management</a></h3>
                                            <p class="text_3" style="text-align: justify;">
                                                With our Lab Test management service, Lab Assistants can maintain Test Reports
                                                of Patients Online. Lab Assistants can also generate printed Test Reports for patients.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="element-item col-md-4 color_2">
                                    <div class="col-md-12">
                                        <div class="img-wrap">
                                            <img src="images/billing.jpg" alt="Image 6"/>
                                        </div>
                                        <div class="caption">
                                            <h3 class="text_2 color_2"><a href="#">Patient Billing</a></h3>
                                            <p class="text_3" style="text-align: justify;">
                                                Now Accountant can prepare bills regarding check-up and lab tests online,
                                                using Billing service of our application. Also Accountant can print billing
                                                invoices for patients.

                                            </p>
                                        </div>

                                    </div>
                                </div>
                                <div class="element-item col-md-4 color_2">
                                    <div class="col-md-12">
                                        <div class="img-wrap">
                                            <img src="images/pmr.jpg" alt="Image 5"/>
                                        </div>
                                        <div class="caption">
                                            <h3 class="text_2 color_2 pd"><a href="#">Patient Records Management</a></h3>
                                            <p class="text_3" style="text-align: justify;">
                                                The most important service provided by our application is to enhance analysis
                                                process of patients for doctors by maintining medical records of patients online.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-item col-md-4 color_2">
                                    <div class="col-md-12">
                                        <div class="img-wrap">
                                            <img src="images/pmr.jpg" alt="Image 5"/>
                                        </div>
                                        <div class="caption">
                                            <h3 class="text_2 color_2 pd"><a href="#">Doctor's Management</a></h3>
                                            <p class="text_3" style="text-align: justify;">
                                                The most important service provided by our application is to enhance analysis
                                                process of patients for doctors by maintining medical records of patients online.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
@stop