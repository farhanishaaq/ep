@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Profile
@stop
@section('headScript')


    @stop
@section('redBar')
    <div >

    </div>
@stop

@section('sliderContent')
@stop
@section('content')
    {{--<div class="container">--}}



    {{--</div>--}}


 @foreach($users as $user)

    <?php
    $from = new DateTime($user->dob);
    $to   = new DateTime('today');
    $user->dob= $from->diff($to)->y;
    ?>




    <div class=" container-fluid" style="max-width: 1200px;">


        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <div class="card card-topline-aqua">
                        <div class="card-body no-padding height-9">
                            <div class="row">
                                <div class="profile-userpic">
                                    <img src="{{ asset('images/dp.svg') }}" class="img-responsive" alt=""> </div>
                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name" name="name">{{$user->full_name}} </div>

                            </div>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Age:</b> <div class="profile-desc-item pull-right">{{ $user->dob  }}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone Number</b> <div class="profile-desc-item pull-right">{{ $user->cell }}</div>
                                </li>                                <li class="list-group-item">
                                    <b>gender</b> <div class="profile-desc-item pull-right">{{ $user->gender }}</div>
                                </li>


                            </ul>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->

                            <!-- END SIDEBAR BUTTONS -->
                        </div>
                    </div>
                    {{--<div class="card">--}}
                        {{--<div class="card-head card-topline-aqua">--}}
                            {{--<header>About Me</header>--}}
                        {{--</div>--}}
                        {{--<div class="card-body no-padding height-9">--}}
                            {{--<div class="profile-desc">--}}

                                {{--Hello I am Kiran Patel a Gynaecologist in Sanjivni Hospital Surat. I love to work with all my hospital staff and seniour doctors.--}}
                            {{--</div>--}}



                            {{--<ul class="list-group list-group-unbordered">--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<b>Gender </b>--}}
                                    {{--<div class="profile-desc-item pull-right">Female</div>--}}
                                {{--</li>--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<b>Operation Done </b>--}}
                                    {{--<div class="profile-desc-item pull-right">30+</div>--}}
                                {{--</li>--}}

                            {{--</ul>--}}
                            {{--star rating/--}}



                            {{--<section class='rating-widget'>--}}

                                {{--<!-- Rating Stars Box -->--}}
                                {{--<div class='rating-stars text-center'>--}}
                                    {{--<ul id='stars'>--}}
                                        {{--<li class='star' title='Poor' data-value='1'>--}}
                                            {{--<i class='fa fa-star fa-fw'></i>--}}
                                        {{--</li>--}}
                                        {{--<li class='star' title='Fair' data-value='2'>--}}
                                            {{--<i class='fa fa-star fa-fw'></i>--}}
                                        {{--</li>--}}
                                        {{--<li class='star' title='Good' data-value='3'>--}}
                                            {{--<i class='fa fa-star fa-fw'></i>--}}
                                        {{--</li>--}}
                                        {{--<li class='star' title='Excellent' data-value='4'>--}}
                                            {{--<i class='fa fa-star fa-fw'></i>--}}
                                        {{--</li>--}}
                                        {{--<li class='star' title='WOW!!!' data-value='5'>--}}
                                            {{--<i class='fa fa-star fa-fw'></i>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}

                            {{--</section>--}}

                            {{--star rating/--}}
                        {{--</div>--}}
                    {{--</div>--}}

                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="card">
                            <div class="card-head card-topline-aqua">
                                <header></header>
                            </div>
                            <div class="card-body no-padding height-9">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="tabbable-line">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab1" data-toggle="tab"> About Me </a></li>

                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active fontawesome-demo" id="tab1">
                                                        <div class="row">
                                                            <div id="biography" >
                                                                <div class="row">

                                                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Email:</strong>
                                                                        <br>
                                                                        <p class="text-muted">{{$user->email}}</p>
                                                                    </div>
                                                                    <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                                                        <br>
                                                                        <p class="text-muted">{{$user->cityname}}</p>
                                                                    </div>
                                                                </div>


                                                                <br>
                                                                <h4 class="font-bold">Appointment History</h4>
                                                                <hr>


                                                                        <table id="" class="table-striped" style="width: 100%" >
                                                                            <thead>
                                                                            <tr>

                                                                                <th>Doctor Name</th>
                                                                                <th>Time</th>
                                                                                <th>date</th>
                                                                                <th>Status</th>
                                                                                <th>Paid Fee</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>
                                                                                <td>Tiger Nixon</td>
                                                                                <td>System Architect</td>
                                                                                <td>Edinburgh</td>
                                                                                <td>61</td>
                                                                                <td>2011/04/25</td>
                                                                                <td>$320,800</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Garrett Winters</td>
                                                                                <td>Accountant</td>
                                                                                <td>Tokyo</td>
                                                                                <td>63</td>
                                                                                <td>2011/07/25</td>
                                                                                <td>$170,750</td>
                                                                            </tr>


                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <h4 class="font-bold">Vitals History </h4>
                                                                <hr>
                                                        <table id="" class="table-striped" style="width: 100%" >
                                                            <thead>
                                                            <tr>
                                                                <th>sr</th>
                                                                <th>Weight</th>
                                                                <th>Height</th>
                                                                <th>Blood pressure</th>
                                                                <th>Temperature</th>
                                                                <th>Date</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>Tiger Nixon</td>
                                                                <td>System Architect</td>
                                                                <td>Edinburgh</td>
                                                                <td>61</td>
                                                                <td>2011/04/25</td>
                                                                <td>$320,800</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Garrett Winters</td>
                                                                <td>Accountant</td>
                                                                <td>Tokyo</td>
                                                                <td>63</td>
                                                                <td>2011/07/25</td>
                                                                <td>$170,750</td>
                                                            </tr>


                                                            </tbody>
                                                        </table>


                                                                <br>
                                                                <h4 class="font-bold">Allergies </h4>
                                                                <hr>
                                                                <ul>
                                                                    <li>Life member: Association of Spine Surgeons’ of India.</li>
                                                                    <li>Life member: Gujarat Orthopaedic Association.</li>
                                                                    <li>Life Member: The Indian Society for Bone and Mineral Research (ISBMR).</li>
                                                                    <li>Life member: Ahmedabad Orthopaedic Society</li>
                                                                </ul>


                                                        <br>
                                                        <h4 class="font-bold">Prescriptions </h4>
                                                        <table id="" class="table-striped" style="width: 100%" >
                                                            <thead>
                                                            <tr>
                                                                <th>sr</th>
                                                                <th>Medcine name</th>
                                                                <th>Usage</th>
                                                                <th>Strenght</th>
                                                                <th>Quantity</th>
                                                                <th>Time</th>
                                                                <th>Date</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>
                                                                    <ul>
                                                                        <li>Tiger Nixon</li>
                                                                        <li>Tiger Nixon</li>
                                                                        <li>Tiger Nixon</li>
                                                                        <li>Tiger Nixon</li>
                                                                    </ul>
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>Oral</li>
                                                                        <li>Oral</li>
                                                                        <li>Oral</li>
                                                                        <li>Oral</li>
                                                                    </ul>
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>65mg</li>
                                                                        <li>65mg</li>
                                                                        <li>65mg</li>
                                                                        <li>65mg</li>
                                                                    </ul>

                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>1tab</li>
                                                                        <li>1tab</li>
                                                                        <li>1tab</li>
                                                                        <li>1tab</li>
                                                                    </ul>

                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>Morning</li>
                                                                        <li>Morning</li>
                                                                        <li>Morning</li>
                                                                        <li>Morning</li>
                                                                    </ul>
                                                                </td>
                                                                <td>25/6/2016</td>


                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>
                                                                    <ul>
                                                                        <li>Tiger Nixon</li>
                                                                        <li>Tiger Nixon</li>
                                                                        <li>Tiger Nixon</li>
                                                                        <li>Tiger Nixon</li>
                                                                    </ul>
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>Oral</li>
                                                                        <li>Oral</li>
                                                                        <li>Oral</li>
                                                                        <li>Oral</li>
                                                                    </ul>
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>65mg</li>
                                                                        <li>65mg</li>
                                                                        <li>65mg</li>
                                                                        <li>65mg</li>
                                                                    </ul>

                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>1tab</li>
                                                                        <li>1tab</li>
                                                                        <li>1tab</li>
                                                                        <li>1tab</li>
                                                                    </ul>

                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>Morning</li>
                                                                        <li>Morning</li>
                                                                        <li>Morning</li>
                                                                        <li>Morning</li>
                                                                    </ul>
                                                                </td>
                                                                <td>23/6/2016</td>


                                                            </tr>


                                                            </tbody>
                                                        </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
@endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <!-- start chat sidebar -->
    <div class="chat-sidebar-container" data-close-on-body-click="false">
        <div class="chat-sidebar">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Users
                        <span class="badge badge-danger">4</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab"> <i class="icon-settings"></i> Settings
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Start Doctor Chat -->
                <div class="tab-pane active chat-sidebar-chat" id="quick_sidebar_tab_1">
                    <div class="chat-sidebar-list">
                        <div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd" data-wrapper-class="chat-sidebar-list">
                            <h3 class="list-heading">Online</h3>
                            <ul class="media-list list-items">
                                <li class="media"><img class="media-object" src="images/doc/doc3.svg" width="35" height="35" alt="...">
                                    <i class="online dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">John Deo</h4>
                                        <div class="media-heading-sub">Spine Surgeon</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-success">5</span>
                                    </div> <img class="media-object" src="images/doc/doc1.svg" width="35" height="35" alt="...">
                                    <i class="busy dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">Rajesh</h4>
                                        <div class="media-heading-sub">Director</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="images/doc/doc5.svg" width="35" height="35" alt="...">
                                    <i class="away dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">Jacob Ryan</h4>
                                        <div class="media-heading-sub">Ortho Surgeon</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-danger">8</span>
                                    </div> <img class="media-object" src="images/doc/doc4.svg" width="35" height="35" alt="...">
                                    <i class="online dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">Kehn Anderson</h4>
                                        <div class="media-heading-sub">CEO</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="images/doc/doc2.svg" width="35" height="35" alt="...">
                                    <i class="busy dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">Sarah Smith</h4>
                                        <div class="media-heading-sub">Anaesthetics</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="images/doc/doc7.svg" width="35" height="35" alt="...">
                                    <i class="online dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">Vlad Cardella</h4>
                                        <div class="media-heading-sub">Cardiologist</div>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="list-heading">Offline</h3>
                            <ul class="media-list list-items">
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-warning">4</span>
                                    </div> <img class="media-object" src="images/doc/doc6.svg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">Jennifer Maklen</h4>
                                        <div class="media-heading-sub">Nurse</div>
                                        <div class="media-heading-small">Last seen 01:20 AM</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="images/doc/doc8.svg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">Lina Smith</h4>
                                        <div class="media-heading-sub">Ortho Surgeon</div>
                                        <div class="media-heading-small">Last seen 11:14 PM</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-success">9</span>
                                    </div> <img class="media-object" src="images/doc/doc9.svg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">Jeff Adam</h4>
                                        <div class="media-heading-sub">Compounder</div>
                                        <div class="media-heading-small">Last seen 3:31 PM</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="images/doc/doc10.svg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading">Anjelina Cardella</h4>
                                        <div class="media-heading-sub">Physiotherapist</div>
                                        <div class="media-heading-small">Last seen 7:45 PM</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="chat-sidebar-item">
                        <div class="chat-sidebar-chat-user">
                            <div class="page-quick-sidemenu">
                                <a href="javascript:;" class="chat-sidebar-back-to-list">
                                    <i class="fa fa-angle-double-left"></i>Back
                                </a>
                            </div>
                            <div class="chat-sidebar-chat-user-messages">
                                <div class="post out">
                                    <img class="avatar" alt="" src="images/dp.svg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:10</span>
                                        <span class="body-out"> could you send me menu icons ? </span>
                                    </div>
                                </div>
                                <div class="post in">
                                    <img class="avatar" alt="" src="images/doc/doc5.svg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:10</span>
                                        <span class="body"> please give me 10 minutes. </span>
                                    </div>
                                </div>
                                <div class="post out">
                                    <img class="avatar" alt="" src="images/dp.svg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:11</span>
                                        <span class="body-out"> ok fine :) </span>
                                    </div>
                                </div>
                                <div class="post in">
                                    <img class="avatar" alt="" src="images/doc/doc5.svg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:22</span>
                                        <span class="body">Sorry for
													the delay. i sent mail to you. let me know if it is ok or not.</span>
                                    </div>
                                </div>
                                <div class="post out">
                                    <img class="avatar" alt="" src="images/dp.svg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:26</span>
                                        <span class="body-out"> it is perfect! :) </span>
                                    </div>
                                </div>
                                <div class="post out">
                                    <img class="avatar" alt="" src="images/dp.svg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:26</span>
                                        <span class="body-out"> Great! Thanks. </span>
                                    </div>
                                </div>
                                <div class="post in">
                                    <img class="avatar" alt="" src="images/doc/doc5.svg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:27</span>
                                        <span class="body"> it is my pleasure :) </span>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-sidebar-chat-user-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type a message here...">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn green-bgcolor">
                                            <i class="fa fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Doctor Chat -->
                <!-- Start Setting Panel -->
                <div class="tab-pane chat-sidebar-settings" id="quick_sidebar_tab_3">
                    <div class="chat-sidebar-settings-list">
                        <h3 class="list-heading">Layout Settings</h3>
                        <div class="chatpane inner-content ">
                            <ul class="list-items borderless theme-options">
                                <li class="theme-option layout-setting"><span>Sidebar
												Position </span>
                                    <select class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                        <option value="left" selected="selected">Left</option>
                                        <option value="right">Right</option>
                                    </select>
                                </li>
                                <li class="theme-option layout-setting"><span>Header</span>
                                    <select class="page-header-option form-control input-inline input-sm input-small ">
                                        <option value="fixed" selected="selected">Fixed</option>
                                        <option value="default">Default</option>
                                    </select>
                                </li>
                                <li class="theme-option layout-setting"><span>Sidebar Menu </span>
                                    <select class="sidebar-menu-option form-control input-inline input-sm input-small ">
                                        <option value="accordion" selected="selected">Accordion</option>
                                        <option value="hover">Hover</option>
                                    </select>
                                </li>
                                <li class="theme-option layout-setting"><span>Footer</span>
                                    <select class="page-footer-option form-control input-inline input-sm input-small ">
                                        <option value="fixed">Fixed</option>
                                        <option value="default" selected="selected">Default</option>
                                    </select>
                                </li>
                            </ul>
                            <h3 class="list-heading">Account Settings</h3>
                            <ul class="list-items borderless theme-options">
                                <li>Show me Online
                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                </li>
                                <li>Status visible to all
                                    <input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                </li>
                                <li>Everyone will see my stuff
                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                </li>
                                <li>Auto Sumbit Issues
                                    <input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                </li>
                                <li>Save History
                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                </li>
                            </ul>
                            <h3 class="list-heading">General Settings</h3>
                            <ul class="list-items borderless">
                                <li>Enable Notifications
                                    <input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                </li>
                                <li>Enable SMS Alerts
                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                </li>
                                <li>Location
                                    <input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                </li>
                                <li>Show Offline Users
                                    <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end chat sidebar -->

    <script src="{{ asset('js/jquery.blockui.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/jquery.sparkline.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>

    <script src=" {{ asset('js/profile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/layout.js') }}" type="text/javascript"></script>




@stop



