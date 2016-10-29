/**
 * Created by mrashid on 4/17/2016.
 */
var CompanyForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
        urlToFetchTimeSlots: "",
        saveCloseUrl: "",
        formMode: '',
        validationRulesForForm: function (frmElement) {
            frmElement.validate({
                rules: {
                    name: {
                        required: true,
                    },
                    company_type: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Company Name"),
                    },
                    company_type: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Company Type"),
                    },
                }
            });
        }
    };
    var settings = $.extend(defaults, options || {});
    var s = settings;
    var saveCloseClicked = false;

    var allPluginsInitializer = function(){

        //**** For Company Type
        $("#company_type").select2({'placeholder': 'Company Type'});

        //**** For City Id
        $("#city_id").select2({'placeholder': 'Select City'});

        //**** For Business Unit City Id
        $("#bu_city_id").select2({'placeholder': 'Select Business Unit City'});
    }

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {


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
