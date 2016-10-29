/**
 * Created by mrashid on 4/17/2016.
 */
var DutyDayForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#dutyDaysForm",
        selectedDrId: null,
        saveCloseUrl: '',
        eventData: [],
        validationRulesForForm: function (frmElement) {
            frmElement.validate({
                rules: {
                    doctor_id: {
                        required: true
                    },
                },
                messages: {
                    doctor_id: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Doctor")
                    },
                }
            });
        }
    };
    var settings = $.extend(defaults, options || {});
    var s = settings;
    var selectedDayInCalendar;
    var wanaSave = W.NO;
    var eventDataToClnr = [];

    var saveDayDuties = function() {
        var validSchedule = false;
        for(d in W.daysNames){
            if($('#'+ daysNames[d]).val() != ''){
                validSchedule = true;
                break;
            }
        }
        if(validSchedule){
            var frm = $(s.dataFormId);
            var formData = frm.serialize();
            var saveUrl = frm.attr('action') || "";
            $.ajax({
                type: "POST",
                url: saveUrl,
                data: formData,
                dataType: 'json',
                success: function(response){
                    if(response.success == true){
                        // dp.events.add(e);
                        // dp.clearSelection();
                        showMsg(response.message);
                        goTo(s.saveCloseUrl);
                    }else{
                        var msg = "";
                        if(response.message.doctor_id){
                            for(var i=0;i<response.message.doctor_id.length;i++){
                                msg += response.message.doctor_id[i] + '<br>';
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
        }else{
            showMsg('Invalid Doctor Schedule!',W.MESSAGE_TYPE_ERROR);
        }

    }

    var makeFullCalendarComponent = function () {
        $('#dutyDayCalendar').fullCalendar({
            header: {
                left: '',   //'prev,next today',
                center: '', //'title',
                right: ''   //'month,agendaWeek,agendaDay'
            },
            defaultDate: W.DP_MONDAY,
            selectable: true,
            defaultView:"agendaWeek",
            columnFormat: {
                week: 'dddd', //Monday
            },
            editable: false,
            eventLimit: false,
            selectHelper: true,
            selectOverlap: function(event) {
                return ! event.block;
            },
            select: function(start, end, jsEvent, view) {
                var startTime = moment(start).format('hh:mmA');
                var endTime = moment(end).format('hh:mmA');
                var day = moment(start).format('dddd');
                selectedDayInCalendar = day;
                // $('#'+day).val(JSON.stringify({day: day, start: startTimeVal, end: endTimeVal}));
                if($('#'+day).val() != ''){
                    return;
                }else{
                    wanaSave = W.NO;
                    $('#btnOpenModel').trigger('click');
                    $('#startTime').val(startTime);
                    $('#endTime').val(endTime);
                    // W.eventData = {
                    //     title: startTime + ' - ' + endTime,
                    //     start: startTime,
                    //     end: endTime
                    // };
                    // $('#dutyDayCalendar').fullCalendar('renderEvent', eventDataToClnr[day], true); // stick? = true
                    $('#dutyDayCalendar').fullCalendar('unselect');
                }
            },
            eventClick: function (calEvent, jsEvent, view) {
                $('#dutyDayCalendar').fullCalendar('removeEvents', function (calEvent) {
                    console.log(jsEvent);
                    var eDay = moment(calEvent.start).format('dddd');
                    var vDay = moment(view.start).format('dddd');
                    if(vDay == eDay){
                        var day = moment(calEvent.start).format('dddd');
                        delete eventDataToClnr[day];
                        return true;
                    }else{
                        return false;
                    }
                });
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: s.eventData,

            /*events: [

             {
             title: 'All Day Event',
             start: '2016-05-01'
             },
             {
             title: 'Long Event',
             start: '2016-05-07',
             end: '2016-05-10'
             },
             {
             id: 999,
             title: 'Repeating Event',
             start: '2016-05-09T16:00:00'
             },
             {
             id: 999,
             title: 'Repeating Event',
             start: '2016-05-16T16:00:00'
             },
             {
             title: 'Conference',
             start: '2016-05-11',
             end: '2016-05-13'
             },
             {
             title: 'Meeting',
             start: '2016-05-12T10:30:00',
             end: '2016-05-12T12:30:00'
             },
             {
             title: 'Lunch',
             start: '2016-05-12T12:00:00'
             },
             {
             title: 'Meeting',
             start: '2016-05-12T14:30:00'
             },
             {
             title: 'Happy Hour',
             start: '2016-05-12T17:30:00'
             },
             {
             title: 'Dinner',
             start: '2016-05-12T20:00:00'
             },
             {
             title: 'Birthday Party',
             start: '2016-05-13T07:00:00'
             },
             {
             title: 'Click for Google',
             url: 'http://google.com/',
             start: '2016-05-28'
             }
             ]*/
        });

        //****BS-Modal Show Event
        $('#myModal').on('show.bs.modal', function () {
//        $('#endDate').val('');
        });

        //****BS-Modal Close Event
        $('#myModal').on('hidden.bs.modal', function () {

            var day = selectedDayInCalendar;
            console.log(day);
            if($('#endTime').val() == "")
                return;
            else if($('#doctor_id').val() == "")
                return;

            ///*******ajax Call
            if(wanaSave == W.YES){
                var startTimeVal = $('#startTime').val();
                var endTimeVal = $('#endTime').val();

                var startTime24Hour = moment(startTimeVal, ["hh:mmA"]).format("HH:mm");
                var endTime24Hour = moment(endTimeVal, ["hh:mmA"]).format("HH:mm");

                var dayDummyDate = W.DP_DAYS_2[day];

                var startTimeClnr = dayDummyDate + 'T'+startTime24Hour;
                var endTimeClnr = dayDummyDate + 'T' + endTime24Hour;
                var titleClnr = day + ' Timings';

                $('#'+day).val(JSON.stringify({day: day, start: startTimeVal, end: endTimeVal}));
                // $('#'+day).val(JSON.stringify({day: day, start: startTime24Hour, end: endTime24Hour}));
                eventDataToClnr[day]  = {title: titleClnr, start: startTimeClnr, end: endTimeClnr};
                $('#dutyDayCalendar').fullCalendar('renderEvent', eventDataToClnr[day], true); // stick? = true
            }
        });
    }

    var allPluginsInitializer = function(){

        //**** For Country
        if(s.selectedDrId == null){
            $("#doctor_id").select2({placeholder: 'Select Doctor'});
        }else{
            $("#doctor_id").select2({val: s.selectedDrId});
        }


        //**** For endTime ClockPicker
        $('#endTime').clockpicker({
            donetext:'Done',
//        autoclose: true,
            twelvehour: true,
        });

        //***fileInput plugin for upload photo
        makeFullCalendarComponent();

    };

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        //***btnSave Click Event
        $('#btnSave').click(function(){
            wanaSave = W.YES;
            $('#btnModalClose').trigger('click');
        });

        //***btnSave Click Event
        $('#saveClose').click(function(){
            saveDayDuties();
        });


        //***btnSave Click Event
        $('#btnCloseForm').click(function(){
            wanaSave = W.YES;
            $('#btnModalClose').trigger('click');
        });



        /**
         * Form Submit Button Event
         */
        $(s.dataFormId).submit(function(e){
            e.preventDefault();
            var frm = $(this);
            // console.log(frm.serialize());
            var validator = s.validationRulesForForm(frm);

            if (frm.valid()) {
                var formData = frm.serialize();
                var saveUrl = frm.attr('action') || "";
                $.ajax({
                    type: 'POST',
                    url: saveUrl,
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if(response.success){
                            showMsg(response.message,W.MESSAGE_TYPE_SUCCESS);
                            goTo(s.saveCloseUrl);
                        }
                    }
                });
            }else{
                showMsg('Invalid Form!',W.MESSAGE_TYPE_ERROR);
            }
            return false;
        });
    };



    /**
     * Initialize | This function is used to Initialization
     * @access public
     * @return void
     */
    this.initializeAll = function () {
        allPluginsInitializer();
        eventsBindings();
    }
};
