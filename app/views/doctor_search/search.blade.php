        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
        </head>
        <body>

        </body>
        </html>
        @extends('layouts.master')
        <!--========================================================
                                  TITLE
        =========================================================-->
        @section('title')
            Login
        @stop

        <!--========================================================
                                  CURRENT MENU
        =========================================================-->
        @section("current_login")
            class="current"
        @stop

        @section('redBar')
            <div class = "user_logo">
                <div class="header_1 wrap_3 color_3 login-bar">Search Doctor</div>
            </div>
        @stop


        @section('sliderContent')
        @stop


        <!--========================================================
                                  CONTENT
        =========================================================-->
        @section('content')
            <div class="container-fluid">


                    <div  class="col-lg-12" style="background-image: url('{{asset('images/index_slide02.jpg')}}')">

                     <div class="col-lg-12" style="padding-left: 300px; padding-top: 350px; padding-bottom: 190px"  >
                         <form class="col-lg-12" method="" id="search" action=""  >

                             <input type="text" class="col-lg-4" placeholder="Location" aria-describedby="basic-addon1" style="padding-left: 60px" >
                             <input type="text" class="col-lg-4" placeholder="Doctor Speciality" aria-describedby="basic-addon1" style="padding-left: 60px" >
                             <button type="submit" class="ui-icon-search" style="min-width: 100px; min-height: 45px" ><span class="glyphicon glyphicon-search" style="min-width: 80px; padding-top: 10px"></span></button>



                         </form>

                     </div>

                    </div>

                </div>




                {{--<br><br><br>--}}
                {{--<br><br><br><br>--}}
                <br><br><br><br>
            @endsection
        @stop