{{ Form::open(array('action' => 'dutyDays.store','class' => "form-horizontal w100p ", 'id' => 'dutyDaysForm')) }}
    <h3 class="mT10 mB0 c3">Add Duty Days</h3>
    <hr class="w95p fL mT0" />
    <section class="form-Section col-md-12 fL">
        <input type="hidden" id="Sunday" name="Sunday" value="{{Form::getValueAttribute('Sunday', null)}}">
        <input type="hidden" id="Monday" name="Monday" value="{{Form::getValueAttribute('Monday', null)}}">
        <input type="hidden" id="Tuesday" name="Tuesday" value="{{Form::getValueAttribute('Tuesday', null)}}">
        <input type="hidden" id="Wednesday" name="Wednesday" value="{{Form::getValueAttribute('Wednesday', null)}}">
        <input type="hidden" id="Thursday" name="Thursday" value="{{Form::getValueAttribute('Thursday', null)}}">
        <input type="hidden" id="Friday" name="Friday" value="{{Form::getValueAttribute('Friday', null)}}">
        <input type="hidden" id="Saturday" name="Saturday" value="{{Form::getValueAttribute('Saturday', null)}}">
        <div class="container w100p">
            <div class="form-group">
                <label class="col-xs-2 control-label asterisk">Select Doctors</label>
                <div class="col-xs-8">
                    {{--<label class="form-control">{{ $doctorName }}</label>--}}
                    @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
                    {{ Form::select('doctor_id', $doctors, $doctorId , ['required' => 'true', 'id' => 'doctor_id'] ); }}
                    @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
                    {{ Form::select('doctor_id', $doctors, $doctors->id , ['required' => 'true', 'id' => 'doctor_id'] ); }}
                    @endif

                    <span id="errorEmployeeId" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group">
                <div id="dutyDayCalendar" class="w90pi m0A"></div>
            </div>

        </div>
    </section>
    <div class="col-xs-12 taR pR0 mT20">
        <input type="reset" id="reset" value="Reset" class="submit" />
        <input type="button" id="saveClose" name="saveClose" value="Save and Close" class="submit" />
        <input type="button" id="cancel" value="Cancel" class="submit" onclick="goTo('{{Redirect::back()}}')" />
    </div>
{{ Form::close() }}
@section('scripts')
<link rel="stylesheet" href="{{asset('plugins/calendar/css/fullcalendar.min.css')}}" type="text/css">
<script src="{{asset('plugins/calendar/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('js/view-pages/duty_days/DutyDayForm.js')}}"></script>
{{--<script src="{{asset('plugins/day-pilot-lite/js/daypilot-all.min.js')}}"></script>--}}
<link type="text/css" rel="stylesheet" href="{{asset('plugins/day-pilot-lite/css/month_white.css')}}" />
<!-- Trigger the modal with a button -->
<button id="btnOpenModel" type="button" class="btn btn-info btn-lg dN" data-toggle="modal" data-target="#myModal"></button>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Duty Day</h4>
      </div>
      <div class="modal-body row">
        <div class="form-group">
            <label class="col-xs-3 control-label asterisk">Start Time</label>
            <div class="col-xs-8">
                <input type="text" id="startTime" name="startTime" value="" readonly>
                <span id="errorStartTime" class="field-validation-msg"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label asterisk">End Time</label>
            <div class="col-xs-8">
                <input type="text" id="endTime" name="endTime" value="">
                <span id="errorEndTime" class="field-validation-msg"></span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" name="btnSave" class="btn btn-default" >Save</button>
        <button type="button" id="btnModalClose" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
    $(document).ready(function(){
        var options = {
            saveCloseUrl: "{{route('dutyDays.index')}}",
            selectedDrId: "{{$doctorId}}",
        };
        var dutyDayForm = new DutyDayForm(window,document,options);
        dutyDayForm.initializeAll();
    });
</script>
@stop