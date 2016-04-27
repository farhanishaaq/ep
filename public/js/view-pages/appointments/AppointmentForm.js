/**
 * Created by mrashid on 4/17/2016.
 */
var AppointmentForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
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
    var s = settings;


    var allPluginsInitializer = function(){

        //**** For Country
        $("#employee_id").select2();


        //**** For Role
        $("#patient_id").select2();


        //**** For Branch
        $("#status").select2();

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
