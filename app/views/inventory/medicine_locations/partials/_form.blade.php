<style type="text/css">
    .hide {
        display: none;
    }
</style>

@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
    {{ Form::open(array('action' => 'medicineLocations.store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm','novalidate')) }}
@elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
    DDD
@endif
<h3 class="mT10 mB0 c3">Create Medicine Location Form</h3>
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


<section class="form-Section col-md-12 h300 fL">
    <div class="container w100p">
        <h3 class="mT15 mB0 c3">Medicine Location Info</h3>
        <hr class="w95p fL mT0" />
        <hr class="w95p fL mT0" />


        <div class="form-group col-xs-6">
            <label class="col-xs-5 control-label asterisk">Medicine Location*:</label>
            <div class="col-xs-6">
                <input type="text" id="name" name="name" class="form-control col-xs-3" value="" placeholder="Medicine Location">
                <span id="errorName" class="field-validation-msg"></span>
            </div>
        </div>

        <div class="form-group col-xs-6">
            <label class="col-xs-5 control-label asterisk">Description:</label>
            <div class="col-xs-6">
                <textarea type="text" id="description" name="description" rows="4" cols="20" class="form-control" placeholder="Location Description"></textarea>
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

    <script src="{{asset('js/view-pages/inventory/medicine_locations/MedicineLocationForm.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            var options = {
                saveCloseUrl: "{{route('medicineLocations.store')}}",
                formMode: '{{$formMode}}'
            };

            var medicineLocationForm = new MedicineLocationForm(window,document,options);
            medicineLocationForm.initializeAll();
        });
    </script>

@stop
