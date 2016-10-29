<style type="text/css">
    .hide {
        display: none;
    }
</style>

@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
    {{ Form::open(array('action' => 'medicineMenufacturers.store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm','novalidate')) }}
@elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
    DDD
@endif
<h3 class="mT10 mB0 c3">Create Medicine Manufacturer Form</h3>
<hr class="w95p fL mT0" />
<p class="col-xs-12 fL taR">Required Fields <kbd>*</kbd></p>
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


<section class="form-Section col-md-12 h350 fL">
    <div class="container w100p">
        <h3 class="mT15 mB0 c3">Medicine Manufacturer Info</h3>
        <hr class="w95p fL mT0" />
        <hr class="w95p fL mT0" />


        <div class="form-group col-xs-6">
            <label class="col-xs-5 control-label asterisk">Name*:</label>
            <div class="col-xs-6">
                <input type="text" id="name" name="name" required="true" value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control" placeholder="Manufacturer Name">
                <span id="error_name" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group col-xs-6">
            <label class="col-xs-3 control-label asterisk">Email:</label>
            <div class="col-xs-6">
                <input type="email" id="email" name="email" required="true" value="{{{ Form::getValueAttribute('email', null) }}}" class="form-control" placeholder="Email">
                <span id="error_email" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group col-xs-6">
            <label class="col-xs-5 control-label">Address</label>
            <div class="col-xs-6">
                <input type="text" id="address" name="address" value="{{{ Form::getValueAttribute('address', null) }}}" class="form-control" placeholder="Address">
                <span id="error_address" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group col-xs-6">
            <label class="col-xs-3 control-label asterisk">Cell</label>
            <div class="col-xs-6">
                <input type="text" id="cell" name="cell" value="{{{ Form::getValueAttribute('cell', null) }}}" class="form-control" placeholder="Cell No">
                <span id="error_cell" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group col-xs-6">
            <label class="col-xs-5 control-label asterisk">Phone</label>
            <div class="col-xs-6">
                <input type="text" id="phone" name="phone" value="{{{ Form::getValueAttribute('phone', null) }}}" class="form-control" placeholder="Phone No">
                <span id="error_phone" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group col-xs-6">
            <label class="col-xs-3 control-label asterisk">Description:</label>
            <div class="col-xs-6">
                <textarea type="text" id="description" name="description" rows="4" cols="20" class="form-control" placeholder="Description"></textarea>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

    </div>

</section>





<div class="col-xs-12 taR pR0 mT20">
    <input type="reset" id="reset" value="Reset" class="submit" />
    <input type="submit" id="createClose" value="Save and Close" class="submit" />
    <input type="submit" id="createContinue" name="createContinue" value="Save and Continue" class="submit" />
    <input type="submit" id="cancel" value="Cancel" class="submit" />
</div>
{{ Form::close() }}



@section('scripts')

    <script src="{{asset('js/view-pages/inventory/medicine_menufacturers/MedicineMenufacturerForm.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            var options = {
                saveCloseUrl: "{{route('medicineMenufacturers.store')}}",
                formMode: '{{$formMode}}'
            };

            var medicineMenufacturerForm = new MedicineMenufacturerForm(window,document,options);
            medicineMenufacturerForm.initializeAll();
        });
    </script>

@stop
