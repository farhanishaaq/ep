        <?php $userTypePatient = isset($userTypePatient) ? $userTypePatient : '' ?>
        @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
            {{ Form::open(array('action' => 'UsersController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm', 'name' => 'regForm', 'enctype' => 'multipart/form-data', 'novalidate')) }}
        @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
            {{Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put' , 'class' => "form-horizontal w100p ", 'id' => 'regForm'])}}
        @endif
        <h3 class="mT10 mB15 c3 bdrB1">User Form<p class="col-xs-3 fR taR p0 required-hint pT10">Required Fields <kbd>*</kbd></p></h3>
        {{--<hr class="w95p fL mT0" />--}}

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
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#userLoginInfoTab" aria-controls="userLoginInfoTab" role="tab" data-toggle="tab">User Login Info</a></li>
            <li role="presentation"><a href="#userProfileInfoTab" aria-controls="userProfileInfoTab" role="tab" data-toggle="tab">User Profile Info</a></li>
            <li role="presentation"><a href="#contactJobInfoTab" aria-controls="contactJobInfoTab" role="tab" data-toggle="tab">Contact & Job Info</a></li>
            <li id="doctorInfoTabHead" role="presentation" class="dNi"><a href="#doctorInfoTab" aria-controls="doctorInfoTab" role="tab" data-toggle="tab">Doctor Info</a></li>
            <li role="presentation" class="dNi"><a href="#patientInfoTab" aria-controls="patientInfoTab" role="tab" data-toggle="tab">Patient Info</a></li>
            <li role="presentation"><a href="#rolesPermissionsTab" aria-controls="rolesPermissionsTab" role="tab" data-toggle="tab">Roles & Permissions</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="userLoginInfoTab">
                <section class="form-Section col-md-12 h525 fL">
                    <div class="container w100p">
                        <h3 class="mT15 mB0 c3">User Login Info</h3>
                        <hr class="w95p fL mT0" />
                        <hr class="w95p fL mT0" />

                        <div class="form-group">
                            <label class="col-xs-3 control-label asterisk">*User Type</label>
                            <div class="col-xs-6">
                                {{user_type_drop_down()}}
                                <span id="error_user_type" class="field-validation-msg"></span>
                            </div>
                        </div>
                        @if(Auth::user()->user_type == \App\Globals\GlobalsConst::SUPER_ADMIN)
                            <div class="form-group">
                                <label class="col-xs-3 control-label asterisk">*Company</label>
                                <div class="col-xs-6">
                                    {{company_drop_down()}}
                                    <span id="error_company_id" class="field-validation-msg"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label asterisk">*Business Unit</label>
                                <div class="col-xs-6">
                                    {{business_unit_drop_down()}}
                                    <span id="error_business_unit_id" class="field-validation-msg"></span>
                                </div>
                            </div>
                        @elseif(Auth::user()->user_type == \App\Globals\GlobalsConst::ADMIN)
                            <div class="form-group">
                                <label class="col-xs-3 control-label asterisk">*Business Unit</label>
                                <div class="col-xs-6">
                                    {{business_unit_drop_down()}}
                                    <span id="error_business_unit_id" class="field-validation-msg"></span>
                                </div>
                            </div>
                        @endif


                        <div class="form-group">
                            <label class="col-xs-3 control-label asterisk">*Username</label>
                            <div class="col-xs-6">
                                <input type="text" id="username" name="username" required="true" value="{{{ Form::getValueAttribute('username', null) }}}" class="form-control" placeholder="Employee Name">
                                <span id="error_username" class="field-validation-msg"></span>
                            </div>
                        </div>
                        @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
                            <div class="form-group">
                                <label class="col-xs-3 control-label asterisk">*Password</label>
                                <div class="col-xs-6">
                                    <input type="password" id="password" name="password" required="true" value="{{{ Form::getValueAttribute('password', null) }}}" class="form-control" placeholder="Password">
                                    <span id="error_password" class="field-validation-msg"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-xs-3 control-label asterisk">*Confirm Password</label>
                                <div class="col-xs-6">
                                    <input type="password" id="confirm_password" name="confirm_password" required="true" value="{{{ Form::getValueAttribute('password', null) }}}" class="form-control" placeholder="Confirm Password">
                                    <span id="error_confirm_password" class="field-validation-msg"></span>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="col-xs-3 control-label asterisk">*Email</label>
                            <div class="col-xs-6">
                                <input type="email" id="email" name="email" required="true" value="{{{ Form::getValueAttribute('email', null) }}}" class="form-control" placeholder="Email">
                                <span id="error_email" class="field-validation-msg"></span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div role="tabpanel" class="tab-pane" id="userProfileInfoTab">
                <section class="form-Section col-md-6 h600 fL">
                    <div class="container w100p">
                        <h3 class="mT15 mB0 c3">User Profile Info</h3>
                        <hr class="w95p fL mT0" />
                        <hr class="w95p fL mT0" />

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
                            <label class="col-xs-5 control-label">Gender</label>
                            <div class="col-xs-6">

                                {{--                        {{radio_btn_group(array( 'Male' => 'Male', 'None' => '' , 'Female' => 'Female' ),'gender')}}--}}
                                {{radio_btn_group(array( 'Male' => 'Male', 'Female' => 'Female' ),'gender')}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">Date of Birth</label>
                            <div class="col-xs-6">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="dob" name="dob" value="{{{ get_display_date(Form::getValueAttribute('dob', null)) }}}" class="form-control" placeholder="dd-mm-yyyy" readonly="readonly">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <span id="errorPassword" class="field-validation-msg"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">Status</label>
                            <div class="col-xs-6">
                                {{switch_btn_group(['fieldName'=>'status', 'onVal'=>'Active', 'offVal'=>'Inactive'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">CNIC</label>
                            <div class="col-xs-6">
                                <input type="text" id="cnic" name="cnic" value="{{{ Form::getValueAttribute('cnic', null) }}}" class="form-control" placeholder="CNIC">
                                <span id="error_cnic" class="field-validation-msg"></span>
                            </div>
                        </div>

                    </div>
                </section>
                <section class="form-Section col-md-6 h600 fL">
                    <div class="container w100p">
                        <h3 class="mT15 mB0 c3">&nbsp;</h3>
                        <hr class="w95p fL mT0" />
                        <hr class="w95p fL mT0" />

                        <div class="form-group profile-photo file-input">
                            <label class="control-label">Profile Photo</label>
                            <input id="photo" name="photo" type="hidden">
                            <input id="userPhoto" name="userPhoto" type="file" class="file-loading" accept="image/*">
                        </div>

                    </div>
                </section>
            </div>
            <div role="tabpanel" class="tab-pane" id="contactJobInfoTab">
                <section class="form-Section col-md-6 h695 fL">
                    <div class="container w100p">
                        <h3 class="mT15 mB0 c3">Contact Info</h3>
                        <hr class="w95p fL mT0" />
                        <hr class="w95p fL mT0" />

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">Mobile</label>
                            <div class="col-xs-6">
                                <input type="text" id="cell" name="cell" value="{{{ Form::getValueAttribute('cell', null) }}}" class="form-control" placeholder="+92 301 4909125">
                                <span id="errorAddress" class="field-validation-msg"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">Phone</label>
                            <div class="col-xs-6">
                                <input type="text" id="phone" name="phone" value="{{{ Form::getValueAttribute('phone', null) }}}" class="form-control" placeholder="+92 42 36899554">
                                <span id="errorAddress" class="field-validation-msg"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">City</label>
                            <div class="col-xs-6">
                                {{city_drop_down()}}
                                <span id="error_city" class="field-validation-msg"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">Address</label>
                            <div class="col-xs-6">
                                <input type="text" id="address" name="address" value="{{{ Form::getValueAttribute('address', null) }}}" class="form-control" placeholder="Address">
                                <span id="errorAddress" class="field-validation-msg"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">Additional Info</label>
                            <div class="col-xs-6">
                                <textarea type="text" id="additional_info" name="additional_info" rows="7" cols="20" class="form-control" placeholder="Additional Info">{{{ Form::getValueAttribute('additional_info', null) }}}</textarea>
                                <span id="errorNote" class="field-validation-msg"></span>
                            </div>
                        </div>

                    </div>
                </section>
                <section class="form-Section col-md-6 h695 fL">
                    <div class="container w100p">
                        <h3 class="mT15 mB0 c3">Job Info</h3>
                        <hr class="w95p fL mT0" />
                        <hr class="w95p fL mT0" />

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">Joining Date</label>
                            <div class="col-xs-6">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="joining_date" name="joining_date" value="{{{ Form::getValueAttribute('joining_date', null) }}}" class="form-control" placeholder="dd-mm-yyyy" readonly="readonly">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <span id="errorJoiningDate" class="field-validation-msg"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">Quite Date</label>
                            <div class="col-xs-6">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="quite_date" name="quite_date" value="{{{ Form::getValueAttribute('quite_date', null) }}}" class="form-control" placeholder="dd-mm-yyyy" readonly="readonly">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <span id="errorQuiteDate" class="field-validation-msg"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">Joining Salary</label>
                            <div class="col-xs-6">
                                <input type="text" id="joining_salary" name="joining_salary" value="{{{ Form::getValueAttribute('joining_salary', null) }}}" class="form-control" placeholder="15000">
                                <span id="errorAddress" class="field-validation-msg"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label asterisk">Current Salary</label>
                            <div class="col-xs-6">
                                <input type="text" id="current_salary" name="current_salary" value="{{{ Form::getValueAttribute('current_salary', null) }}}" class="form-control" placeholder="25000">
                                <span id="errorAddress" class="field-validation-msg"></span>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
            <div role="tabpanel" class="tab-pane dNi" id="doctorInfoTab">
                <section class="form-Section col-md-12 h525 fL">
                    <div class="container w100p">
                        <h3 class="mT15 mB0 c3">Doctor Info</h3>
                        <hr class="w95p fL mT0" />
                        <hr class="w95p fL mT0" />

                        <div class="form-group">
                            <label class="col-xs-3 control-label asterisk">*Doctor Category</label>
                            <div class="col-xs-6 multi-select">
                                {{medical_specialty_drop_down($user)}}
                                <span id="error_doctor_category_id" class="field-validation-msg"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label asterisk">Qualification</label>
                            <div class="col-xs-6 multi-select">
                                {{qualifications_drop_down($user)}}
                                <span id="error_doctor_category_id" class="field-validation-msg"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label asterisk">Fee Range</label>
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
            </div>
            <div role="tabpanel" class="tab-pane dNi" id="patientInfoTab"></div>
            <div role="tabpanel" class="tab-pane" id="rolesPermissionsTab">Settings Content</div>
        </div>
        <div class="col-xs-12 taR pR0 mT20">
            <input type="reset" id="reset" value="Reset" class="submit" />
            <input type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit" />
            <input type="submit" id="saveContinue" name="saveContinue" value="Save and Continue" class="submit" />
            <input type="button" id="cancel" value="Cancel" class="submit" onclick="goTo('{{route("users.index")}}')" />
        </div>
        {{ Form::close() }}

        @section('scripts')
            <link media="all" type="text/css" rel="stylesheet" href="{{asset('plugins/file-input/css/fileinput.min.css')}}">
            <script src="{{asset('plugins/file-input/js/fileinput.min.js')}}"></script>
            <script src="{{asset('js/view-pages/users/UserForm.js')}}"></script>
            <script>
                $(document).ready(function(){
                    var options = {
                        saveCloseUrl: "{{route('users.index')}}",
                        photoUploadUrl: "{{route('uploadProfilePic')}}",
                        photoInitialPreview :[
                            "{{asset('images/profile-dumy.png')}}"
                        ],
                        formMode: '{{$formMode}}'
                    };
                    var userForm = new UserForm(window,document,options);
                    userForm.initializeAll();
                });
            </script>
        @stop