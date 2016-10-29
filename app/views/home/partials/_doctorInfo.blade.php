@if($DoctorDutyAndFeeInfos)
    @if($DoctorDutyAndFeeInfos->count())

        @foreach($DoctorDutyAndFeeInfos as $k=>$dd)
            @if($k == \App\Globals\GlobalsConst::ZERO_INDEX)
                <div class="form-group mB0">
                    <label class="col-xs-4 control-label fs12">Fee Range</label>
                    <div class="col-xs-8">
                        <label  class="form-control">{{$dd->min_fee}} - {{$dd->max_fee}}</label>
                        <span id="error_paid_fee" class="field-validation-msg"></span>
                    </div>
                </div>
            @endif
            <div class="form-group mB0">
                <label class="col-xs-4 control-label fs12">{{$dd->day}}</label>
                <div class="col-xs-8">
                    <label  class="form-control">{{$dd->start}} to {{$dd->end}}</label>
                    <span id="error_paid_fee" class="field-validation-msg"></span>
                </div>
            </div>
        @endforeach
    @else
        <h4>There is no info found for this doctor</h4>
    @endif
@else
    <h3>There is no info found for this doctor</h3>
@endif