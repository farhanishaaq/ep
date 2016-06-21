<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>@yield('title')</title>
       <meta charset="utf-8">
       <meta name="format-detection" content="telephone=no"/>
       <script>
       window.YES = true;
       window.NO = false;
       window.DP_SUNDAY = "2013-03-24";
       window.DP_MONDAY = "2013-03-25";
       window.DP_TUESDAY = "2013-03-26";
       window.DP_WEDNESDAY = "2013-03-27";
       window.DP_THURSDAY = "2013-03-28";
       window.DP_FRIDAY = "2013-03-29";
       window.DP_SATURDAY = "2013-03-30";
       </script>
       <link rel="icon" href="/images/icon.jpg" type="image/x-icon">

       {{ HTML::style('/css/bootstrap.min.css') }}
       {{ HTML::style('/css/bootstrap-datepicker.standalone.min.css') }}
       {{ HTML::style('/css/style.css') }}



   <!--========================================================
                             JS
   =========================================================-->

       {{--{{ HTML::script('js/user_validation.js') }}--}}
       {{ HTML::script('js/jquery.min.js') }}
       {{ HTML::script('js/bootstrap.min.js') }}

       {{ HTML::script('js/all.js') }}



    <!--[if lt IE 9]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>
    <script src="js/html5shiv.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
    <![endif]-->

    <!-- About Page -->
    <!--[if lt IE 9]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>
    <script src="js/html5shiv.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
    <![endif]-->
    <!-- About Page End -->
    @yield('headScript')
</head>
    <body>
    
        <div class="page">
            <!--========================================================
                                      HEADER
            =========================================================-->
            {{--@include('partials.header')--}}

            {{--@yield('sliderContent')--}}
            @section('redBar')
            <div class = "user_logo">
                <div class="header_1 wrap_3 color_3 login-bar">Welcome to Easy Physician</div>
            </div>
            @show

            <!-- ========================================================
                                      SLIDERS
            ========================================================= -->
            @section('sliderContent')
                <div class="camera-wrapper">
                    <div id="camera" class="camera-wrap">

                        <div data-src="{{asset('images/index_slide01.jpg')}}">
                            <div class="fadeIn camera_caption">
                                <h2 class="text_9 color_3">Optimize resources with technologies</h2>
                            </div>
                        </div>

                        <div data-src="{{asset('images/index_slide02.jpg')}}">
                            <div class="fadeIn camera_caption">
                                <h2 class="text_9 color_3">Cure with excellence!</h2>
                            </div>
                        </div>

                        <div data-src="{{asset('images/index_slide03.jpg')}}">
                            <div class="fadeIn camera_caption">
                                <h2 class="text_9 color_3">Easy online resource management for Physicians</h2>
                            </div>
                        </div>
                        <div data-src="{{asset('images/index_slide04.png')}}">
                            <div class="fadeIn camera_caption">
                                <h2 class="text_9 color_3">Easy online Medical Records</h2>
                            </div>
                        </div>
                        <div data-src="{{asset('images/index_slide05.jpg')}}">
                            <div class="fadeIn camera_caption">
                                <h2 class="text_9 color_3">The Ease for the new era for Health care</h2>
                            </div>
                        </div>
                        <div data-src="{{asset('images/index_slide06.jpg')}}">
                            <div class="fadeIn camera_caption">
                                <h2 class="text_9 color_3">Online Medical Records!</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @show





            <!--========================================================
                                      CONTENT
            =========================================================-->
            @yield('content')




            <!--========================================================
                                      FOOTER
            =========================================================-->
            @include('includes.footer')

            @yield('scripts')
        </div>
        <div class="userSuccMSG dN"></div>
    </body>
</html>