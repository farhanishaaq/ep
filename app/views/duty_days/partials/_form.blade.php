{{ Form::open(array('action' => 'DutyDaysController@store','class' => "form-horizontal w100p ", 'id' => 'dutyDaysForm')) }}
    <h3 class="mT10 mB0 c3">Add Duty Days</h3>
    <hr class="w95p fL mT0" />
    <section class="form-Section col-md-12 fL">
        <div class="container w100p">
            <div class="form-group">
                <label class="col-xs-2 control-label asterisk">Select Doctors</label>
                <div class="col-xs-8">
                    @if($formMode == App\Globals\GlobalsConst::FORM_CREATE)
                    {{ Form::select('employee_id', $doctors->lists('name', 'id'), null , ['required' => 'true', 'id' => 'employee_id'] ); }}
                    @elseif($formMode == App\Globals\GlobalsConst::FORM_EDIT)
                    {{ Form::select('employee_id', $doctors->lists('name', 'id'), $doctors->id , ['required' => 'true', 'id' => 'employee_id'] ); }}
                    @endif

                    <span id="errorEmployeeId" class="field-validation-msg"></span>
                </div>
            </div>
            <div class="form-group">
                <div id="dutyDayCalendar" class="w90pi m0A"></div>
            </div>

        </div>
    </section>
    <div class="col-xs-10 taR pR0 mT20">
        {{--<input type="reset" id="reset" value="Reset" class="submit"/>
        <input type="submit" id="create" value="Save && Close" class="submit"/>
        <input type="submit" id="create" value="Save && Continue" class="submit"/>--}}
        <input type="button" id="btnCloseForm" value="Close" class="submit" onclick="goTo('{{route('dutyDays.index')}}')" />
    </div>
{{ Form::close() }}
@section('scripts')
<script src="{{asset('plugins/day-pilot-lite/js/daypilot-all.min.js')}}"></script>
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
    //***Start Globals
    window.selectedTimeArgsObj;
    window.wanaSave = window.NO;
    //***End Globals

    //**** For Country
    $("#employee_id").select2();

    //***OnChange of EmployeeId
    $('#employee_id').change(function(){

    });

    //**** For endTime ClockPicker
    $('#endTime').clockpicker({donetext:'Done'});

    //***Start DayPilot Calendar
    var dp = new DayPilot.Calendar("dutyDayCalendar");

    // view
    dp.startDate =  window.DP_MONDAY;  // or just dp.startDate = "2013-03-25";
    dp.viewType = "Week";

    // event creating
    dp.onTimeRangeSelected = function (args) {
//        var name = prompt("New event name:", "Event");
//        if (!name) return;
        window.selectedTimeArgsObj = args
        window.wanaSave = window.NO;
        //Trigger BS-Modal
        $('#btnOpenModel').trigger('click');

        //Set BS-Modal Form Vals
        $('#startTime').val(args.start.toString("HH:mm"));
        $('#endTime').val(args.end.toString("HH:mm"));
/*
        if($('#endTime').val() == "") return;
        var name = args.start.toString("HH:mm") + 'To' + '';
        var e = new DayPilot.Event({
                    start: args.start,
                    end: args.end,
                    id: DayPilot.guid(),
                    text: name
                });
        dp.events.add(e);*/
//        dp.clearSelection();
    };

    dp.onEventClick = function(args) {
        alert("clicked: " + args.e.id());
    };

    dp.headerDateFormat = "dddd";
    dp.eventDeleteHandling = "Update";
    dp.init();


    /*var e = new DayPilot.Event({
        start: new DayPilot.Date("2013-03-25T12:00:00"),
        end: new DayPilot.Date("2013-03-25T12:00:00").addHours(3).addMinutes(10),
        id: "1",
        text: "Special event",
        toolTip: "my tooltip"
    });*/


      /*dp.events.list = [
        {
          start: "2013-03-25T00:00:00",
          end: "2013-03-25T12:00:00",
          id: "123",
          text: "Event",
          toolTip: "my tooltip"
        }
      ]*/
//    dp.events.add(e);
    @if($formMode == App\Globals\GlobalsConst::FORM_EDIT)
    dp.events.list = JSON.parse('{{$makeDayPilotJson}}');
    /*dp.eventDeleteHandling = "Update";
    dp.onEventDelete = function(args) {
        if (!confirm("Do you really want to delete this event?")) {
          args.preventDefault();
        }
      };*/
    dp.init();
    @endif
    //***************End DayPilot Calendar

    //****BS-Modal Show Event
    $('#myModal').on('show.bs.modal', function () {
//        $('#endDate').val('');
    });

    //****BS-Modal Close Event
    $('#myModal').on('hidden.bs.modal', function () {
        var args = window.selectedTimeArgsObj;
        //Set BS-Modal Form Vals
        var endDate = $('#endTime');
        $('#startTime').val(args.start.toString("HH:mm"));

        console.log(args.start.toString("yyyy-MM-ddTHH:mm:ss"));
        if($('#endTime').val() == "") return;
        var name = args.start.toString("HH:mm") + ' To ' + $('#endTime').val();
        var makeEndDateTime = args.start.toString("yyyy-MM-ddTHH:mm:ss");
        var makeEndDateTimeArr = makeEndDateTime.split('T');
        var dayDate = makeEndDateTimeArr[0];

        var finalDateTime = makeEndDateTimeArr[0]+'T'+$('#endTime').val()+':00';

        var e = new DayPilot.Event({
                    start: args.start,
                    end: finalDateTime,
                    id: DayPilot.guid(),
                    text: name
                });


        ///*******ajax Call
        if(window.wanaSave == window.YES){
            var doctorSelectedId = $('#employee_id').val();
            var startTimeVal = $('#startTime').val();
            var endTimeVal = $('#endTime').val();
            $.ajax({
                type: "POST",
                url: "{{route('dutyDays.store')}}",
                data: {day: dayDate, start: startTimeVal, end: endTimeVal, employee_id: doctorSelectedId},
                dataType: 'json',
                success: function(response){
                    if(response.success == true){
                        dp.events.add(e);
                        dp.clearSelection();
                        showMsg(response.message);
                    }else{
                        var msg = "";
                        /*for(var i=0; i < fields.length;i++){
                            console.log(fields[i]);
                            console.log(eval(response.message.fields[i]));
                            console.log(eval(response.message.fields[i][0]));
                            msg += eval(response.message.fields[i][0]) + '<br>'
                        }*/
                        if(response.message.employee_id){
                            for(var i=0;i<response.message.employee_id.length;i++){
                                msg += response.message.employee_id[i] + '<br>';
                            }
                        }
                        if(response.message.hasOwnProperty('day')){
                            for(var i=0;i<response.message.day.length;i++){
                                msg += response.message.day[i] + '<br>';
                            }
                        }
                        if(response.message.start){
                            for(var i=0;i<response.message.start.length;i++){
                                msg += response.message.start[i] + '<br>';
                            }
                        }
                        if(response.message.end){
                            for(var i=0;i<response.message.end.length;i++){
                                msg += response.message.end[i] + '<br>';
                            }
                        }
                        showMsg(msg);
                    }
               }
            });
        }
    });

    //***btnSave Click Event
    $('#btnSave').click(function(){
        window.wanaSave = window.YES;
        console.log(window.wanaSave);
        $('#btnModalClose').trigger('click');
    });
</script>
@stop