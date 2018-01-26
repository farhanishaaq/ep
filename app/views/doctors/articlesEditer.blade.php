@extends('layouts.master')
@section('title')
    Add New Post
@endsection

@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Write Article
        </div>
    </div>
@stop

@section('sliderContent')
    @endsection
@section('content')
    <br>
    <div class="row">
        <div class="container-fluid">
            <div class="col-md-12">
                <form action="
                @if(!empty($articles->id))
                {{route('articleupdate')}}
                @else
                {{route('arStore')}}
                @endif
                " method="post" enctype="multipart/form-data">
                {{--Left Panel For Title--}}
                <div class="col-md-9">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="imageupload panel panel-default">
                            <div class="panel-heading clearfix">
                                <h3 class="panel-title pB10" style="color: #01ADD5 "><b>Article Title</b></h3>
                                <input required="required" placeholder="Enter title here"  value="@if(!empty($articles->title)){{$articles->title}}@endif"
                                       type="text" name = "title" class="form-control" style="width: 100%" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="imageupload panel panel-default">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pB10" style="color: #01ADD5 "><b>Write || Edit Article: </b></h3>
                                    <textarea name='body'class="form-control" style="min-height: 300px"  >
                                       @if(!empty($articles->article_text))
                                            {{$articles->article_text}}
                                        @endif
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="imageupload panel panel-default w100p put-right">
                            <div class="panel-heading clearfix">
                                <button type="submit"  class="btn btn-raised btn-sm btn-1 put-right" id="avatar_form" style="font-size: 15px">Article Done</button>
                            </div>
                        </div>

                </div>
                {{--Right Panel For Image  --}}
                <div class="col-md-3 p0">
                    <div class="imageupload panel panel-default">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pB10"><b style="color: #01ADD5 ">Upload Article Image</b></h3>

                            {{--IF Use For Update Showing Existing Image--}}

                            @if(!empty($articles->bannar_image))
                            <input type="hidden" value="{{$articles->id}}" name="id" />
                            <?php $image = '/articleimage'.'/'.$articles->id.'/'.$articles->bannar_image?>
                            <div class="btn-group">
                               <span id="existImage"><span style="text-align: center;"><strong>Used Image</strong></span>
                            <img src="{{asset($image)}}" width="300px" ><br>
                                </span>
                                <p><input class="btn btn-raised btn-sm btn-1" type="button" id="imageCheck" value="Chose New Image">
                                </p></div>
                                                            {{-----------------------}}
                            @endif
                            <div class="noneClass" id="newImage"
                                    @if(!empty($articles->bannar_image))
                                    style="display: none"
                                    @endif
                            >
                                <strong>Select New Image</strong>
                                <input type="file" class="btn-group w100p form-control" name="image"
                                       @if(empty($articles->bannar_image))
                                       required
                                        @endif
                                />
                            </div>
                            @if(!empty($articles->bannar_image))
                            @if(isset($response))
                                @foreach($response as $result)
                                    @if($result==false)
                                        <div class="alert alert-danger">
                                            <strong>Upload Success is Fail!</strong> File Type Should be jpeg, jpg, png, gif, or svg
                                            <strong>Upload Success is Fail!</strong> File Size Should more than 300X300 Pixels
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                                @endif
                        </div>
                    </div>
                    {{---------------------------------------------------}}
                </div>
                {{--Right Panel End--}}
                </form>
            </div>
        </div>
    </div>
    {{--
    <div class="form-group">--}}
    {{--
 </div>
 --}}
    <script>
        // Update Article JS
        tinymce.init({
            selector : "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });

    </script>
    <script type="text/javascript" src="{{ asset('js/tinymce_4.7.2/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/articleListScript.js') }}"></script>

@endsection