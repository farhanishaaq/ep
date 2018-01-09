<head>
   <link href="{{asset('css/article.css')}}" rel="stylesheet">

</head>
@extends('layouts.master')
<!--========================================================
   TITLE
   =========================================================-->
@section('title')
Articles
@stop
<!--========================================================
   CONTENT
   =========================================================-->
@section("current_articles")
class="current"
@stop
@section('redBar')
<div class = "user_logo">
   <div class="header_1 wrap_3 color_3 login-bar">Health Articles
   </div>
</div>
@stop
@section('sliderContent')
@stop
@section('content')
<br>
<div class="container-fluid" style="background-color: whitesmoke">
<div class="carousel" role="listbox">
   <div class="carousel-item active">
      <div class="row">
         <div class="col-lg-3 col-sm-12 post-block post-thumb">
            {{--Main page left Panel--}}
            <div class="col-lg-12 col-md-12 pT10 card" role="tab" id="headingOne">
               <h1 class="mT10 mB0 c3 pB20" style="font-family: 'Marvel'; float: left;">Latest Updates</h1>
               @foreach ($articles->slice(0, 3) as $article)
               <?php $image = '/articleimage'.'/'.$article->articleId.'/'.$article->bannar_image?>
               <div class="col-md-12 col-sm-12 col-lg-12">
                  <div class="col-md-5">
                     <div class="post-box">
                        <img src="{{asset($image)}}"   style="margin-bottom: 10px; height:50px;" /><br>
                        {{--Like Button--}}
                        @if(Auth::check())
                        <span class="pB10"> <i class="fa fa-thumbs-up" aria-hidden="false">&nbsp; Likes&nbsp;<span>
                        {{$article->article_likes}}
                        </span></i></span>
                        @endif
                        {{--Like end--}}
                     </div>
                  </div>
                  {{--Article list right panel--}}
                  <div class="col-md-7">
                     <span class="post-category"><a href="{{route('articles',$article->articleId)}}" title="Travel" style="font-size: 15px;">{{$article->title}}</a></span><br>
                     <h5 style="color: #808080">By Dr.{{$article->full_name}}</h5>
                     <br>
                  </div>
               </div>
               <hr class="w100p fL mT0">
               @endforeach
            </div>
         </div>
         {{--Main Page right Panel--}}
         <div class="col-lg-9 col-sm-12 ">
            {{--
            <div class="col-lg-8 col-sm-12 post-block post-big">
               --}}
               {{--Article List left panel--}}
               @if(empty($articles))
               <div class="col-lg-offset-4 col-md-offset-4">
                  <span><img src="{{asset('images/not_found.png')}}"></span><br>
               </div>
               @else
               @foreach($articles as $article)
               <?php $image = '/articleimage'.'/'.$article->articleId.'/'.$article->bannar_image?>
               <div class="col-md-12 col-sm-12  col-lg-12 card listBox" style="border-radius: 5px; padding-top: 10px; ">
                  {{--
                  <div class="col-md-12 col-sm-12  col-lg-12">
                     --}}
                     <div class="col-md-5">
                        <div class="post-box">
                           <img src="{{asset($image)}}"   style="margin-bottom: 10px; height:250px;" /><br>
                           {{--Like Button--}}
                           @if(Auth::check())
                           <span id="like_{{$article->articleId}}" onclick="hitLikes('{{$article->articleId}}','{{Auth::user()->id}}')" class="pB10 fL"> <i class="fa fa-thumbs-up articleLike" aria-hidden="false">&nbsp; Likes&nbsp;<span id="totalLike_{{$article->articleId}}">
                           {{$article->article_likes}}
                           </span></i></span>
                           @endif
                           {{--Like end--}}
                        </div>
                     </div>
                     {{--Article list right panel--}}
                     <div class="col-md-7">
                        <span class="post-category"><a href="{{route('articles',$article->articleId)}}" title="Travel" style="font-size: 20px;">{{$article->title}}</a></span><br>
                        <h5 style="color: #808080">By Dr.{{$article->full_name}}</h5>
                        <br>
                            <span>
                        <div class="show-read-more">{{$article->article_text}}</div>

                        </span>
                        <a href="{{route('articles',$article->articleId)}}" title="Read More">Read More</a>
                       </div>
               </div>
               @endforeach
               @endif
               <span class="center"><?php echo $articles->links(); ?></span>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- LikeBtn.com BEGIN -->
<script src="{{asset('js/articleListScript.js')}}"></script>
@stop