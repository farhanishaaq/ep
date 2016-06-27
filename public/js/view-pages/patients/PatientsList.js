/**
 * Created by mrashid on 4/17/2016.
 */
var PatientsList = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        getPatientFormUrl: "",
        formMode: ''
    };
    var settings = $.extend(defaults, options || {});
    var s = settings;


    //*** Prescription Bootsrap-Modal-Events
    var prescriptionModalEvents = function () {
        //****BS-Modal Show Event
        $('.viewPresc').click(function () {
            window.patientPrescriptionUrl = $(this).attr('patient-prescription-url');
        });

        //****BS-Modal Show Event
        $('#myModal').on('show.bs.modal', function () {
            if(window.patientPrescriptionUrl){
                $.ajax({
                    type: 'GET',
                    url:  window.patientPrescriptionUrl ,
                    dataType: 'html',
                    success: function (response) {
                        if(response == "Error"){

                        }else{
                            $('#prescriptionTbody').html(response);
                        }
                    }
                });
            }
        });
    }


    var allPluginsInitializer = function(){

        //****For List
        if($('#tblRecordsList tr.row-data').length){
            $('#tblRecordsList').DataTable({
                "columnDefs": [ {
                    "targets": 5,
                    "orderable": false
                } ]
            });
        }

    }

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        //*** Prescription Bootsrap-Modal-Events
        prescriptionModalEvents();


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
