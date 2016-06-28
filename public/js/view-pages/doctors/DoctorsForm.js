/**
 * Created by mrashid on 4/17/2016.
 */
var DoctorsForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
        saveCloseUrl: "",
        photoUploadUrl: "",
        photoInitialPreview: [],
        formMode: '',
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



    var makePhotoUploadComponent = function () {
        //*********************FileInput plugin
        // with plugin options
        $("#userPhoto").fileinput({
            uploadUrl: s.photoUploadUrl, // server upload action
            uploadAsync: true,
            initialPreview: s.photoInitialPreview,
            previewFileType: "image",
            initialPreviewAsData: true,
            browseLabel: "Pick Image",
            initialPreviewConfig: [
                {caption: "profile-dumy.png", size: 930321, width: "120px", key: 1}
            ],
            deleteUrl: "{{route('uploadProfilePic')}}",
            overwriteInitial: true,
            maxFileSize: 100,
            initialCaption: "Profile Photo",
            initialPreviewFileType: 'image' // image is the default and can be overridden in config below

        });

        // CATCH RESPONSE
        $('#userPhoto').on('filebatchuploaderror', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;

        });

        /*$('#input').on('filepreupload', function(event, data, previewId, index, jqXHR) {
         // do your validation and return an error like below
         if (customValidationFailed) {
         return {
         message: 'You are not allowed to do that',
         data: {key1: 'Key 1', detail1: 'Detail 1'}
         };
         }
         });*/

        $('#userPhoto').on('fileuploaded', function(event, data, previewId, index) {
            var response = data.response;
            $('#photo').val(response.uploaded);
            console.log('File uploaded triggered');
            if(response.success)
                showMsg(response.message, window.MESSAGE_TYPE_SUCCESS);
            else{
                showMsg(response.message, window.MESSAGE_TYPE_ERROR);
            }
        });

        $('#userPhoto').on('filecleared', function(event) {
            alert('Cleared');
        });
    }


    var allPluginsInitializer = function(){

        //**** For Country
        $("#medical_specialty_id").select2();
        $("#qualification_id").select2();

        //*** date of birth
        $('#dob').datepicker();

        //***fileInput plugin for upload photo
        makePhotoUploadComponent();

    }

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        // ***For gender Radio Selection
        $('.btn.btn-primary-2.gender').click(function(){
            setRadioValInHidden('gender',$(this));
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
