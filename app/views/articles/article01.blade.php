
@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Create Appointment
@stop


<!--========================================================
                          CONTENT
=========================================================-->
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Health Articles
        </div>
    </div>
@stop

@section('sliderContent')
@stop


@section('content')






<main class="site-main">

    <!-- Page Content -->
    <div class="container">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 ">
            <img class="col-xl-12 col-lg-12 col-md-12 col-12" style="max-height: 400px" src="{{asset('images/food-for-stones.jpg')}}" alt="Post" />
        </div>

        <!-- Container -->
        <div class="container">
            <div class="row">

                <div class="ft-ctbox clearfix">


                            <!--removed author box -->
                            <div class="ft-lsingle">
                                <section class="ft-entry">
                                      <h2><b>Junk Food:</b></h2>
                                        <p>Chips, burgers, cookies, and cakes are really delightful to your taste buds but a great foe to your gallbladder. They are enriched with unhealthy fats and hard to break down. They gravely increase the level of cholesterol and bilirubin which are main components of gallbladder stones. So if you want to keep gallbladder free from a stone than chose the fresh fruits and vegetables as the snack.</p>
                                        <h2><b>High-Fat Foods:</b></h2>
                                        <p>The most of the cholesterol of the body is formed in result of high-fat food intake. And when this cholesterol reaches to the gallbladder it starts depositing there. So keep the fat content low in your dietary intake by avoiding high-fat foods like dairy products, fatty meat, eggs, and sweets.</p>
                                        <h2><b>Fried and Processed Food:</b></h2>
                                        <p>The fried and highly processed foods are associated with high risk of gallbladder stone formation. These foods elevate cholesterol level as these have a high content of fats and also enhance bilirubin level, as the liver is doing too much effort to detoxify these foods and in the result, too much bilirubin is produced. And both these components sum up in the result of gallbladder stones.</p>
                                        <h2><b>Refined Foods:</b></h2>
                                        <p>Apparently healthy and safe outlook of these foods may deceive you but believe us that these refined foods like white bread, refined pastas and white rice are another major reason for gallbladder stone development. These refined foods immediately convert into fats and have low fiber content. High fats produce more cholesterol and low fiber content make the friendly environment for this cholesterol to start depositing in the gallbladder.</p>
                                        <h3><b>Is it Time to Quit?</b></h3>
                                        <p>It seems that almost all types of foods around you are going to cause gallbladder stone formation or at least increasing the risk of it. But do not panic it’s not the time to quit. Just keep following points in mind and follow them to live with a healthy stone-free gallbladder.</p>
                                        <ul>
                                            <li>Avoid fatty, processed and fried foods as much as possible.</li>
                                            <li>Add up the fresh fruits and vegetables in your dietary intake.</li>
                                            <li>Eat high fiber diet which keeps the cholesterol and bilirubin level low and hinders their deposition in form of stones.</li>
                                            <li>Never overeat. It will keep your gallbladder full and increase the risk of stone formation.</li>
                                            <li>Eat little chunks of food throughout the whole day and give proper time to the tiny gallbladder to empty itself completely.</li>
                                        </ul>
                                        <h3>How To Proceed?</h3>
                                        <p>Doctor’s from several specialties may be involved in your treatment and management if you are diagnosed with gallstones. On presentation with initial symptoms like nausea and abdominal pain, you would most probably visit a general practitioner. To find a general practitioner in Rawalpindi</a> log on to Marham and book an appointment online easily from the comfort of your home.</p>
                                        <p>After primary analysis, you would be referred to a gastroenterologist who will suggest you undergo an ultrasound to confirm the diagnosis, finally, you will be scheduled for a surgery for gallstone removal called cholecystectomy. This is performed by general surgeons, tofind a general surgeon in Rawalpindi</a> visit Marham-Find a doctor.</p>
                                        <p>After surgery, you may experience some gastric disorders but these usually subside with time. Developing healthy eating habits can be helpful in preventing these and staying healthy post surgery.</p>
                                </section>
                            </div>
                </div>


            </div>
        </div>


    <div class="container-fluid">
        <div class="chatAnsHead">
            <h3>Question</h3>
            <ul>
                <li class="col-lg-3 col-md-3" style="display: list-item;"> <span class="chat-img pull-left">
                        <img src="{{asset('/images/ali.png')}}" alt="User Avatar" class="img-circle" style="max-height: 60px; max-width: 60px"> </span>



                </li>
            </ul>
            <div class="col-lg-9 col-md-9">
                <p>hi,
                    <br>please tell me about my daily foods</p>

            </div>
        </div>
        <div class="chatAnsHead">
            <h3>Answers</h3>
        </div>
        <section  >
            <ul>
                <li class="col-lg-1 col-md-1" style="display: list-item;"> <span class="chat-img pull-left">
                        <img src="https://zindagilivewebphotos.s3-eu-west-1.amazonaws.com/pictures/images/000/002/859/original/Dr_Noreen_Akram_pic_Employee___031.png?1496825288" alt="User Avatar" class="img-circle" style="max-height: 60px; max-width: 60px"> </span>



                </li>
                <li class="col-lg-3 col-md-2" style="display: list-item">
                    {{--<div class="contvrChat-body">--}}
                                <a href="#">Dr. Noreen  Waseem</a>
                            <p><a href="#">General Physician</a>  - 10 years experience</p>
                            <small>09 Mar, 2017</small>
                    {{--</div>--}}
                </li>

                    <div>
                        <div class="col-lg-8 col-md-8">
                            <p>hi,
                                    <br>U can take Tablet Synflex 550 mg twice a day after meals and Cap Risek 20 mg twice a day before meals for 2 to 3 days for an acute attack.  Use dark glasses in sun and drink plenty of water....for further queries u can contact me at myzindagi telemedicine clinic.</p>

                        </div>
                        <div class="col-lg-12 col-md-12">
                            <h3>Comments</h3>

                                <form class="col-lg-12 col-md-12" id="new_comment" >

                                        <input class="form-control" placeholder="Post a comment" required="required" type="text" name="comment[user_comment]" id="comment_user_comment">


                                <div class="profile-userbuttons">
                                    <button type="submit" class="btn btn-raised btn-sm btn-1" >   Comments   </button>
                                    <button type="button" class="btn btn-raised btn-sm btn-1" data-toggle="modal" data-target="#myModal">Ask A Question</button>
                                    @include('articles.include.askquestions')
                                </div>
                                </form>

                        </div>

                    </div>



            </ul>
        </section>
    </div>


    </div>
</main>











    @stop