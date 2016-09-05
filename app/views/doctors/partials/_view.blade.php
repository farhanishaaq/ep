        <h3 class="mT10 mB15 c3 bdrB1">Patient Form<p class="col-xs-3 fR taR p0 required-hint pT10">Required Fields <kbd>*</kbd></p></h3>
        <section class="form-Section col-md-6 h600 fL">
            {{--Contact Info--}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Basic Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />
                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*Username</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->username }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*Email</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->email }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">First Name</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->fname }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Last Name</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->lname }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Date of Birth</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->dob }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Gender</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->gender }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">CNIC</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->cnic }}</label>
                    </div>
                </div>

            </div>


        </section>
        <section class="form-Section col-md-6 h600 fL">
            {{--Patient Contact Info & Photo --}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Patient Contact Info & Photo</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group profile-photo file-input">
                    <img src="{{get_profile_photo_url($doctor->user->photo)}}" class="w200 fR">
                    <div class="clrB"></div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Address</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->address }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">City</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ isset($doctor->user->city) ? $doctor->user->city->name : null  }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Cell</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->cell  }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Phone</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->phone  }}</label>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Additional Info</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $doctor->user->additional_info  }}</label>
                    </div>
                </div>

            </div>
        </section>
        <div class="col-xs-12 taR pR0 mT20">
            <input type="button" id="cancel" value="Go Back" onclick="goTo('{{URL::previous()}}')" />
        </div>