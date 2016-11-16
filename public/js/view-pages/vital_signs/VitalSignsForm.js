/**
 * Created by Aitzaz Wattoo on 20-Oct-16.
 */

var VitalSignsForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#vitalSignsForm",
        saveCloseUrl: "",
        VitalSignUrl: "",
        formMode: '',
        validationRulesForForm: function (frmElement) {
            frmElement.validate({
                rules: {
                    bp_systolic: {
                        required: true
                    },
                    bp_diastolic: {
                        required: true
                    },
                    blood_group: {
                        required: true
                    },
                    pulse_rate:{
                        required: true
                    },
                    respiration_rate: {
                        required: true
                    },
                    temperature: {
                        required: true
                    },
                    addiction: {
                        required: true
                    }

                },
                messages: {
                    bp_systolic: {
                        required: String.format(MessageDictionay.validationMsgs.required, "bp systolic")
                    },
                    bp_diastolic: {
                        required: String.format(MessageDictionay.validationMsgs.required, "bp diastolic")
                    },
                    blood_group: {
                        required: String.format(MessageDictionay.validationMsgs.required, "blood group")
                    },
                    pulse_rate: {
                        required: String.format(MessageDictionay.validationMsgs.required, "pulse rate")
                    },
                    respiration_rate: {
                        required: String.format(MessageDictionay.validationMsgs.required, "respiration rate")
                    },
                    temperature: {
                        required: String.format(MessageDictionay.validationMsgs.required, "temperature")
                    },
                    addiction: {
                        required: String.format(MessageDictionay.validationMsgs.required, "addiction")
                    }
                }
            });
        }
};
    var settings = $.extend(defaults, options || {});
    var s = settings;
    var saveCloseClicked = false;

    var allPluginsInitializer = function(){

        /**
         * follow_up_pres select2
         */
        $('#id').select2({
            tags: "true",
            placeholder: "History of vital sign"
        });

    };

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        ///**
        // * Form vital_sign_history change Event
        // */
        $('#id').on("change",function(){

            var VitalSignId = $(this).val();

            $.ajax({

                type: 'GET',
                url: s.VitalSignUrl,
                data: {VitalSignId: VitalSignId},
                dataType: 'html',
                success: function(result){
                    $('#vitalSignHistory').html(result);
                }
            });
        });

        // call patient idf and store it in database
       // $patient_id = ('#tblRecordsList').val();
       // $('#tblRecordsList thead tr.firstrow').attr('patient_id');
        /**
         * Form Submit Button Event
         */
        $(s.dataFormId).submit(function(e){
            e.preventDefault();
            var frm = $(this);
             console.log(frm.serialize());
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

        $('#saveClose').click(function (e) {
            saveCloseClicked = true;
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
