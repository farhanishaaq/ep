<head>
    <link href="{{asset('css/doctorList.css')}}" rel="stylesheet">
{{--<link href="{{asset('css/article.css')}}">--}}
<style>
 .show-read-more .more-text{
        display: none;
    }

.selectedClass{
text-decoration: underline;
color: #00A0C6;
cursor:pointer;
}
.articleLike:hover
{
     color:#00A0C6;
     font-size: 16px;
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
<br><div class="container-fluid" style="background-color: whitesmoke">
    <div class="carousel" role="listbox">
      <div class="carousel-item active">
         <div class="row">
            <div class="col-lg-4 col-sm-12 post-block post-thumb">
               {{--Main page Right Panel--}}
               <div class="post-box">
                  <h1>This is left Panel of Article</h1>
                  <img src="{{asset('images/blog/blog3.jpg')}}" alt="Slide" /><br>
                  <i class="fa fa-heart" style="color: #00aff0" aria-hidden="true">Likes</i>
                  <i class="fa fa-eye" style="color: #00aff0" aria-hidden="true">Views</i>
               </div>
            </div>
            {{--Main Page Left Panel--}}
            <div class="col-lg-8 col-sm-12 ">
               {{--
               <div class="col-lg-8 col-sm-12 post-block post-big">
                  --}}
                  {{--Article List left panel--}}
                  @foreach($articles as $article)
                  <div class="col-md-12 col-sm-12  col-lg-12 card listBox" style="border-radius: 5px; padding-top: 10px; ">
                     <div class="col-md-4">
                        <div class="post-box">
                           <img src="{{asset('images/food-for-stones.jpg')}}" alt="Slide" style="margin-bottom: 10px;" />
                           {{--Like Button--}}

                           {{--<span id="{{$article->likeId}}" onclick="hitLikes(this.id)"> <i class="fa fa-thumbs-up articleLike" aria-hidden="false">&nbsp; Likes&nbsp;<span class="likesCount">--}}
                           {{--{{$article->like_count}}--}}
                           {{--</span></i></span>--}}
                           <span id="like_{{$article->likeId}}" onclick="hitLikes(this.id,' {{$article->articleId}}')" class=""> <i class="fa fa-thumbs-up articleLike" aria-hidden="false">&nbsp; Likes&nbsp;<span id="article_{{$article->articleId}}">
                          {{$article->like_count}}
                          </span></i></span>
                           {{--Like end--}}
                        </div>
                     </div>
                     {{--Article list right panel--}}
                     <div class="col-md-8">
                        <span class="post-category"><a href="{{route('articlesfood')}}" title="Travel">These 4 Foods can Cause Stones in Gall Bladder</a></span><br>
                        <span><a href="{{route('articlesfood')}}" title="White Sand of The Desert Discovery">13 Surprising Habits Proven to Trigger Kidney Stones</a></span><br>
                        <p><span class="show-read-more">The gallbladder is a tiny pear-shaped organ located on the right side of the abdomen just beneath the liver. It holds the bile; the product of liver</span>
                        <a href="{{route('articlesfood')}}" title="Read More">Read More</a></p>
                        {{--
                     </div>
                     --}}
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
<!-- LikeBtn.com BEGIN -->
<script src="{{asset('js/articleListScript.js')}}"></script>
@stop