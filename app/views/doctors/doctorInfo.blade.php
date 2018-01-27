{{--This fill CSS Save in CSS Folder As doctorList--}}
<head>
    <link href="{{asset('css/doctorList.css')}}" rel="stylesheet">
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
            Profile Info
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
            <form enctype="multipart/form-data" action="
      {{--route Address come form new signup form which mean go for update--}}
            @if(!empty($data['routeAddress']))
            {{--Show and For Fill the profile Form Update purpose--}}
            {{URL::route('doctorInfoForm')}}
            @elseif(Auth::user()->user_type == "Portal User" || Auth::user()->user_type == "Admin")
            {{--For action After Fill profile for update action--}}
            {{URL::route('userProfileUpdate')}}
            @else
            {{URL::route('doctorProfileUpdate')}}
            @endif
                    " method="post" name="form">
                <br>
                <section class="form-Section col-md-6
      @if($data['user_type'] == "Portal Doctor" )
                        h750
@else
                        h650
@endif
                        fL">
                    <h3 class="mT15 mB0 c3">Basic Info</h3>
                    <hr class="w95p fL mT0" />
                    <hr class="w95p fL mT0" />
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">First Name</label>
                        <div class="col-xs-6">
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
                            <input type="text" id="email" name="email" required="true" value="{{$data['email']}}" class="form-control" placeholder="Email" disabled>
                            <input type="hidden" name="email" value="{{$data['email']}}">
                            <span id="error_email" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Username</label>
                        <div class="col-xs-6">
                            <input type="text" id="username" name="username" required="true" value="{{$data['username']}}" class="form-control" placeholder="Username" disabled>
                            <input type="hidden" name="username" value="{{$data['username']}}">
                            <span id="error_username" class="field-validation-msg"></span>
                        </div>
                    </div>
                    {{--@if($data['user_type']== "Portal Doctor")--}}
                    {{--
                    <div class="form-group">
                       --}}
                    {{--<label class="col-xs-5 control-label asterisk">Password</label>--}}
                    {{--
                    <div class="col-xs-6">--}}
                    {{--<input type="password" name="password" required="true" value="{{$data['password']}}" class="form-control" placeholder="Date Of Birth">--}}
                    {{--
                 </div>
                 --}}
                    {{--
                 </div>
                 --}}
                    {{--@endif--}}
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Phone</label>
                        <div class="col-xs-6">
                            <input type="number" CLASS="form-control" name="phone" required="true" value="{{$data['phone']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">DOB</label>
                        <div class="col-xs-6">
                            {{--<input type="text" id="date" name="date" required="true" value="{{{ Form::getValueAttribute('date', null) }}}" class="form-control" placeholder="mm/dd/yyyy">--}}
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" id="dob" name="dob" value="{{{ retrieve_date_for_input('date')}}}" placeholder="Select Date of Birth">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <span id="errorDate" class="field-validation-msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">CNIC</label>
                        <div class="col-xs-6">
                            <input type="number" name="cnic" required="true" class="form-control" value="@if(!empty($data['cnic'])){{$data['cnic']}}@endif" placeholder="CNIC">
                        </div>
                    </div>
                    @if($data['user_type'] != "Portal Doctor")
                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">City</label>
                            <div class="col-xs-6">
                                <select class="js-example-basic-single form-control" id="city" name="city_id">
                                    <option class="vhid"></option>
                                    <option selected>Select City</option>
                                    <option value="{{$data['city_id']}}">Save Same City</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city['id']}}">{{$city['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden"  name="city_id" required="true" value="{{$data['city_id']}}" >
                    @endif
                    <div class="form-group">
                        <label class="col-xs-5 control-label">Gender</label>
                        <div class="col-xs-6">
                            <select name="gender" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    {{--
                    <div class="form-group">
                       --}}
                    {{--<label class="col-xs-5 control-label">Status</label>--}}
                    {{--
                    <div class="col-xs-6">--}}
                    {{--{{switch_btn_group(['fieldName'=>'status', 'onVal'=>'Active', 'offVal'=>'Inactive'])}}--}}
                    {{--
                 </div>
                 --}}
                    {{--
                 </div>
                 --}}
                    <div class="form-group">
                        <label class="col-xs-5 control-label">Address</label>
                        <div class="col-xs-6">
                            <textarea name="address" cols="27" rows="2" minlength="10" maxlength="200">@if(!empty($data['address'])) {{$data['address']}} @endif</textarea>
                        </div>
                    </div>
                    @if($data['user_type'] == "Portal Doctor")
                        <h3 class="mT15 mB0 c3">Doctor Info</h3>
                        <hr class="w95p fL mT0" />
                        <hr class="w95p fL mT0" />
                        @if(empty($data['specialityName']))
                            <div class="form-group">
                                <label class="col-xs-5 control-label">*Doctor Category</label>
                                <div class="col-xs-6 multi-select">
                                    {{medical_specialty_drop_down($user)}}
                                </div>
                            </div>
                        @else
                            <hr class="w95p fL mT0" />
                            <span style="color: gray;">Previous Category : {{$data['specialityName']}}</span>
                            <hr class="w95p fL mT0" />
                            <div class="form-group">
                                <label class="col-xs-5 control-label">*Doctor Category</label>
                                <div class="col-xs-6 multi-select">
                                    {{medical_specialty_drop_down($user)}}
                                    <span id="error_doctor_category_id" class="field-validation-msg"></span>
                                </div>
                            </div>
                        @endif
                        {{--
                        <div class="form-group">
                           --}}
                        {{--<label class="col-xs-5 control-label asterisk">*Doctor Category</label>--}}
                        {{--
                        <div class="col-xs-6 multi-select">--}}
                        {{--{{medical_specialty_drop_down($user)}}--}}
                        {{--<span id="error_doctor_category_id" class="field-validation-msg"></span>--}}
                        {{--
                     </div>
                     --}}
                        {{--
                     </div>
                     --}}
                        @if(empty($data['code']))
                            <div class="form-group">
                                <label class="col-xs-5 control-label asterisk">Qualification</label>
                                <div class="col-xs-6 multi-select">
                                    {{qualifications_drop_down($user)}}
                                    <span id="error_doctor_category_id" class="field-validation-msg"></span>
                                </div>
                            </div>
                        @else
                            <hr class="w95p fL mT0" />
                            <span style="color: gray;">Previous Qualification : {{$data['code']}}</span>
                            <hr class="w95p fL mT0" />
                            <div class="form-group">
                                <label class="col-xs-5 control-label asterisk">Qualification</label>
                                <div class="col-xs-6 multi-select">
                                    {{qualifications_drop_down($user)}}
                                    <span id="error_doctor_category_id" class="field-validation-msg"></span>
                                </div>
                            </div>
                        @endif
                        {{--
                        <div class="form-group">
                           --}}
                        {{--<label class="col-xs-5 control-label asterisk">Qualification</label>--}}
                        {{--
                        <div class="col-xs-6 multi-select">--}}
                        {{--{{qualifications_drop_down($user)}}--}}
                        {{--<span id="error_doctor_category_id" class="field-validation-msg"></span>--}}
                        {{--
                     </div>
                     --}}
                        {{--
                     </div>
                     --}}
                        <hr class="w95p fL mT0" />
                        <br>
                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">Fee Range</label>
                            <div class="col-xs-6">
                                <div class="input-group col-xs-12">
                                    <input type="text" id="min_fee" name="min_fee" class="form-control input-sm" value="@if(!empty($data['min_fee'])){{$data['min_fee']}}@endif" placeholder="Min Fee" />
                                    <span class="input-group-btn w20 fs25 taC">-</span>
                                    <input type="text" id="max_fee" name="max_fee" class="form-control input-sm" value="@if(!empty($data['max_fee'])){{$data['max_fee']}}@endif" placeholder="Max Fee" />
                                </div>
                            </div>
                        </div>
                    @endif
                    {{--
                    <hr class="w95p fL mT0" />
                    --}}
                    {{--<br>--}}
                    {{--
                    <div class="form-group">
                       --}}
                    {{--<label class="col-xs-6 control-label asterisk mB15">Days & Time</label>--}}
                    {{--
                    <div class="col-xs-6 control-label asterisk mB15">--}}
                    {{--<button type="button" class="btn btn-info btn-sm" style="float: right" id="dayAddBtn">--}}
                    {{--<span class="glyphicon glyphicon-plus-sign"></span> Add Day--}}
                    {{--</button>--}}
                    {{--
                 </div>
                 --}}
                    {{--doctorDutyDays For Append Purpose--}}
                    {{--
                    <div id="doctorDutyDays">
                       --}}
                    {{--
                    <div id="1" name="doctorDaysData">
                       --}}
                    {{--
                    <div class="col-xs-4" >
                       --}}
                    {{--
                    <select id="dutyDays" class="myselect" name="dutyDays[0]" style="height: 35px;">
                       --}}
                    {{--
                    <option>Select Day</option>
                    --}}
                    {{--
                    <option value="Monday">Monday</option>
                    --}}
                    {{--
                    <option value="Tuesday">Tuesday</option>
                    --}}
                    {{--
                    <option value="Wednesday">Wednesday</option>
                    --}}
                    {{--
                    <option value="Thursday">Thursday</option>
                    --}}
                    {{--
                    <option value="Friday">Friday</option>
                    --}}
                    {{--
                    <option value="Saturday">Saturday</option>
                    --}}
                    {{--
                    <option value="Sunday">Sunday</option>
                    --}}
                    {{--
                 </select>
                 --}}
                    {{--
                    <div class="btn-group">--}}
                    {{--<label class="container">&nbsp;&nbsp;&nbsp;Monday--}}
                    {{--<input name="monday" type="checkbox" value="monday">--}}
                    {{--<span class="checkmark"></span>--}}
                    {{--</label>
                 </div>
                 --}}
                    {{--
                 </div>
                 --}}
                    {{--<br>--}}
                    {{--
                    <div class="col-xs-5 mB15">
                       --}}
                    {{--
                    <div class="input-group col-xs-12">--}}
                    {{--<span class="input-group-btn w20 fs25 taC">-</span>--}}
                    {{--<input type="text" id="start_time" name="start_time[0]" class="form-control input-sm" value="" placeholder="Start" />--}}
                    {{--<span class="input-group-btn w20 fs25 taC">-</span>--}}
                    {{--<input type="text" id="end_time" name="end_time[0]" class="form-control input-sm" value="" placeholder="End" />--}}
                    {{--
                 </div>
                 --}}
                    {{--
                 </div>
                 --}}
                    {{--<button type="button" class="btn btn-danger" style="margin-left: 12px" onclick="deleteRow(this.parentNode.id)">Delete </button>--}}
                    {{--
                 </div>
                 --}}
                    {{--
                 </div>
                 --}}
                    {{--
                 </div>
                 --}}
                    {{--
                    <hr class="w95p fL mT0" />
                    --}}
                    {{--<br>--}}
                    {{--
                    <div class="form-group">
                       --}}
                    {{--<label class="col-xs-5 control-label asterisk">*Estimated Time Slot</label>--}}
                    {{--
                    <div class="col-xs-6">--}}
                    {{--<input type="number" id="slot_time" name="slot_time" required="true" value="" class="form-control" placeholder="Time Minut">--}}
                    {{--<span id="error_doctor_category_id" class="field-validation-msg"></span>--}}
                    {{--
                 </div>
                 --}}
                    {{--
                 </div>
                 --}}
                </section>
                {{--Profile Image--}}
                <section class="form-Section col-md-6
                      @if($data['user_type'] == "Portal Doctor")
                        h750
                        @else
                        h650
                        @endif
                        fL">
                    <div class="container w100p">
                        <h3 class="mT15 mB0 c3">Profile Photo</h3>
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
                                <div class="btn-group">
                                    @if(!empty($data['photo']))
                                        <div class="btn-group">
                               <span id="existImage"><span style="text-align: center;"><strong>Used Image</strong></span><br>
                            <img src="{{asset($data['photo'])}}" width="300px" ><br>
                                </span>
                                    <p><input class="btn btn-raised btn-sm btn-1" type="button" id="imageCheck" value="Chose New Image">
                                    </p></div>
                                {{-----------------------}}
                                @endif

                                {{--<div class="btn-group pull-right">--}}
                                    {{--<input type="file" class="btn-group pull-right" name="image" required />--}}
                                {{--</div>--}}

                                <div class="noneClass" id="newImage"
                                     @if(!empty($data['photo']))
                                     style="display: none"
                                        @endif
                                >
                                    <p class="pull-left"><strong>Select New Image</strong>
                                    <input type="file" class="btn-group w100p form-control" name="image"
                                           @if(empty($data['photo']))
                                           required
                                            @endif
                                    /></p>
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
                        @if($data['user_type'] == "Portal Doctor")
                            <hr class="w95p fL mT0" />
                            <h3 class="mT15 mB0 c3">Experience</h3>
                            <div class="imageupload panel panel-default">
                                <div class="panel-heading clearfix">
                                    <textarea name="experience" class="w100p" rows="4" minlength="10" maxlength="1000">@if(!empty($data['experience'])){{$data['experience']}}@endif</textarea>
                                </div>
                            </div>
                            <h3 class="mT15 mB0 c3">Professional Affiliations</h3>
                            <div class="imageupload panel panel-default">
                                <div class="panel-heading clearfix">
                                    <textarea name="affiliation" class="w100p" rows="4" minlength="10" maxlength="1000">@if(!empty($data['doctorAffiliation'])){{$data['doctorAffiliation']}}@endif</textarea>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
                {{--Image END--}}
                <div class="col-xs-12 taR pR0 mT20">
                    <input type="submit" id="registerDoctor" name="registerDoctor" value="Submit" class="submit" />
                    <input type="button" id="cancel" value="Skip" class="submit" novalidate
                           @if(Auth::user()->user_type == "Portal Doctor")
                           onclick="goTo('{{route("login")}}')"
                           @@else
                           onclick="goTo('{{URL("/")}}')"
                            @endif
                    />
                </div>
            </form>
        </div>
    </div>
    {{--{{ Form::close() }}--}}
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/articleListScript.js') }}"></script>
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
    <script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>
    <script src="{{asset('js/view-pages/doctors/DoctorsForm.js')}}"></script>
    <script src="{{asset('js/DoctorsInfo.js')}}"></script>
    <script>

        {{--$(document).ready(function() {--}}
        {{--$(".myselect").select2();--}}
        {{--});--}}
        {{--$("#dayAddBtn").click(function(){--}}
        {{--length = $('#doctorDutyDays').children().length;--}}
        {{--if(length < 7) {--}}
        {{--var div = document.getElementsByName("doctorDaysData")[0];--}}
        {{--clone = div.cloneNode(true); // true means clone all childNodes and all event handlers--}}

        {{--clone.id = "" + (++i);--}}
        {{--clone.querySelector('#dutyDays').setAttribute('name', 'dutyDays[' + i+']');--}}
        {{--clone.querySelector('#start_time').setAttribute('name', 'start_time[' + i+']');--}}
        {{--clone.querySelector('#end_time').setAttribute('name', 'end_time[' + i+']');--}}
        {{--////    clone.querySelector('#start_time').setAttribute('id','1');--}}
        {{--clone.querySelector('#dutyDays').setAttribute('id', 'dutyDays' + i );--}}
        {{--clone.querySelector('#start_time').setAttribute('id', 'start_time' + i );--}}
        {{--clone.querySelector('#end_time').setAttribute('id', 'end_time' + i);--}}
        {{--document.getElementById("doctorDutyDays").appendChild(clone);--}}

        {{--}--}}
        {{--});--}}

        {{--function deleteRow(id) {--}}
        {{--if(id!==1)--}}
        {{--document.getElementById(id).remove();--}}

        {{--}--}}

        {{--//                var photoInitialPreview = '';--}}

        {{--@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)--}}
        {{--photoInitialPreview = "{{asset('images/profile-dumy.png')}}";--}}
        {{--@else--}}
        {{--photoInitialPreview = "{{get_profile_photo_url($doctor->user->photo)}}";--}}
        {{--@endif--}}
        {{--$(document).ready(function(){--}}
        {{--//***For gender Radio Selection--}}
        {{--$('.btn.btn-primary-2.gender').click(function(){--}}
        {{--setRadioValInHidden('gender',$(this));--}}
        {{--});--}}

        {{--var options = {--}}
        {{--saveCloseUrl: "{{route('doctors.index')}}",--}
        {{--photoUploadUrl: "{{route('uploadProfilePic')}}",--}}
        {{--photoInitialPreview :[--}}
        {{--photoInitialPreview--}}
        {{--]--}}

        {{--};--}}
        {{--var doctorsForm = new DoctorsForm(window,document,options);--}}
        {{--doctorsForm.initializeAll();--}}
        {{--});--}}
    </script>
@stop
@endsection
@endsection