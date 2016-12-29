@extends('layouts.master')

<!--========================================================
                          TITLE
=========================================================-->
@section('title')
Contacts
@stop

<!--========================================================
                          CURRENT MENU
=========================================================-->
@section("current_contacts")
class="current"
@stop

<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
    <section id="content">
        <div class="bg_1 ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <h2 class="header_2 pT28 color_3">
                                Contact Info
                            </h2>
                            <div class="form-Section col-md-12 h400">
                                <address>
                                <p class="text_7 color_6">
                                    We appreciate your experience with our application <br/>
                                    and will continue to improve it as you like.

                                </p>
                                <p class="text_8">
                                    If you have any queries Please Contact on followings:
                                </br>
                                    Electronic Medical Records. <br/>
                                    Lahore Pakistan, <br/>
                                    Telephone: +92 334 4050495 <br/>

                                    E-mail: <a href="#">emronline1@gmail.com</a>
                                </p>
                            </address>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="header_2 pT28 color_3">Find Us</h2>
                        <div class="form-Section col-md-12 h400">
                        <iframe class="map"
                                src="https://www.google.com/maps/embed/v1/place?q=virtual+university+Lawrence+Road&key=AIzaSyBZCFjtU6e-CWFyg_EIVB5IxxsmEYAI5Jo"
                                style="border:0">
                        </iframe>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <h2 class="header_2 pT28 color_3">
                                Contact Form
                            </h2>
                            <form id="contact-form form-group">
                                <div class="contact-form-loader"></div>
                                <div class="col-xs-6">
                                    <input id="name" type="text" required="true" name="name" placeholder="Name*" class="form-control" />
                                    <span id="errorName" class="field-validation-msg"></span>
                                </div>
                                <div class="col-xs-6">
                                    <input id="email" type="text" required="true" name="email" placeholder="E-mail*" class="form-control" />
                                    <span id="errorName" class="field-validation-msg"></span>
                                </div>
                                <div class="col-xs-6">
                                    <input id='phone' type="text" name="phone" placeholder="Phone" class="form-control" />
                                    <span id="errorName" class="field-validation-msg"></span>
                                </div>
                                <div class="col-xs-6">
                                    <input id='phone' type="text" name="phone" placeholder="Cell" class="form-control" />
                                    <span id="errorName" class="field-validation-msg"></span>
                                </div>
                                <div class="col-xs-12">
                                    <textarea id="message" name="message" required="true" placeholder="*Message:" rows="7" cols="20" class="form-control"></textarea>
                                    <span id="errorName" class="field-validation-msg"></span>
                                </div>
                                <div class="col-xs-12 mT20 taR">
                                    <input class="data_table_submit_btn" type="reset" value="Clear">
                                    <input class="data_table_submit_btn" type="submit" value="Send">
                                </div>
                                <div>
                                    <p id="success_message" style="color: green"></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
       
@stop

@section('scripts')
    <script>
        $('#contact-form').submit(function(){
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var message = $('#message').val();

            $.ajax({
                url: "contact/messages",
                type: 'post',
                data: {name: name, email: email, phone: phone, message: message},
                success: function(response){
                    console.log(response);
                    $('#name').val("");
                    $('#email').val("");
                    $('#phone').val("");
                    $('#message').val("");
                    $('#success_message').text(response);
                }
            });
        });


    </script>
@stop