<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>@yield('title')</title>
       <meta charset="utf-8">
       <meta name="format-detection" content="telephone=no"/>
       <link rel="icon" href="/images/icon.jpg" type="image/x-icon">

       {{--{{ HTML::style('/login_css/style.css') }}--}}
       {{ HTML::style('/css/windows_menu.css') }}
       {{--{{ HTML::style('/css/user_reg_form.css') }}--}}
       {{ HTML::style('/css/grid.css') }}
       {{ HTML::style('/css/bootstrap.min.css') }}
       {{ HTML::style('/css/style.css') }}
       {{ HTML::style('css/breadcrumbs.css') }}
       {{ HTML::style('/css/isotope.css') }}
       {{ HTML::style('/css/contact-form.css') }}
       {{ HTML::style('/login_css/style.css') }}
       {{ HTML::style('/css/camera.css') }}
       {{ HTML::style('/css/owl.carousel.css') }}



   <!--========================================================
                             JS
   =========================================================-->

       {{--{{ HTML::script('js/user_validation.js') }}--}}
       {{ HTML::script('js/jquery.min.js') }}
       {{ HTML::script('js/bootstrap.min.js') }}

       {{ HTML::script('js/jquery-migrate-1.2.1.js') }}
       {{ HTML::script('js/jquery.equalheights.js') }}
       {{ HTML::script('js/isotope.min.js') }}
       {{ HTML::script('js/modal.js') }}
       {{ HTML::script('js/TMForm.js') }}
       {{ HTML::script('js/jquery.mobile.customized.min.js') }}
       {{ HTML::script('js/camera.js') }}
       {{ HTML::script('js/owl.carousel.js') }}

       {{ HTML::script('js/jquery.cookie.js') }}
       {{ HTML::script('js/device.min.js') }}
       {{ HTML::script('js/tmstickup.js') }}
       {{ HTML::script('js/jquery.easing.1.3.js') }}
       {{ HTML::script('js/jquery.ui.totop.js') }}
       {{ HTML::script('js/jquery.mousewheel.min.js') }}
       {{ HTML::script('js/jquery.simplr.smoothscroll.min.js') }}
       {{ HTML::script('js/superfish.js') }}
       {{ HTML::script('js/jquery.mobilemenu.js') }}
       {{ HTML::script('js/jquery.unveil.js') }}
       {{ HTML::script('js/script.js') }}



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
    
</head>
    <body>
    
        <div class="page">
            <!--========================================================
                                      HEADER
            =========================================================-->
            @include('partials.header')

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
            @include('partials.footer')

            @yield('scripts')
        </div>
    </body>
</html>