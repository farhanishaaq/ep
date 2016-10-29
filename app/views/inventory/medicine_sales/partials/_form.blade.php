<style type="text/css">
    .hide {
        display: none;
    }
</style>

@if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
    {{ Form::open(array('action' => 'medicineSales.store', 'class' =>"form-horizontal w100p ", 'id' => 'regForm','novalidate')) }}
@elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
    DDD
@endif
<h3 class="mT10 mB0 c3">Create Medicine Sale Form</h3>
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

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#medicineSaleInfoTab" area-controls="medicineSaleInfoTab" role="tab" data-toggle="tab">Medicine Sale Info</a></li>
    <li role="presentation"><a href="#medicineSaleDetailTab" area-controls="medicineSaleDetailTab" role="tab" data-toggle="tab">Medicine Sale Detail</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="medicineSaleInfoTab">
        <section class="form-Section col-md-12 h300 fL">
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Medicine Sale Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />


                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Patient Name*:</label>
                    <div class="col-xs-6">
                        {{patient_drop_down()}}
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                {{--<div class="form-group col-xs-6">--}}
                    {{--<label class="col-xs-5 control-label asterisk">Business Unit*:</label>--}}
                    {{--<div class="col-xs-6">--}}
                        {{--{{business_unit_drop_down($company_id)}}--}}
                        {{--<span id="errorName" class="field-validation-msg"></span>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Sale Code:</label>
                    <div class="col-xs-6">
                        <input type="text" id="code" name="code" required="true" value="{{ $code}}" class="form-control" placeholder="Sale Code">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-6">
                    <label class="col-xs-5 control-label asterisk">Sale Date:</label>
                    <div class="col-xs-6">
                        <input type="text" id="date" name="date" required="true" value="{{$date}}" class="form-control" placeholder="Sale date">
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>

            </div>

        </section>

    </div>
    <div role="tabpanel" class="tab-pane" id="medicineSaleDetailTab">
        <section class="form-Section col-md-12 h500 fL">
            {{-- Medicine Sale Detail --}}
            <div class="container w100p ofA h761">
                <h3 class="mT15 mB0 c3">Medicine Sale Detail</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />

                <div class="form-group mT30 list-group">
                    <a href="javascript:void(0)" class="col-xs-12 list-group-item list-group-item-action ">
                        <h3 class="col-xs-4">Medicine Sale Detail</h3>
                        <h3 class="col-xs-3 fR">
                            <div class="fL mL5">Add Detail Row</div>
                            <button class="fR btn btn-default addButton" type="button"><i class="fa fa-plus"></i></button>
                        </h3>
                    </a>
                </div>
                @include('inventory.medicine_sales.includes.detail_row')

            </div>
        </section>
    </div>
</div>




<div class="col-xs-12 taR pR0 mT20">
    <input type="reset" id="reset" value="Reset" class="submit" />
    <input type="submit" id="createClose" value="Save and Close" class="submit" />
    <input type="submit" id="createContinue" name="createContinue" value="Save and Continue" class="submit" />
    <input type="submit" id="cancel" value="Cancel" class="submit" />
</div>
{{ Form::close() }}



@section('scripts')

    <script src="{{asset('js/view-pages/inventory/medicine_sales/MedicineSaleForm.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            var options = {
                saveCloseUrl: "{{route('medicineSales.store')}}",
                formMode: '{{$formMode}}'
            };

            var medicineSaleForm = new MedicineSaleForm(window,document,options);
            medicineSaleForm.initializeAll();
        });
    </script>

@stop
