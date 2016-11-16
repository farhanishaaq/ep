
var VitalSignsList = function(win,doc, options1){
    var W = win;
    var D = doc;
    var defaults = {
        getVitalSignsFormUrl: "",
        formMode: '',
    };
    var settings = $.extend(defaults, options1 || {});
    var s = settings;



    var allPluginsInitializer = function(){



    };

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        //****BS-Modal Show Event
//            $('#appointmentsModal').on('show.bs.modal', function () {
        $(".appointmentsModalLink").click(function(){

            var patientIdVal = $(this).attr('patient_id');

            $.ajax({
                type: "GET",
                url: "{{ route('fetchAppointmentsByPatientId') }}",
                data: {patientId: patientIdVal},
                success: function(response) {
                    if(response == "Error"){

                    }else{
                        $('#appointmentsViewTbody').html(response);
                        $('#appointmentsModal').show();

                        //vital signs according to appointment
                        $("#timeSlotLink").click(function ()
                        {
                            var patientIdValforVS = $(this).attr('data');

                            $.ajax({
                                type: "GET",
                                url: "{{ route('fetchVitalSignsByPatientId') }}",
                                data: {patientId: patientIdValforVS},
                                success: function (response) {
                                    if (response == "Error") {
                                        $('#vitalSignTable').html('You have got an error');
                                    } else {

                                        $('#vitalSignTable').html(response);

                                    }
                                }


                            });
                        });
                    }
                }
            });
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
