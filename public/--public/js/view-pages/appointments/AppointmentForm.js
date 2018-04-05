/**
 * Created by mrashid on 4/17/2016.
 */
var AppointmentForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
        urlToFetchTimeSlots: "",
        formMode: '',
        validationRulesForForm: function (frmElement) {
            frmElement.validate({
                rules: {
                    doctor_id: {
                        required: true,
                    },
                    patient_id: {
                        required: true,
                    },
                    status: {
                        required: true
                    },
                    paid_fee: {
                        required: true,
                        minlength: 2
                    }
                },
                messages: {
                    doctor_id: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Doctor"),
                    },
                    patient_id: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Patient"),
                    },
                    status: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Status"),
                    },
                    paid_fee: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Paid Fee"),
                        minlength: String.format(MessageDictionay.validationMsgs.required, "Paid Fee"),
                    },
                }
            });
        }
    };
    var settings = $.extend(defaults, options || {});
    // var dp = new DayPilot.Calendar("dutyDayCalendar");
    var s = settings;
    var saveCloseClicked = false;
    var dPiker;
    /* var initializeDayPilot = function(){
         //!***Start DayPilot Calendar

         // view
         // dp.startDate =  window.DP_MONDAY;  // or just dp.startDate = "2013-03-25";
         // dp.viewType = "Day";

         // event creating
         /!*dp.onTimeRangeSelected = function (args) {
             //                    if($('#endTime').val() == "") return;
             var name = args.start.toString("HH:mm") + 'To' + '';
             var e = new DayPilot.Event({
                 start: args.start,
                 end: args.end,
                 id: DayPilot.guid(),
                 text: name
             });
             dp.events.add(e);
             dp.clearSelection();
         };*!/

         /!*dp.onEventClick = function(args) {
             alert("clicked: " + args.e.id());
         };
         dp.headerDateFormat = "dddd";
         dp.eventDeleteHandling = "Update";
         dp.init();*!/
     };*/
    
    var initializeFullCalendar = function (dDate,appointments) {
        var params = {date:dDate, currentFormat:"dd-mm-yyyy", requiredFormat:"yyyy-mm-dd"};
        var dDateFormated = getDateIntoRequiredFormat(params);
        console.log(dDateFormated);
        // .fullCalendar('gotoDate', dDateFormated);
        $('#fCalendar').fullCalendar({
            header: {
//                            left: 'prev,next today',
//                            right: 'month,agendaWeek,agendaDay'
//                            center: 'title'
                left: '',
                center: 'title',
                right: ''
            },
            // defaultDate: '2016-07-04',
            defaultDate: dDateFormated,
            defaultView:"agendaDay",
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: appointments
            //============= for Help
            /*events: [
             {
             title: 'All Day Event',
             start: '2016-06-01'
             },
             {
             title: 'Long Event',
             start: '2016-06-07',
             end: '2016-06-10'
             },
             {
             id: 999,
             title: 'Repeating Event',
             start: '2016-06-09T16:00:00'
             },
             {
             id: 999,
             title: 'Repeating Event',
             start: '2016-06-16T16:00:00'
             },
             {
             title: 'Conference',
             start: '2016-06-11',
             end: '2016-06-13'
             },
             {
             title: 'Meeting',
             start: '2016-06-12T10:30:00',
             end: '2016-06-12T12:30:00'
             },
             {
             title: 'Lunch',
             start: '2016-06-12T12:00:00'
             },
             {
             title: 'Meeting',
             start: '2016-06-12T14:30:00'
             },
             {
             title: 'Happy Hour',
             start: '2016-06-12T17:30:00'
             },
             {
             title: 'Dinner',
             start: '2016-06-12T20:00:00'
             },
             {
             title: 'Birthday Party',
             start: '2016-06-13T07:00:00'
             },
             {
             title: 'Click for Google',
             url: 'http://google.com/',
             start: '2016-06-28'
             }
             ]*/
        });
    
    };

    var allPluginsInitializer = function(){

        //**** For Time Slot
        $("#payment_status").select2({'placeholder': 'Payment Status'});

        //**** For Time Slot
        $("#time_slot_id").select2({'placeholder': 'Time Slot'});

        //**** For Doctor
        $("#doctor_id").select2({'placeholder': 'Select Doctor'});


        //**** For Role
        $("#patient_id").select2({'placeholder': 'Select Patient'});


        //**** For Branch
        $("#status").select2();




        //****Start For Appointment Date
        dPiker = $('#date').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
        dPiker.autoclose = true;
        dPiker.format = "dd-mm-yyyy";
        dPiker.change(function (ev) {
            var dtVal = $(this).val();
            var dtValArr = dtVal.split('-');
            var d = dtValArr[0];
            var m = dtValArr[1];
            var yr = dtValArr[2];
            var acceptableDate = yr + '-' + m + '-' + d;
            var date = new Date(acceptableDate);
            var selectedDay = date.getDay();

            //***** load TimeSlots
            $.ajax({
                type: 'GET',
                url: s.urlToFetchTimeSlots,
                data: {'day': selectedDay, 'doctor_id': $('#doctor_id').val()},
                dataType: 'json',
                success:function(response){
                    console.log(response);
                    if(response.success == true){
                        //***Start for time slots
                        $('#time_slot_id').html('');
                        $('#time_slot_id').html('<option value="">Select Time Slot</option>');
                        for(ts in response.data.timeSlots){
                            var obj = response.data.timeSlots[ts];
                            $('#time_slot_id').append('<option value="'+ obj.id +'">'+ obj.slot +'</option>');
                        }
                        //***End for time slots

                        //***Start for DayPilot appointments Load
                        // dp.events.list = response.data.appointments;
                        // initializeDayPilot();
                        var appointmentDate = $('#date').val();
                        // $('#fCalendar').html('');
                        $('#fCalendar').fullCalendar( 'destroy' );
                        initializeFullCalendar(appointmentDate,response.data.appointments);
                        //***End for DayPilot appointments Load
                    }else{
                        showMsg(response.message);
                        $('#time_slot_id').html('');
                    }
                }
            });
        })
        //****End For Appointment Date

        //****Start initialize DayPilot
        // initializeDayPilot();
        //****End initialize DayPilot
    }

    var feeCalculate = function (paidFee) {
        var expectedFee = $('#expected_fee').val();
        var discountAmount = $('#discount_amount').val();

        var remainingFee =  parseInt(expectedFee) - parseInt(discountAmount) - parseInt(paidFee);
        $('#remaining_fee').val(remainingFee);
        $('#total_paid').val(paidFee);

        if(remainingFee == 0){
            $('#payment_status').select2('val',2);
        }else if(paidFee == 0){
            $('#payment_status').select2('val',0);
        }
    };
    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        //***For gender Radio Selection
        // $('.btn.btn-primary-2.gender').click(function(){
        //     // setRadioValInHidden('gender',$(this));
        // });

        /**
         * on change of Doctor selection
         */
        $('#doctor_id').change(function () {
            var val = $(this).val();
            var maxFee = $(this).find("option[value='"+ val+"']").attr('max-fee');
            $('#expected_fee').val(maxFee);

            //******
            var paidFee = $('#paid_fee').val();
            feeCalculate(paidFee);
        });

        /**
         * on change of Paid Fee
         */
        $('#paid_fee').keyup(function () {
            var paidFee = $(this).val();
            feeCalculate(paidFee);
        });

        $('#saveClose').click(function (e) {
            saveCloseClicked = true;
        });

        $('#saveContinue').click(function (e) {
            saveCloseClicked = false;
        });


        /**
         * Form Submit Button Event
         */
        $(s.dataFormId).submit(function(e){
            // e.preventDefault();
            var frm = $(this);
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
                            showMsg(response.message,window.MESSAGE_TYPE_SUCCESS);
                            if(saveCloseClicked){
                                goTo(s.saveCloseUrl);
                            }else{
                                window.location.reload();
                            }
                        }
                    }
                });
            }else{
                showMsg('Invalid Form!',window.MESSAGE_TYPE_ERROR);
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
        if(s.formMode == window.FORM_EDIT){
            dPiker.trigger('change');
        }
    }
};
