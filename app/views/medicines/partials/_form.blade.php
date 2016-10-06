
<style type="text/css">
    .hide {
        display: none;
    }
</style>
@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
    {{ Form::open(array('action' => 'MedicinesController@store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm', 'novalidate')) }}
@elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
    DDD
@endif
<h3 class="mT10 mB0 c3">Medicine Form</h3>
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


{{-- Enter Medicine info --}}
<section class="form-Section col-md-12 h300 fL">
    <div class="container w100p ">
        <h3 class="mT15 mB0 c3">Enter Medicine Info:</h3>
        <hr class="w95p fL mT0" />
        <hr class="w95p fL mT0" />


        <div class="form-group col-xs-12">
            <label class="col-xs-5 control-label asterisk">Medicine Name:*</label>
            <div class="col-xs-4">
                <input type="text" id="medicine_name" name="name"  value="{{{ Form::getValueAttribute('medicine_name', null) }}}" class="form-control" placeholder="Medicine Name" required="required">
                <span id="error_refill" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group col-xs-12">
            <label class="col-xs-5 control-label asterisk">Description:</label>
            <div class="col-xs-4">
                <textarea type="text" id="description" name="description" rows="2" cols="20" class="form-control" placeholder="Description">{{{ Form::getValueAttribute('medicine_description', null) }}}</textarea>
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>



    </div>
</section>




<div class="col-xs-12 taR pR0 mT20">
    <input type="reset" id="reset" value="Reset" class="submit" />
    <input type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit" />
    <input type="submit" id="saveContinue" name="saveContinue" value="Save and Continue" class="submit" />
    <input type="button" id="cancel" value="Cancel" class="submit" onclick="goTo('{{route("medicines.index")}}')" />
</div>
{{ Form::close() }}


@section('scripts')

    <script src="{{asset('js/view-pages/medicines/MedicineForm.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var options = {
                saveCloseUrl: "{{route('medicines.index')}}",
                formMode: '{{$formMode}}'
            };

            var medicineForm = new MedicineForm(window,document,options);
            medicineForm.initializeAll();
        });
    </script>
@stop


