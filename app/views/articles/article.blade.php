<head>
    <link href="{{asset('css/article.css')}}" rel="stylesheet">
</head>
@extends('layouts.master')
<!--========================================================
   TITLE
   =========================================================-->
@section('title')
    {{ $articles->title}}
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

    <?php $image = '/articleimage'.'/'.$articles->articleId.'/'.$articles->bannar_image?>
    <!-- Page Content -->
    <div class="container">{{--$("#commentList").empty();--}}
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 mT10 " style="" >
                <h1><strong>{{ $articles->title}}</strong></h1>
                <h7 class="mB20" style="color: grey">Posted {{$articles->articlePosted}}

                    <strong>

                        @if(User::find($articles->userId)->user_type == 'Doctor')
                        <a href="{{route('drProfile',$articles->userId)}}">
                              By Dr.{{$articles->full_name}}
                        </a>
                            @else
                            By {{$articles->full_name}}
                            @endif

                    </strong></h7>
            </div>
            <img class="col-xl-12 col-lg-12 col-md-12 col-12" style="max-height: 400px" src="{{asset($image)}}" alt="Post" /><br>
            {{--Likes--}}

        </div>
        <div class="mB3  mT15 ">
            @if(Auth::check())
                <span id="like_{{$articles->articleId}}" onclick="hitLikes('{{$articles->articleId}}','{{Auth::user()->id}}')"
                      class="pB10 fL
         {{--{{dd($likes)}}--}}
                      {{--{{dd($article->articleId)}}--}}
                      @if(in_array($articles->articleId ,$likeData))
                              selectedClass
@endif
                              ">
      <i class="fa fa-thumbs-up articleLike" aria-hidden="false">&nbsp; Likes&nbsp;<span id="totalLike_{{$articles->articleId}}">
      {{$articles->article_likes}}
      </span></i></span><br>
            @endif
        </div>
    {{--endLikes--}}
        <!-- Container -->
        <div class="ft-ctbox clearfix">
            <h1 style="color: #01ADD5">Description<br></h1>
            {{ $articles->article_text}}
        </div>

        {{--dsajdkl--}}

        <hr class='w95p fL mT0'/>
        <div class="col-sm-9 col-md-9 col-lg-9">

    @if(Auth::user())
                <h4><strong style="color: #01ADD5">Write Comment On Article</strong></h4>
                <form class="form-inline">

                    <div class="input-group" style="width: 100%">

                        <textarea style="resize: none" class="col-lg-12 col-md-12 col-sm-12 form-control" type="text" placeholder="Write Comments" name="addComment" id="comment"  style="width: 100%"></textarea>
                        <span class="input-group-addon p0"  style="width: 20%"><button id="ajax" type="submit" style="width: 100%; height: 50px" ><h5>Comment</h5></button></span>
                    </div>


            {{--<input class="col-lg-12 col-md-12 col-sm-12 form-control" type="text" placeholder="Write Comments" name="addComment" id="comment"  style="width: 100%" />--}}
            <br>
            <input class="form-control" type="hidden" value="{{$articles->articleId}}" name="target_Id" id="target_Id" >
            <input class="form-control" type="hidden" value="article" name="type" id="type">

            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <br> {{--
                                                                    <input type="hidden" name="commenttoken" value=" {{csrf_token()}}" />--}}

                    {{--<button class="col-lg-12 col-sm-12 col-md-12" id="ajax" type="submit">--}}
                {{--<h4>Comment</h4></button>--}}

        </form>
            @else {{--@include('includes.webSocialLinks')--}} @endif
            <br>
    <hr>
    <div class="tab-content">
        <h4 class="tab-content" ><strong>Comments on Article</strong></h4>
        {{--@foreach($drComments as $comment)--}}

        <div class="" style="background-color: white">
            <ul  class="commentList" id="commentList">

            </ul>
        </div>
        <br> {{--@endforeach--}}
    </div>



</div>




    </div>


    <script src="{{asset("js/doctor.profile.js")}}"></script>
    <script src="{{asset('js/articleListScript.js')}}"></script>
@stop