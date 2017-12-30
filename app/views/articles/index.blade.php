<head>
  <style>
.slectedClass{
text-decoration: underline;
color: deepskyblue;
cursor:pointer;
}
.selectClass:hover
{
     /*color:#00A0C6;*/
     cursor:pointer;
     text-decoration: underline;
}

</style>

</head>


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

    <div class="main-container">
     <main class="site-main">

            <div class="container">
@foreach($articles as $article)
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-lg-8 col-sm-12 post-block post-big">
                                    <div class="post-box">
                                        <img src="{{asset('images/food-for-stones.jpg')}}" alt="Slide" style="margin-bottom: 10px;" />
                                        <span id="{{$article->likeId}}" onclick="hitLikes(this.id)"> <i class="fa fa-thumbs-up selectClass" aria-hidden="false">&nbsp; Likes&nbsp;<span id="likesCount">

                                                  {{$article->like_count}}

                                         </span></i></span>

                                        <div class="entry-content">
                                            <h3><span class="post-category"><a href="{{route('articlesfood')}}" title="Travel">These 4 Foods can Cause Stones in Gall Bladder</a></span></h3>
                                            <a href="{{route('articlesfood')}}" title="White Sand of The Desert Discovery">13 Surprising Habits Proven to Trigger Kidney Stones</a><br>
                                            <a href="{{route('articlesfood')}}" title="Read More">Read More</a>

                                            <P>The gallbladder is a tiny pear-shaped organ located on the right side of the abdomen just beneath the liver. It holds the bile; the product of liver and pours it into the intestine. It continues its destined work until the incoming bile causes stone formation inside it which hinders its workability. If the bile is overloaded with cholesterol and bilirubin than it can cause the stone formation in this tiny part of digestive system. 80 percent of gallbladders stones are composed of cholesterol and the rest of 20 percent are of bilirubin and both these components are associated with your dietary intake. The foods increasing cholesterol level and bilirubin level are responsible for gallbladder stones and some of the dietary habits too. Have a look at some of those foods which are going to play against this tiny organ to keep it healthy.</P>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 post-block post-thumb">

                                    <div class="post-box">
                                        <img src="{{asset('images/blog/blog3.jpg')}}" alt="Slide" /><br>
                                        <i class="fa fa-heart" style="color: #00aff0" aria-hidden="true">Likes</i>
                                        <i class="fa fa-eye" style="color: #00aff0" aria-hidden="true">Views</i>
                                        <div class="entry-content">
                                            <span class="post-category"><a href="#" title="Sport">8 Ways You can Benefit from Physiotherapy</a></span>
                                            <h3><a href="#" title="High-Tech Prototype Bike Announced">Track Your Ovulating Days</a></h3>
                                            <a href="#" title="Read More">Read More</a>

                                            </div>
                                    </div>

                                </div>
                            </div>

                                <div class="col-lg-8 post-block post-big">
                                    <div class="post-box">
                                        <img src="{{asset('images/Physiotherapists.jpg')}}" alt="Slide" />
                                        <i class="fa fa-heart" style="color: #00aff0" aria-hidden="true">Likes</i>
                                        <i class="fa fa-eye" style="color: #00aff0" aria-hidden="true">Views</i>
                                        <div class="entry-content">
                                           <h3> <span class="post-category"><a href="#" title="Nature">8 Ways You can Benefit from Physiotherapye</a></span></h3>
                                            <a href="#" title="White Sand of The Desert Discovery">Work to Avoid Surgical Procedure:</a><br>
                                            <a href="#" title="Read More">Read More</a>

                                            <p>Modern treatment methods have evolved and developed to cure and manage ailments in a variety of ways. In the recent era, various exercise therapies, manual therapies and even electrotherapies are in practice to treat the suffering humanity. Physical therapy or physiotherapy is one of those approaches which actually use physical and mechanical force to mostly treat movement related problems. It is a relatively new method of treatment as compared to old traditional medication approach but it really works wonderfully. Read on to know about how physiotherapy is helpful to solve out stubborn medical problems.</p>

                                        </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 post-block post-thumb">
                                    <div class="post-box">
                                        <img src="{{asset('images/blog/blog2.jpg')}}" alt="Slide" />
                                        <i class="fa fa-heart" style="color: #00aff0" aria-hidden="true">Likes</i>
                                        <i class="fa fa-eye" style="color: #00aff0" aria-hidden="true">views</i>
                                        <div class="entry-content">
                                            <span class="post-category"><a href="#" title="Sport">Health</a></span>
                                            <h3><a href="#" title="High-Tech Prototype Bike Announced">5 Things That Can Help You to Conceive</a></h3>
                                            <a href="#" title="Read More">Read More</a>

                                        </div>
                                    </div>
                                </div>

                            </div>
@endforeach
                </div>

     </main>
    </div>

    <!-- LikeBtn.com BEGIN -->

    <script src="{{asset('js/emailAvailability.js')}}"></script>
@stop