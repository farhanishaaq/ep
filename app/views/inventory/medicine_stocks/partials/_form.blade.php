<style type="text/css">
    .hide {
        display: none;
    }
</style>

@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
    {{ Form::open(array('action' => 'medicineStocks.store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm','novalidate')) }}
@elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
    DDD
@endif
<h3 class="mT10 mB0 c3">Create Medicine Stock Form</h3>
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
                <h3 class="mT15 mB0 c3">Medicine Stock Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Medicine*:</label>
                    <div class="col-xs-6">
                        {{single_medicine_drop_down()}}
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Location:</label>
                    <div class="col-xs-6">
                        {{medicine_location_drop_down()}}
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Quantity*:</label>
                    <div class="col-xs-6">
                        <input type="text" id="quantity" name="quantity" class="form-control col-xs-3" value="" placeholder="Stock quantity">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Minimum Qty:</label>
                    <div class="col-xs-6">
                        <input type="text" id="minimum_quantity" name="minimum_quantity" class="form-control col-xs-3" value="{{{ Form::getValueAttribute('minimum_quantity', 10) }}}" placeholder="Minimum quantity">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

            </div>

        </section>





<div class="col-xs-12 taR pR0 mT20">
    <input type="reset" id="reset" value="Reset" class="submit" />
    <input type="submit" id="saveClose" name="saveClose" value="Save and Close" class="submit" />
    <input type="submit" id="saveContinue" name="saveContinue" value="Save and Continue" class="submit" />
    <input type="submit" id="cancel" value="Cancel" class="submit" onclick="goTo('{{route("medicineStocks.index")}}')" />
</div>
{{ Form::close() }}



@section('scripts')

    <script src="{{asset('js/view-pages/inventory/medicine_stocks/MedicineStockForm.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            var options = {
                saveCloseUrl: "{{route('medicineStocks.index')}}",
                formMode: '{{$formMode}}'
            };

            var medicineStockForm = new MedicineStockForm(window,document,options);
            medicineStockForm.initializeAll();
        });
    </script>

@stop
