        <h3 class="mT10 mB0 c3">User View</h3>
        <hr class="w95p fL mT0" />
        <p class="col-xs-12 fL taR"></p>
        <section class="form-Section col-md-6 h1000 fL">
            {{--User Login Info--}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">User Login Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*User Type</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->user_type }}</label>
                    </div>
                </div>
                @if(Auth::user()->user_type == \App\Globals\GlobalsConst::SUPER_ADMIN)
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Company</label>
                        <div class="col-xs-6">
                            <label class="form-control">{{ $user->company->name }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Business Unit</label>
                        <div class="col-xs-6">
                            <label class="form-control">{{ $user->businessUnit->name }}</label>
                        </div>
                    </div>
                @elseif(Auth::user()->user_type == \App\Globals\GlobalsConst::ADMIN)
                    <div class="form-group">
                        <label class="col-xs-5 control-label asterisk">*Business Unit</label>
                        <div class="col-xs-6">
                            <label class="form-control">{{ $user->businessUnit->name }}</label>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*Username</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->username }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">*Email</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->email }}</label>
                    </div>
                </div>
            </div>

            {{--User Contact Info--}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Contact Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Mobile</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->cell }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Phone</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->phone }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">City</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ ($user->city) ? $user->city->name : '' }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Address</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->address }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Additional Info</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->additional_info }}</label>
                    </div>
                </div>

            </div>

            {{--User Job Info--}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Job Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Joining Date</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->joining_date }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Quite Date</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->quite_date }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Joining Salary</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->joiningd_date }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Current Salary</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->current_salary }}</label>
                    </div>
                </div>

            </div>


        </section>
        <section class="form-Section col-md-6 h1000 fL">
            {{--User Profile Info --}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">User Profile Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group profile-photo file-input">
                    <img src="{{get_profile_photo_url($user->photo)}}" class="w200 fR">
                    <div class="clrB"></div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">First Name</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->fname }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">Last Name</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->lname }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Gender</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->gender }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Date of Birth</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->dob }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label">Status</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->status }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-5 control-label asterisk">CNIC</label>
                    <div class="col-xs-6">
                        <label class="form-control">{{ $user->cinc }}</label>
                    </div>
                </div>

            </div>

            {{--Doctor Info --}}
            @if($user->user_type == \App\Globals\GlobalsConst::DOCTOR)
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Doctor Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group">
                    <label class="col-xs-5 control-label">Doctor Category</label>
                    <div class="col-xs-6 multi-select">
                        <label class="form-control multi-select-lbl">{{ get_collection_col_as_str($user->doctor->medicalSpecialties) }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-5 control-label">Qualification</label>
                    <div class="col-xs-6 multi-select">
                        <label class="form-control multi-select-lbl">{{get_collection_col_as_str($user->doctor->qualifications,'code')}}</label>
                    </div>
                </div>
                <div class="form-group clrB">
                    <label class="col-xs-5 control-label asterisk">Fee Range</label>
                    <div class="col-xs-6">
                        <div class="input-group col-xs-12">
                            <label class="form-control multi-select-lbl">{{$user->doctor->min_fee}}</label>
                            <span class="input-group-btn w20 fs25 taC">-</span>
                            <label class="form-control multi-select-lbl">{{$user->doctor->max_fee}}</label>
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </section>
        <div class="col-xs-12 taR pR0 mT20">
            <input type="button" id="cancel" value="Go Back" onclick="goTo('{{URL::previous()}}')" />
        </div>
