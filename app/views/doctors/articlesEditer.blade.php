@extends('app')
@section('title')
    Add New Post
@endsection
@section('content')
    <script type="text/javascript" src="{{ asset('js/tinymce_4.7.2/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector : "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
    <form action="{{route('arStore')}}" method="post" enctype="multipart/form-data" style="padding-left: 60px; padding-right: 60px">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{--<div class="form-group">--}}
            <label style="color: cornflowerblue"><h4>Title of Article</h4></label>

            <div class="imageupload panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">Upload Image</h3>
                    <div class="btn-group pull-right">
                        <input type="file" class="btn-group pull-right" name="image" required />
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






            <input required="required" value="" placeholder="Enter title here" type="text" name = "title"class="form-control" />
        {{--</div>--}}
        <div class="form-group">
            <textarea name='body'class="form-control" style="min-height: 300px" ></textarea>
        </div>

        <button type="submit"  class="btn btn-raised btn-sm btn-1" id="avatar_form">Save Draft</button>
    </form>



@endsection