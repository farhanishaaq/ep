        <?php
        $patientPassword = isset($patientPassword) ? $patientPassword : null;
        $patientUsername = isset($patientUsername)?$patientUsername:null;
        $patientEmail = isset($patientEmail)?$patientEmail:null;

        ?>
        @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
            {{ Form::open(array('action' => 'PatientsController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm','enctype' => 'multipart/form-data', 'novalidate')) }}
        @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
            {{Form::model($patient->user, ['route' => ['patients.update', $patient->id], 'method' => 'put' , 'class' => "form-horizontal w100p ", 'id' => 'regForm'])}}
        @endif
        <h3 class="mT10 mB15 c3 bdrB1">Patient Form<p class="col-xs-3 fR taR p0 required-hint pT10">Required Fields <kbd>*</kbd></p></h3>
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

        {{-- making tabs --}}
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#patientInfoTab" area-controls="patientInfoTab" role="tab" data-toggle="tab">Patient Info</a></li>
        </ul>


        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="patientInfoTab">
        <section class="form-Section col-md-6 h1315 fL">
            {{--Contact Info--}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Basic Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*Username</label>
                    <div class="col-xs-6">

                        <input type="text" id="username" name="username" required="true" value="{{{ Form::getValueAttribute('username',$patientUsername ) }}}" class="form-control" placeholder="Username">
                        <span id="error_username" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*Email</label>
                    <div class="col-xs-6">
                        <input type="text" id="email" name="email" required="true" value="{{{ Form::getValueAttribute('email', $patientEmail) }}}" class="form-control" placeholder="Email">
                        <span id="error_email" class="field-validation-msg"></span>
                    </div>
                </div>

                @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Password</label>
                        <div class="col-xs-6">
                            <input type="password" id="password" name="password" required="true" value="{{{ Form::getValueAttribute('password', $patientPassword) }}}" class="form-control" placeholder="Password">
                            <span id="error_password" class="field-validation-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Confirm Password</label>
                        <div class="col-xs-6">
                            <input type="password" id="confirm_password" name="confirm_password" required="true" value="{{{ Form::getValueAttribute('confirm_password', $patientPassword) }}}" class="form-control" placeholder="Confirm Password">
                            <span id="error_confirm_password" class="field-validation-msg"></span>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*First Name</label>
                    <div class="col-xs-6">
                        <input type="text" id="fname" name="fname" required="true" value="{{{ Form::getValueAttribute('fname', null) }}}" class="form-control" placeholder="First Name">
                        <span id="error_fname" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*Last Name</label>
                    <div class="col-xs-6">
                        <input type="text" id="lname" name="lname" required="true" value="{{{ Form::getValueAttribute('lname', null) }}}" class="form-control" placeholder="Last Name">
                        <span id="error_lname" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Date of Birth</label>
                    <div class="col-xs-6">
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" id="dob" name="dob" value="{{{ get_display_date(Form::getValueAttribute('dob', null)) }}}" readonly >
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>

                        <span id="error_dob" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Age</label>
                    <div class="col-xs-6">
                        <input type="text" id="age" name="age" required="true" value="{{{ Form::getValueAttribute('age', null) }}}" class="form-control" placeholder="Age">
                        <span id="error_age" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Gender</label>
                    <div class="col-xs-6">
                        {{radio_btn_group(array( 'Male' => 'Male', 'Female' => 'Female' ),'gender')}}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">CNIC</label>
                    <div class="col-xs-6">
                        <input type="text" id="cnic" name="cnic" value="{{{ Form::getValueAttribute('cnic', null) }}}" class="form-control" placeholder="cnic">
                        <span id="error_cnic" class="field-validation-msg"></span>
                    </div>
                </div>

            </div>

            {{--Contact Info--}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Contact Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />



                <div class="form-group">
                    <label class="col-xs-5 control-label">Address</label>
                    <div class="col-xs-6">
                        <input type="text" id="address" name="address" value="{{{ Form::getValueAttribute('address', null) }}}" class="form-control" placeholder="Address">
                        <span id="error_address" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">City</label>
                    <div class="col-xs-6">
                        {{city_drop_down()}}
                        <span id="error_city_id" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Cell</label>
                    <div class="col-xs-6">
                        <input type="text" id="cell" name="cell" value="{{{ Form::getValueAttribute('cell', null) }}}" class="form-control" placeholder="Cell No">
                        <span id="error_cell" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Phone</label>
                    <div class="col-xs-6">
                        <input type="text" id="phone" name="phone" value="{{{ Form::getValueAttribute('phone', null) }}}" class="form-control" placeholder="Phone No">
                        <span id="error_phone" class="field-validation-msg"></span>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Additional Info</label>
                    <div class="col-xs-6">
                        <textarea type="text" id="additional_info" name="additional_info" rows="7" cols="20" class="form-control" placeholder="note">{{{ Form::getValueAttribute('note', null) }}}</textarea>
                        <span id="errorNote" class="field-validation-msg"></span>
                    </div>
                </div>

            </div>
        </section>
        <section class="form-Section col-md-6 h1315 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Patient Photo</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group profile-photo file-input">
                    <label class="control-label">Profile Photo</label>
                    <input id="photo" name="photo" type="hidden" value="{{{ Form::getValueAttribute('photo', null) }}}">
                    <input id="userPhoto" name="userPhoto" type="file" class="file-loading" accept="image/*">
                </div>



            </div>
        </section>
        </div>
     </div>

        <div class="col-xs-12 taR pR0 mT20">
            <input type="reset" id="reset" value="Reset" class="submit" />
            <input type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit" />
            <input type="submit" id="saveContinue" name="saveContinue" value="Save and Continue" class="submit" />
            <input type="button" id="cancel" value="Cancel" class="submit" onclick="goTo('{{route("patients.index")}}')" />
        </div>
        {{ Form::close() }}
        @section('scripts')
            <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
            <script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>
            <script src="{{asset('js/view-pages/patients/PatientsForm.js')}}"></script>
            <script>
                var photoInitialPreview = '';

                @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
                        photoInitialPreview = "{{asset('images/profile-dumy.png')}}";
                @else
                        photoInitialPreview = "{{get_profile_photo_url($patient->user->photo)}}";
                @endif
            $(document).ready(function(){
                    //***For gender Radio Selection
                    $('.btn.btn-primary-2.gender').click(function(){
                        setRadioValInHidden('gender',$(this));
                    });

                    var options = {
                        saveCloseUrl: "{{route('patients.index')}}",
                        photoUploadUrl: "{{route('uploadProfilePic')}}",
                        photoInitialPreview :[
                            photoInitialPreview
                        ],
                        formMode: '{{$formMode}}'
                    };
                    var patientsForm = new PatientsForm(window,document,options);
                    patientsForm.initializeAll();
                });
            </script>
        @stop