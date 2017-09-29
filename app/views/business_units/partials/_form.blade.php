@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
    {{ Form::open(array('action' => 'BusinessUnitsController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm','enctype' => 'multipart/form-data', 'novalidate')) }}
@elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
    {{Form::model($company, ['route' => ['businessUnits.update', $company->id], 'method' => 'put' , 'class' => "form-horizontal w100p ", 'id' => 'regForm'])}}
@endif
<h3 class="mT10 mB15 c3 bdrB1">Regastration Form<p class="col-xs-3 fR taR p0 required-hint pT10">Required Fields <kbd>*</kbd></p></h3>
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
<section class="form-Section col-md-6 h1000 fL">
    {{-- Comapny Basic Info --}}
    {{--<div class="container w100p">--}}
        {{--<h3 class="mT15 mB0 c3">Company Basic Info</h3>--}}
        {{--<hr class="w95p fL mT0" />--}}
        {{--<hr class="w95p fL mT0" />--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-xs-5 control-label asterisk">Name</label>--}}
            {{--<div class="col-xs-6">--}}
                {{--<input type="text" id="name" name="name" required="true" value="{{{ Form::getValueAttribute('name', null ) }}}" class="form-control" placeholder="name">--}}
                {{--<span id="errorName" class="field-validation-msg"></span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-xs-5 control-label asterisk">Select Type</label>--}}
            {{--<div class="col-xs-6">--}}
                {{--{{ make_company_type_drop_down() }}--}}
                {{--<span id="error_company_type" class="field-validation-msg"></span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-xs-5 control-label asterisk">Address</label>--}}
            {{--<div class="col-xs-6">--}}
                {{--<input type="text" id="address" name="address" value="{{{ Form::getValueAttribute('address', null ) }}}" class="form-control" placeholder="Address">--}}
                {{--<span id="errorName" class="field-validation-msg"></span>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<label class="col-xs-5 control-label asterisk">City</label>--}}
            {{--<div class="col-xs-6">--}}
                {{--{{city_drop_down()}}--}}
                {{--<span id="errorName" class="field-validation-msg"></span>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<label class="col-xs-5 control-label asterisk">Phone</label>--}}
            {{--<div class="col-xs-6">--}}
                {{--<input type="text" id="phone" name="phone" required="true" value="{{{ Form::getValueAttribute('phone', null ) }}}" class="form-control" placeholder="Phone">--}}
                {{--<span id="error_lname" class="field-validation-msg"></span>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<label class="col-xs-5 control-label asterisk">Fax</label>--}}
            {{--<div class="col-xs-6">--}}
                {{--<input type="text" id="fax" name="fax" required="true" value="{{{ Form::getValueAttribute('fax', null ) }}}" class="form-control" placeholder="Fax">--}}
                {{--<span id="error_lname" class="field-validation-msg"></span>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<label class="col-xs-5 control-label asterisk">Description</label>--}}
            {{--<div class="col-xs-6 hAi">--}}
                {{--<textarea id="description" name="description" class="form-control" rows="7" cols="20" placeholder="description">{{{ Form::getValueAttribute('description', null) }}}</textarea>--}}
                {{--<span id="errorName" class="field-validation-msg"></span>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{-- Business Unit Basic Info --}}
    <div class="container w100p">
        <h3 class="mT15 mB0 c3">Business Unit Basic Info</h3>
        <hr class="w95p fL mT0" />
        <hr class="w95p fL mT0" />
        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">BU Name</label>
            <div class="col-xs-6">
                <input type="text" id="bu_name" name="bu_name" required="true" value="{{{ Form::getValueAttribute('bu_name', null ) }}}" class="form-control" placeholder="name">
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Address</label>
            <div class="col-xs-6">
                <input type="text" id="address" name="address" value="{{{ Form::getValueAttribute('address', null ) }}}" class="form-control" placeholder="Address">
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">City</label>
            <div class="col-xs-6">
                {{city_drop_down()}}
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Phone</label>
            <div class="col-xs-6">
                <input type="text" id="phone" name="phone" required="true" value="{{{ Form::getValueAttribute('phone', null ) }}}" class="form-control" placeholder="Phone">
                <span id="error_lname" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Fax</label>
            <div class="col-xs-6">
                <input type="text" id="fax" name="fax" required="true" value="{{{ Form::getValueAttribute('fax', null ) }}}" class="form-control" placeholder="Fax">
                <span id="error_lname" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Description</label>
            <div class="col-xs-6 hAi">
                <textarea id="bu_description" name="bu_description" class="form-control" rows="7" cols="20" placeholder="description">{{{ Form::getValueAttribute('bu_description', null) }}}</textarea>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>
    </div>
</section>
<section class="form-Section col-md-6 h1000 fL">
    {{-- User Basic Info --}}
    <div class="container w100p">
        <h3 class="mT15 mB0 c3">Business Unit Admin LogIn Info</h3>
        <hr class="w95p fL mT0" />
        <hr class="w95p fL mT0" />
        <div class="form-group">
            <label class="col-xs-4 control-label asterisk">Username</label>
            <div class="col-xs-6">
                <input type="text" id="username" name="username" required="true" value="{{{ Form::getValueAttribute('username', null ) }}}" class="form-control" placeholder="Username">
                <span id="error_username" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 control-label asterisk">Email</label>
            <div class="col-xs-6">
                <input type="text" id="email" name="email" required="true" value="{{{ Form::getValueAttribute('username', null ) }}}" class="form-control" placeholder="Username">
                <span id="error_email" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 control-label asterisk">Password</label>
            <div class="col-xs-6">
                <input type="password" id="password" name="password" required="true" value="{{{ Form::getValueAttribute('password', null ) }}}" class="form-control" placeholder="Password">
                <span id="error_password" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 control-label asterisk">Confirm Pass</label>
            <div class="col-xs-6">
                <input type="password" id="confirm_password" name="confirm_password" required="true" value="{{{ Form::getValueAttribute('confirm_password', null ) }}}" class="form-control" placeholder="Confirm Password">
                <span id="error_confirm_password" class="field-validation-msg"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 control-label asterisk">First Name</label>
            <div class="col-xs-6">
                <input type="text" id="fname" name="fname" required="true" value="{{{ Form::getValueAttribute('fname', null ) }}}" class="form-control" placeholder="First Name">
                <span id="error_fname" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 control-label asterisk">Last Name</label>
            <div class="col-xs-6">
                <input type="text" id="lname" name="lname" required="true" value="{{{ Form::getValueAttribute('lname', null ) }}}" class="form-control" placeholder="Last Name">
                <span id="error_lname" class="field-validation-msg"></span>
            </div>
        </div>

    </div>

</section>
<div class="col-xs-12 taR pR0 mT20">
    {{--<input type="reset" id="reset" value="Reset" class="submit" />--}}
    <input type="submit" id="saveClose" value="Save && Close" class="submit" />
    <input type="submit" id="saveContinue" value="Save && Continue" class="submit" />
    <input type="button" id="cancel" name="cancel" value="Cancel" class="submit" onclick="goTo('{{route("businessUnits.index")}}')" />
</div>
{{ Form::close() }}
@section('scripts')
    <link rel="stylesheet" href="{{asset('plugins/calendar/css/fullcalendar.min.css')}}" type="text/css">
    <script src="{{asset('plugins/calendar/js/fullcalendar.min.js')}}"></script>
    <script src="{{asset('js/view-pages/companies/CompanyForm.js')}}"></script>
    <script>
        $(document).ready(function(){
            var options = {
                saveCloseUrl: "{{route('businessUnits.index')}}",
            };
            var companyForm = new CompanyForm(window,document,options);
            companyForm.initializeAll();
        });
    </script>
@stop