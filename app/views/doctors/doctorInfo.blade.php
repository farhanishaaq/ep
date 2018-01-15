{{--This fill CSS Save in CSS Folder As doctorList--}}
<head>
    <link href="{{asset('cs/dutyDays.css')}}">
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
            Doctor Info
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
            <br>
            <section class="form-Section col-md-6 h850 fL">
                <h3 class="mT15 mB0 c3">Basic Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <form action="{{URL::route('doctorInfoForm') }}" method="post" name="form">
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">First Name</label>
                        <div class="col-xs-6">
                            <input type="hidden"  name="phone" required="true" value="{{$data['phone']}}">
                            <input type="hidden"  name="city" required="true" value="{{$data['doctorCity']}}" class="form-control" placeholder="First Name">
                            <input type="text" id="fname" name="fname" required="true" value="{{$data['fname']}}" class="form-control" placeholder="First Name">
                            <span id="error_fname" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Last Name</label>
                        <div class="col-xs-6">
                            <input type="text" id="lname" name="lname" required="true" value="{{$data['lname']}}" class="form-control" placeholder="Last Name">
                            <span id="error_lname" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Email</label>
                        <div class="col-xs-6">
                            <input type="text" id="email" name="email" required="true" value="{{$data['doctorEmail']}}" class="form-control" placeholder="Email" disabled>
                            <span id="error_email" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Username</label>
                        <div class="col-xs-6">
                            <input type="text" id="username" name="username" required="true" value="{{$data['doctorUserName']}}" class="form-control" placeholder="Username" disabled>
                            <span id="error_username" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Password</label>
                        <div class="col-xs-6">
                            <input type="password" id="password" name="password" required="true" value="{{$data['password']}}" class="form-control" placeholder="Password">
                            <span id="error_password" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Confirm Password</label>
                        <div class="col-xs-6">
                            <input type="password" id="confirm_password" name="confirm_password" required="true" value="{{$data['password']}}" class="form-control" placeholder="Confirm Password">
                            <span id="error_confirm_password" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label">Status</label>
                        <div class="col-xs-6">
                            {{switch_btn_group(['fieldName'=>'status', 'onVal'=>'Active', 'offVal'=>'Inactive'])}}
                        </div>
                    </div>
                    <h3 class="mT15 mB0 c3">Doctor Info</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Doctor Category</label>
                        <div class="col-xs-6 multi-select">
                            {{medical_specialty_drop_down($user)}}
                            <span id="error_doctor_category_id" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <hr class="w95p fL mT0" />
                    <br>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Qualification</label>
                        <div class="col-xs-6 multi-select">
                            {{qualifications_drop_down($user)}}
                            <span id="error_doctor_category_id" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <hr class="w95p fL mT0" />
                    <br>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Fee Range</label>
                        <div class="col-xs-6">
                            <div class="input-group col-xs-12">
                                <input type="text" id="min_fee" name="min_fee" class="form-control input-sm" value="" placeholder="Min Fee" />
                                <span class="input-group-btn w20 fs25 taC">-</span>
                                <input type="text" id="max_fee" name="max_fee" class="form-control input-sm" value="" placeholder="Max Fee" />
                            </div>
                        </div>
                    </div>
                    <hr class="w95p fL mT0" />
                    <br>
                    <div class="form-group">
                        <label class="col-xs-6 control-label asterisk mB15">Days & Time</label>
                        <div class="col-xs-6 control-label asterisk mB15">
                            <button type="button" class="btn btn-info btn-sm" style="float: right" id="dayAddBtn">
                                <span class="glyphicon glyphicon-plus-sign"></span> Add Day
                            </button>
                        </div>

                        {{--doctorDutyDays For Append Purpose--}}

                        <div id="doctorDutyDays">
                            <div id="1" name="doctorDaysData">
                        <div class="col-xs-4" >
                            <select id="dutyDays" class="myselect" name="dutyDays[0]" style="height: 35px;">
                                <option>Select Day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>

                    <br>
                    <div class="col-xs-5 mB15">
                        <div class="input-group col-xs-12">
                            <span class="input-group-btn w20 fs25 taC">-</span>
                            <input type="text" id="start_time" name="start_time[0]" class="form-control input-sm" value="" placeholder="Start" />
                            <span class="input-group-btn w20 fs25 taC">-</span>
                            <input type="text" id="end_time" name="end_time[0]" class="form-control input-sm" value="" placeholder="End" />
                        </div>
                    </div>
                                <button type="button" class="btn btn-danger" style="margin-left: 12px" onclick="deleteRow(this.parentNode.id)">Delete </button>
                        </div>
                    </div>
                    </div>
                    <hr class="w95p fL mT0" />
                    <br>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Estimated Time Slot</label>
                        <div class="col-xs-6">
                            <input type="number" id="slot_time" name="slot_time" required="true" value="" class="form-control" placeholder="Time Minut">
                            <span id="error_doctor_category_id" class="field-validation-msg"></span>
                        </div>
                    </div>
                </form>
            </section>
            {{--Profile Image--}}
            <section class="form-Section col-md-6 h850 fL">
                <div class="container w100p">
                    <h3 class="mT15 mB0 c3">Doctor Photo</h3>
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
                <input type="submit" id="registerDoctor" name="registerDoctor" value="Submit" class="submit" />
                <input type="button" id="cancel" value="Cancel" class="submit" novalidate onclick="goTo('{{route("login")}}')" />
            </div>
        </div>
    </div>
    {{--{{ Form::close() }}--}}
@section('scripts')
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
    <script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>
    <script src="{{asset('js/view-pages/doctors/DoctorsForm.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#medical_specialty_id").select2();
        });
        $(document).ready(function() {
            $("#qualification_id").select2();
        });
        $(document).ready(function() {
            $("#dutyDays").select2();
        });
        $("#dayAddBtn").click(function(){
            length = $('#doctorDutyDays').children().length;
if(length < 7) {
    var div = document.getElementsByName("doctorDaysData")[0];
    clone = div.cloneNode(true); // true means clone all childNodes and all event handlers
    clone.id = "" + (++i);
    clone.querySelector('#dutyDays').setAttribute('name', 'dutyDays[' + i+']');
    clone.querySelector('#start_time').setAttribute('name', 'start_time[' + i+']');
    clone.querySelector('#end_time').setAttribute('name', 'end_time[' + i+']');
//    clone.querySelector('#start_time').setAttribute('id','1');
            clone.querySelector('#dutyDays').setAttribute('id', 'dutyDays' + i );
            clone.querySelector('#start_time').setAttribute('id', 'start_time' + i );
            clone.querySelector('#end_time').setAttribute('name', 'end_time[' + i +']');
    document.getElementById("doctorDutyDays").appendChild(clone);
}
});

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