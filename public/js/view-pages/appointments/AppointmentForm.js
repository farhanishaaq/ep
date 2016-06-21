/**
 * Created by mrashid on 4/17/2016.
 */
var AppointmentForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
        urlToFetchTimeSlots: "",
        validationRulesForForm: function (frmElement) {
            frmElement.validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50
                    },
                    password: {
                        required: true,
                        maxlength: 15
                    },
                    email: {
                        required: true
                    },
                    Description: {
                        maxlength: 512
                    }
                },
                messages: {
                    Code: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Code"),
                        minlength: String.format(MessageDictionay.validationMsgs.maxlength, "Code", "5")
                    },
                    Name: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Name"),
                        minlength: String.format(MessageDictionay.validationMsgs.maxlength, "Name", "50")
                    },
                    Class: String.format(MessageDictionay.validationMsgs.required, "Class"),
                    Description: String.format(MessageDictionay.validationMsgs.maxlength, "Description", "512")
                }
            });
        }
    };
    var settings = $.extend(defaults, options || {});
    var dp = new DayPilot.Calendar("dutyDayCalendar");
    var s = settings;


    var initializeDayPilot = function(){
        //***Start DayPilot Calendar

        // view
        dp.startDate =  window.DP_MONDAY;  // or just dp.startDate = "2013-03-25";
        dp.viewType = "Day";

        // event creating
        dp.onTimeRangeSelected = function (args) {
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
        };

        dp.onEventClick = function(args) {
            alert("clicked: " + args.e.id());
        };
        dp.headerDateFormat = "dddd";
        dp.eventDeleteHandling = "Update";
        dp.init();
    };


    var allPluginsInitializer = function(){

        //**** For Branch
        $("#time_slot_id").select2();

        //**** For Country
        $("#employee_id").select2();


        //**** For Role
        $("#patient_id").select2();


        //**** For Branch
        $("#status").select2();




        //****Start For Appointment Date
        var dPiker = $('#date').datepicker({
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
                data: {'day': selectedDay, 'employee_id': $('#employee_id').val()},
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
                        dp.events.list = response.data.appointments;
                        initializeDayPilot();
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
        initializeDayPilot();
        //****End initialize DayPilot

    }

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
         * Form Submit Button Event
         */
        $(s.dataFormId).submit(function(){
            var frm = $(this);
            var validator = s.validationRulesForForm(frm);

            if (frm.valid()) {

                var formData = frm.serialize();
                var saveUrl = frm.attr('action') || "";
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
