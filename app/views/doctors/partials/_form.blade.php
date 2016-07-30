        <?php
        $doctorPassword = isset($doctorPassword) ? $doctorPassword : null;
        $doctorUsername = isset($doctorUsername)?$doctorUsername:null;
        $doctorEmail = isset($doctorEmail)?$doctorEmail:null;
        ?>
        @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
            {{ Form::open(array('action' => 'DoctorsController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm','enctype' => 'multipart/form-data', 'novalidate')) }}
        @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
            {{Form::model($doctor->user, ['route' => ['doctors.update', $doctor->id], 'method' => 'put' , 'class' => "form-horizontal w100p ", 'id' => 'regForm'])}}
        @endif
        <h3 class="mT10 mB15 c3 bdrB1">Doctor Form<p class="col-xs-3 fR taR p0 required-hint pT10">Required Fields <kbd>*</kbd></p></h3>
        {{-- Start Errors Code Container Block --}}
        @if(count($errors))
        <ul class="error-container">
            <li>Solve Following Errors!</li>
            <li>
                <ul>
                    @foreach($errors->all("<li>:message</li>") as $message)
                            {{ $message }}
                    @endforeach
                </ul>
            </li>
        </ul>
        @endif
        {{-- End Errors Code Container Block --}}
        <section class="form-Section col-md-6 h850 fL">
            {{--Basic Info--}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Basic Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*Username</label>
                    <div class="col-xs-6">

                        <input type="text" id="username" name="username" required="true" value="{{{ Form::getValueAttribute('username',$doctorUsername ) }}}" class="form-control" placeholder="Username">
                        <span id="error_username" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*Email</label>
                    <div class="col-xs-6">
                        <input type="text" id="email" name="email" required="true" value="{{{ Form::getValueAttribute('email', $doctorEmail) }}}" class="form-control" placeholder="Email">
                        <span id="error_email" class="field-validation-msg"></span>
                    </div>
                </div>

                @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Password</label>
                        <div class="col-xs-6">
                            <input type="password" id="password" name="password" required="true" value="{{{ Form::getValueAttribute('password', $doctorPassword) }}}" class="form-control" placeholder="Password">
                            <span id="error_password" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">Confirm Password</label>
                        <div class="col-xs-6">
                            <input type="password" id="confirm_password" name="confirm_password" required="true" value="{{{ Form::getValueAttribute('confirm_password', $doctorPassword) }}}" class="form-control" placeholder="Confirm Password">
                            <span id="error_confirm_password" class="field-validation-msg"></span>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">First Name</label>
                    <div class="col-xs-6">
                        <input type="text" id="fname" name="fname" required="true" value="{{{ Form::getValueAttribute('fname', null) }}}" class="form-control" placeholder="First Name">
                        <span id="error_fname" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Last Name</label>
                    <div class="col-xs-6">
                        <input type="text" id="lname" name="lname" required="true" value="{{{ Form::getValueAttribute('lname', null) }}}" class="form-control" placeholder="Last Name">
                        <span id="error_lname" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Status</label>
                    <div class="col-xs-6">
                        {{switch_btn_group(['fieldName'=>'status', 'onVal'=>'Active', 'offVal'=>'Inactive'])}}
                    </div>
                </div>

            </div>

            {{--Doctor Info--}}
            <div class="container w100p">
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
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Qualification</label>
                    <div class="col-xs-6 multi-select">
                        {{qualifications_drop_down($user)}}
                        <span id="error_doctor_category_id" class="field-validation-msg"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Fee Range</label>
                    <div class="col-xs-6">
                        <div class="input-group col-xs-12">
                            <input type="text" id="min_fee" name="min_fee" class="form-control input-sm" value="{{Form::getValueAttribute('min_fee', null)}}" placeholder="Min Fee" />
                            <span class="input-group-btn w20 fs25 taC">-</span>
                            <input type="text" id="max_fee" name="max_fee" class="form-control input-sm" value="{{Form::getValueAttribute('max_fee', null)}}" placeholder="Max Fee" />
                        </div>
                    </div>
                </div>

            </div>

        </section>
        <section class="form-Section col-md-6 h850 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Doctor Photo</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group profile-photo file-input">
                    <label class="control-label">Profile Photo</label>
                    <input id="photo" name="photo" type="hidden" value="{{{ Form::getValueAttribute('photo', null) }}}">
                    <input id="userPhoto" name="userPhoto" type="file" class="file-loading" accept="image/*">
                </div>



            </div>
        </section>
        <div class="col-xs-12 taR pR0 mT20">
            <input type="reset" id="reset" value="Reset" class="submit" />
            <input type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit" />
            <input type="submit" id="saveContinue" name="saveContinue" value="Save and Continue" class="submit" />
            <input type="button" id="cancel" value="Cancel" class="submit" onclick="goTo('{{route("doctors.index")}}')" />
        </div>
        {{ Form::close() }}
        @section('scripts')
            <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
            <script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>
            <script src="{{asset('js/view-pages/doctors/DoctorsForm.js')}}"></script>
            <script>
                var photoInitialPreview = '';

                @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
                        photoInitialPreview = "{{asset('images/profile-dumy.png')}}";
                @else
                        photoInitialPreview = "{{get_profile_photo_url($doctor->user->photo)}}";
                @endif
            $(document).ready(function(){
                    //***For gender Radio Selection
                    $('.btn.btn-primary-2.gender').click(function(){
                        setRadioValInHidden('gender',$(this));
                    });

                    var options = {
                        saveCloseUrl: "{{route('users.index')}}",
                        photoUploadUrl: "{{route('uploadProfilePic')}}",
                        photoInitialPreview :[
                            photoInitialPreview
                        ],
                        formMode: '{{$formMode}}'
                    };
                    var doctorsForm = new DoctorsForm(window,document,options);
                    doctorsForm.initializeAll();
                });
            </script>
        @stop