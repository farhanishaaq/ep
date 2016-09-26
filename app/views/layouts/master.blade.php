<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>@yield('title')</title>
        <meta name="description" content="Easy Physician, A Clinic Management System, Hospital Management System">
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <script>
       window.YES = true;
       window.NO = false;


       window.PROFILE_MAX_FILE_SIZE = 2048;//KB

       window.daysNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];


       window.DP_SUNDAY = "2013-03-24";
       window.DP_MONDAY = "2013-03-25";
       window.DP_TUESDAY = "2013-03-26";
       window.DP_WEDNESDAY = "2013-03-27";
       window.DP_THURSDAY = "2013-03-28";
       window.DP_FRIDAY = "2013-03-29";
       window.DP_SATURDAY = "2013-03-30";

       window.DP_DAYS = [window.DP_SUNDAY,
           window.DP_MONDAY,
           window.DP_TUESDAY,
           window.DP_WEDNESDAY,
           window.DP_THURSDAY,
           window.DP_FRIDAY,
           window.DP_SATURDAY
       ];

       window.DP_DAYS_2 = new Array();
       window.DP_DAYS_2["Sunday"] = window.DP_SUNDAY;
       window.DP_DAYS_2["Monday"] = window.DP_MONDAY;
       window.DP_DAYS_2["Tuesday"] = window.DP_TUESDAY;
       window.DP_DAYS_2["Wednesday"] = window.DP_WEDNESDAY;
       window.DP_DAYS_2["Thursday"] = window.DP_THURSDAY;
       window.DP_DAYS_2["Friday"] = window.DP_FRIDAY;
       window.DP_DAYS_2["Saturday"] = window.DP_SATURDAY;


       //***User Types
       window.SUPER_ADMIN = 0;
       window.ADMIN = 1;
       window.EMPLOYEE = 2;
       window.WORKER = 3;
       window.DOCTOR = 4;
       window.PATIENT = 5;
       window.PORTAL_USER = 6;
       window.USER_TYPES = JSON.parse('{{json_encode(array_keys(\App\Globals\GlobalsConst::$USER_TYPES))}}');

       //***Form Mode
       window.FORM_CREATE = 1;
       window.FORM_EDIT = 2;

       //***Prescription Form
       window.PrescriptionDetailRowIndex = 0;


       window.MESSAGE_TYPE_SUCCESS = 'Success';
       window.MESSAGE_TYPE_ERROR = 'Error';
       </script>
       <link rel="icon" href="/images/icon.jpg" type="image/x-icon">

       {{--{{ HTML::style('/login_css/style.css') }}--}}
       {{ HTML::style('/css/windows_menu.css') }}
       {{--{{ HTML::style('/css/user_reg_form.css') }}--}}
       {{ HTML::style('/css/grid.css') }}
       {{ HTML::style('/css/bootstrap.min.css') }}
       {{--{{ HTML::style('/css/bootstrap-datepicker3.standalone.min.css') }}--}}
       {{ HTML::style('/css/bootstrap-datepicker.standalone.min.css') }}
       {{ HTML::style('css/breadcrumbs.css') }}
       {{ HTML::style('/css/isotope.css') }}
       {{ HTML::style('/css/contact-form.css') }}
       {{ HTML::style('/login_css/style.css') }}
       {{ HTML::style('/css/camera.css') }}
       {{ HTML::style('/css/owl.carousel.css') }}
       {{ HTML::style('/css/select2.min.css') }}
       {{ HTML::style('plugins/clock-picker/css/bootstrap-clockpicker.min.css') }}
       {{ HTML::style('/css/style.css') }}



   <!--========================================================
                             JS
   =========================================================-->

       {{--{{ HTML::script('js/user_validation.js') }}--}}
       {{ HTML::script('js/Chart.bundle.min.js') }}
       {{ HTML::script('js/jquery.min.js') }}
       {{ HTML::script('js/bootstrap.min.js') }}
       {{ HTML::script('js/moment.js') }}
       {{ HTML::script('js/bootstrap-datepicker.js') }}

       {{ HTML::script('js/jquery-migrate-1.2.1.js') }}
       {{ HTML::script('js/jquery.equalheights.js') }}
       {{ HTML::script('js/isotope.min.js') }}
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
       {{ HTML::script('js/select2.full.min.js') }}
       {{ HTML::script('js/jquery-plugins/jquery.dataTables.min.js') }}
       {{ HTML::script('js/jquery-plugins/jquery.validate.js') }}
       {{ HTML::script('js/jquery-plugins/jquery.validate.extension.js') }}
       {{ HTML::script('plugins/clock-picker/js/bootstrap-clockpicker.min.js') }}
       {{ HTML::script('js/view-pages/view-page-message-dictionary.js') }}
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
            @include('includes.header')

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
            <script type="application/javascript">
                $( document ).ajaxStart(function() {
                    $( "#loadingContent" ).show();
                });
                $( document ).ajaxStop(function () {
                    $( "#loadingContent" ).hide();
                })
            </script>
            @yield('scripts')
        </div>

        <div id="loadingContent" class=""><img src="{{asset('images/loading-pic.gif')}}" alt="loading........"/></div>
        <div class="userSuccMSG dN"></div>
    </body>
</html>