/**
 * Created by mrashid on 9/18/2016.
 */

var CompanyHomePage = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
        saveCloseUrl: "",
        photoUploadUrl: "",
        photoInitialPreview: [],
        formMode: '',
        fetchDoctorInfoUrl: '',
        validationRulesForForm: function (frmElement) {
            frmElement.validate({
                rules: {
                    user_type: {
                        required: true
                    },
                    username:{
                        required: true,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        maxlength: 15
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    fname: {
                        required: true,
                        maxlength: 60
                    },
                    lname: {
                        required: true,
                        maxlength: 60
                    },

                },
                messages: {
                    user_type: {
                        required: String.format(MessageDictionay.validationMsgs.required, "User Type")
                    },
                    username: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Username")
                    },
                    password: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Password")
                    },
                    email: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Email")
                    },
                    fname: {
                        required: String.format(MessageDictionay.validationMsgs.required, "First Name")
                    },
                    lname: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Last Name")
                    },
                }
            });
        }
    };
    var settings = $.extend(defaults, options || {});
    var s = settings;
    var saveCloseClicked = false;


    var showHideInputFields = function () {
        var isChecked = false;
        isChecked = $('#status').attr('checked');
        // alert(isChecked);
        if(isChecked=='checked'){
            //***show things newPatient inputs fields
            $('.newPatient div input').attr('disabled',false);
            $('.newPatient').show();

            //***hide things oldPatient inputs fields
            $('.oldPatient div input').attr('disabled',true);
            $('.oldPatient').hide();
        }else{
            //***hide things newPatient inputs fields
            $('.newPatient  div input').attr('disabled',true);
            $('.newPatient').hide();

            //***show things oldPatient inputs fields
            $('.oldPatient div input').attr('disabled',false);
            $('.oldPatient').show();
        }
    };


    var allPluginsInitializer = function(){

        //**** For Doctor
        $('#doctor_id').select2();


        //**** For Time Slot
        $('#time_slot_id').select2();



        //****Start For Date Of Appointment
        var dPiker = $('#date').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
        dPiker.autoclose = true;
        dPiker.format = "dd-mm-yyyy";
        //****End For Date Of Appointment

        //*****Tabs
        $('.nav.nav-tabs').responsiveTabs();
    };

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        var visitBefore = $('#status').attr('checked');

        //***For gender Radio Selection
        $('.btn.btn-primary-2.gender').click(function(){
            setRadioValInHidden('gender',$(this));
        });

        //***On click on Switch and show and hide fields
        $('.switch-label').click(function(){
            showHideInputFields();
        });

        $('.switch-handle').click(function(){
            showHideInputFields();
        });

        $('#goToTab2').click(function () {
            $('.nav.nav-tabs  #appointmentInfoLi a').trigger('click');
            // $('.nav.nav-tabs #appointmentInfoLi > a').click();
        });

        /**
         * On Change of doctor_id
         */
        $('#doctor_id').change(function (e) {
            var doctorIdVal = $(this).val();
            $.ajax({
                type: 'GET' ,
                url: s.fetchDoctorInfoUrl,
                dataType: 'html',
                data: {'doctorId': doctorIdVal},
                success: function (response) {
                    if(response == 'error'){
                        $('#doctorInfo').html('Please select Doctor');
                    }else{
                        $('#doctorInfo').html(response);
                    }
                }
            });
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

        $('#saveContinue').click(function (e) {
            saveCloseClicked = false;
        });

        $('#user_type').change(function () {
            var userType = $(this).val();
            switch (userType){
                case window.USER_TYPES[window.DOCTOR]:
                    $('#doctorInfoTabHead').removeClass('dNi');
                    $('#doctorInfoTab').removeClass('dNi');
                    break;
                default:
                    $('#doctorInfoTabHead').addClass('dNi');
                    $('#doctorInfoTab').addClass('dNi');
                    break;
            }
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
            $('#user_type').trigger('change');
        }
    }
};
