{{--This fill CSS Save in CSS Folder As doctorList--}}
<head>
       <link href="{{asset('css/doctorList.css')}}" rel="stylesheet">
<style>
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
</head>
@extends('layouts.master')
<!--========================================================
   TITLE
   =========================================================-->
@section('title')
    Doctors Info
@stop
@section('redBar')
    <div class = "user_logo">
        <div class="header_1 wrap_3 color_3 login-bar">
            Update Profile
        </div>
    </div>
@stop
@section('sliderContent')
@stop
<!--========================================================
   CONTENT
   =========================================================-->
@section('content')

    <div class="row">
        <div class="container">
            <form action="{{URL::route('profileUpdate') }}" method="post">
            <br>
            <section class="form-Section col-md-6 fL ">
                <h3 class="mT15 mB0 c3">Profile Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">First Name</label>
                        <div class="col-xs-6">
                            <input type="hidden"  name="phone" required="true" value="{{$data[0]->phone}}">
                            {{--<input type="hidden"  name="city" required="true" value="{{$data[0]->city}}" class="form-control" placeholder="City">--}}
                            <input type="text" id="fname" name="fname" required="true" value="{{$data[0]->fname}}" class="form-control" placeholder="First Name">
                            <span id="error_fname" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Last Name</label>
                        <div class="col-xs-6">
                            <input type="text" id="lname" name="lname" required="true" value="{{$data[0]->lname}}" class="form-control" placeholder="Last Name">
                            <span id="error_lname" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Email</label>
                        <div class="col-xs-6">
                            <input type="text"  name="email"  value="{{$data[0]->email}}" class="form-control" placeholder="Email" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Username</label>
                        <div class="col-xs-6">
                            <input type="text" id="username" name="username" value="{{$data[0]->username}}" class="form-control" placeholder="Username" disabled>

                        </div>
                    </div>
                <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Phone</label>
                        <div class="col-xs-6">
                            <input type="number" id="phone" name="phone" required="true" value="{{$data[0]->phone}}" class="form-control" placeholder="Phone">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Password</label>
                        <div class="col-xs-6">
                            <input type="password" id="password" name="password" required="true" value="{{$data[0]->password}}" class="form-control" placeholder="Password">
                            <span id="error_password" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Confirm Password</label>
                        <div class="col-xs-6">
                            <input type="password" id="confirm_password" name="confirm_password" required="true" value="{{$data[0]->password}}" class="form-control" placeholder="Confirm Password">
                            <span id="error_confirm_password" class="field-validation-msg"></span>
                        </div>
                    </div>


            </section>
            {{--Profile Image--}}
            <section class="form-Section col-md-6 fL">
                <div class="container w100p">
                    <h3 class="mT15 mB0 c3">User Photo</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />
                    {{--
                    <div class="form-group profile-photo file-input">--}}
                    {{--<label class="control-label">Profile Photo</label>--}}
                    {{--<input id="photo" name="photo" type="hidden" value="{{{ Form::getValueAttribute('photo', null) }}}">--}}
                    {{--<input id="userPhoto" name="userPhoto" type="file" class="file-loading" accept="image/*">--}}
                    {{--
                 </div>
                 --}}
                    <div class="imageupload panel panel-default">
                        <div class="panel-heading clearfix">
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
                </div>
            </section>
            {{--Image END--}}
            <div class="col-xs-12 taR pR0 mT20">
                <input type="submit" value="Update" class="submit" />
                <input type="button" id="cancel" value="Cancel" class="submit" novalidate onclick="goTo('{{URL('/')}}')" />
            </div>
            </form>
        </div>
    </div>
    {{--{{ Form::close() }}--}}
@section('scripts')
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
    <script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>
    <script src="{{asset('js/view-pages/doctors/DoctorsForm.js')}}"></script>
    <script>

        function deleteRow(id) {
            if(id!==1)
            document.getElementById(id).remove();

        }



        //                var photoInitialPreview = '';

        {{--@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)--}}
        {{--photoInitialPreview = "{{asset('images/profile-dumy.png')}}";--}}
        {{--@else--}}
        {{--photoInitialPreview = "{{get_profile_photo_url($doctor->user->photo)}}";--}}
        {{--@endif--}}
        $(document).ready(function(){
            //***For gender Radio Selection
            $('.btn.btn-primary-2.gender').click(function(){
                setRadioValInHidden('gender',$(this));
            });

            var options = {
                saveCloseUrl: "{{route('doctors.index')}}",
                photoUploadUrl: "{{route('uploadProfilePic')}}",
                photoInitialPreview :[
                    photoInitialPreview
                ]

            };
            var doctorsForm = new DoctorsForm(window,document,options);
            doctorsForm.initializeAll();
        });
    </script>
@stop
@endsection
@endsection