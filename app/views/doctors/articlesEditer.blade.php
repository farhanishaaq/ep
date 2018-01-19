@extends('app')
@section('title')
    Add New Post
@endsection
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">Write Article
        </div>
    </div>
@stop
@section('content')
    <br>
    <div class="row">
        <div class="container-fluid">
            <div class="col-md-12">
                {{--Left Panel For Title--}}
                <div class="col-md-9">
                    <form action="{{route('arStore')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="imageupload panel panel-default">
                            <div class="panel-heading clearfix">
                                <h3 class="panel-title pB10" style="color: #01ADD5 "><b>Article Title</b></h3>
                                <input required="required" value="" placeholder="Enter title here" type="text" name = "title"class="form-control" style="width: 100%" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="imageupload panel panel-default">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pB10" style="color: #01ADD5 "><b>Write || Edit Article: </b></h3>
                                    <textarea name='body'class="form-control" style="min-height: 300px" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="imageupload panel panel-default w100p put-right">
                            <div class="panel-heading clearfix">
                                <button type="submit"  class="btn btn-raised btn-sm btn-1 put-right" id="avatar_form" style="font-size: 15px">Article Done</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{--Right Panel For Image  --}}
                <div class="col-md-3 p0">
                    <div class="imageupload panel panel-default">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pB10"><b style="color: #01ADD5 ">Upload Article Image</b></h3>
                            <div class="btn-group">
                                <input type="file" class="btn-group w100p form-control" name="image" required />
                            </div>
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
                        </div>
                    </div>
                    {{---------------------------------------------------}}
                </div>
                {{--Right Panel End--}}
            </div>
        </div>
    </div>
    {{--
    <div class="form-group">--}}
    {{--
 </div>
 --}}
    <script type="text/javascript" src="{{ asset('js/tinymce_4.7.2/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector : "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
@endsection