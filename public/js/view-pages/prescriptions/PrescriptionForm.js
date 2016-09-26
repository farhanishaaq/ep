/**
 * Created by Ali on 9/8/2016.
 */

var PrescriptionForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
        saveCloseUrl: "",
        photoUploadUrl: "",
        photoDeleteUrl: "",
        photoInitialPreview: [],
        parentPrescriptionUrl: "",
        formMode: '',
        validationRulesForForm: function (frmElement) {
            frmElement.validate({
                rules: {
                    refill: {
                        required: true
                    },
                    usage_type:{
                        required: true
                    },
                    usage_quantity: {
                        required: true,
                        maxlength: 50
                    },
                    dosage_strength: {
                        required: true
                    },
                    strength_quantity: {
                        required: true,
                        maxlength: 50
                    },
                    quantity_unit: {
                        required: true
                    },
                    frequencies_dd: {
                        required: true
                    },

                },
                messages: {
                    refill: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Refill")
                    },
                    usage_type: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Usage Type")
                    },
                    usage_quantity: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Usage Quantity")
                    },
                    dosage_strength: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Dosage Strength")
                    },
                    strength_quantity: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Strength Quantity")
                    },
                    quantity_unit: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Quantity Unit")
                    },
                    frequencies_dd: {
                        required: String.format(MessageDictionay.validationMsgs.required, "Frequencies")
                    },
                }
            });
        }
    };

    var settings = $.extend(defaults, options || {});
    var s = settings;
    var saveCloseClicked = false;
    //var rowIndex = 0;

    /**
     *
     * @param rowIndex
     */
    var createNewRow = function(rowIndex,beforeCurrentRow) {
        //$beforeCurrentRow = beforeCurrentRow;
        var $template = $('#detailRowTemplate');
        var $clone = $template
            .clone()
            .removeClass('dN')
            .removeAttr('id')
            .attr('id','detail-row-' + rowIndex)
            .attr('data-row-index', rowIndex)
            .addClass('removablRow')
            .insertBefore(beforeCurrentRow);

        console.log($clone);
        // Update the name attributes
        $clone.find('.row-count-display').html(rowIndex+1).end()
            .find('[name="usage_type[-1]"]').attr('name', 'usage_type[' + rowIndex + ']').attr('id', 'usage_type_' + rowIndex ).end()
            .find('[name="dosage_form[-1]"]').attr('name', 'dosage_form[' + rowIndex + ']').end()
            .find('[name="medicine_id[-1]"]').attr('name', 'medicine_id[' + rowIndex + ']').end()
            .find('[name="strength_quantity[-1]"]').attr('name', 'strength_quantity[' + rowIndex + ']').end()
            .find('[name="dosage_strength[-1]"]').attr('name', 'dosage_strength[' + rowIndex + ']').end()
            .find('[name="usage_quantity[-1]"]').attr('name', 'usage_quantity[' + rowIndex + ']').end()
            .find('[name="quantity_unit[-1]"]').attr('name', 'quantity_unit[' + rowIndex + ']').end()
            .find('[name="frequencies[-1]"]').attr('name', 'frequencies[' + rowIndex + ']').end()
            .find('[name="frequencies_dd[-1]"]').attr('name', 'frequencies_dd[' + rowIndex + ']').end()
            .find('[name="extra_note[-1]"]').attr('name', 'extra_note[' + rowIndex + ']').end();

        //** usage_type select2
        $('[name="usage_type['+ rowIndex +']"]').select2({
            tags: "true",
            placeholder: "Dosage Type"
        });

        //** dosage_form select2
        $('[name="dosage_form['+ rowIndex +']"]').select2({
            tags: "true",
            placeholder: "Dosage Form"
        });

        //** medicine_id select2
        $('[name="medicine_id['+ rowIndex +']"]').select2({
            tags: "true",
            placeholder: "Medicine"
        });

        //** dosage_strength select2
        $('[name="dosage_strength['+ rowIndex +']"]').select2({
            tags: "true",
            placeholder: "Dosage Strength"
        });

        //** quantity_unit select2
        $('[name="quantity_unit['+ rowIndex +']"]').select2({
            tags: "true",
            placeholder: "Select Unit"
        });

        //** frequencies select2
        $('[name="frequencies_dd['+ rowIndex +']"]').select2({
            tags: "true",
            placeholder: "Frequencies"
        });
    };

    /*****
     * call in allPluginsInitializer
     */
    var mask = function() {
        var patientId = $('#patient_id').val();
        var appointmentId = $('#appointment_id').val();
        var appointmentDate = $('#appointment_date').val();
        var prescriptionNextCount = $('#prescriptionNextCount').val();
        var PrescriptionCode = appointmentDate +'-'+ leftPad(patientId,"000") + leftPad(appointmentId,"000") + leftPad(prescriptionNextCount,"000");
        $('#code').val(PrescriptionCode);

    };

    var makePhotoUploadComponent = function () {
        //*********************FileInput plugin
        // with plugin options
        $("#checkUpPhoto").fileinput({
            uploadUrl: s.photoUploadUrl, // server upload action
            uploadAsync: true,
            initialPreview: s.photoInitialPreview,
            previewFileType: "image",
            initialPreviewAsData: true,
            browseLabel: "Pick Image",
            initialPreviewConfig: [
                {caption: "profile-dumy.png", size: 930321, width: "120px", key: 1}
            ],
            deleteUrl: s.photoDeleteUrl,
            overwriteInitial: true,
            maxFileSize: window.PROFILE_MAX_FILE_SIZE, //KB
            initialCaption: "Profile Photo",
            initialPreviewFileType: 'image' // image is the default and can be overridden in config below

        });

        // CATCH RESPONSE
        $('#checkUpPhoto').on('filebatchuploaderror', function(event, data, previewId, index) {
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

        $('#checkUpPhoto').on('fileuploaded', function(event, data, previewId, index) {
            var response = data.response;
            $('#photo').val(response.uploaded);
            console.log('File uploaded triggered');
            showMsg(response.message);
        });

        $('#checkUpPhoto').on('filecleared', function(event) {
            //alert('Cleared');
            var imageName = $('#photo').val();
            $.ajax({
                type: 'GET',
                url: s.photoDeleteUrl,
                data: {imageName: imageName},
                dataType: 'json',
                success: function (response) {
                    if(response.success)
                    {
                        showMsg(response.message,window.MESSAGE_TYPE_SUCCESS);
                    }
                }
            });
        });
    };

    var allPluginsInitializer = function(){

        /**
         * usage_type select2
         */
        $('#usage_type').select2({
            tags: "true",
            placeholder: "Usage Type"
        });


        /**
         * dosage_form select2
         */
        $('#dosage_form').select2({
            tags: "true",
            placeholder: "Dosage Form"
        });

        /**
         * medicine_id select2
         */
        $('#medicine_id').select2({
            tags: "true",
            placeholder: "Medicine"
        });

        /**
         * dosage_strength select2
         */
        $('#dosage_strength').select2({
            tags: "true",
            placeholder: "Strength"
        });

        /**
         * quantity_unit select2
         */
        $('#quantity_unit').select2({
            tags: "true",
            placeholder: "Unit"
        });

        /**
         * frequencies select2
         */
        $('#frequencies_dd').select2({
            tags: "true",
            placeholder: "Frequencies"
        });

        /**
         * follow_up_pres select2
         */
        $('#follow_up_pres').select2({
            tags: "true",
            placeholder: "follow up pres"
        });


        //*****Tabs
        $('.nav.nav-tabs').responsiveTabs();

        //***this function make Mask of Prescription
        mask();

        //***fileInput plugin for upload photo
        makePhotoUploadComponent();

    };

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        //****Start OnClick Of New Row Plus Remove Row
        $(s.dataFormId).on('click', '.addButton', function () {
                var $beforeCurrentRow = $('#detail-row-'+window.PrescriptionDetailRowIndex);
                window.PrescriptionDetailRowIndex++;
                createNewRow(window.PrescriptionDetailRowIndex,$beforeCurrentRow);
            })

            // Remove button click handler
            .on('click', '.removeButton', function () {
//                var $row = $(this).parents('.actual');
                var $row = $(this).parents('.removablRow');

                var index = $row.attr('data-row-index');
//                console.log($row);
                // Remove element containing the fields
                $row.remove();
            });
        //****End OnClick Of New Row


        /**
         * Form follow_up_pres change Event
         */
        $('#follow_up_pres').on("change",function(){

            var followUpId = $(this).val();
                $.ajax({

                    type: 'GET',
                    url: s.parentPrescriptionUrl,
                    data: {followUpId: followUpId},
                    dataType: 'html',
                    success: function(result){
                        $("#detailRowContainer").html(result);
                        $('#prescriptionDetailTab').trigger('click');
                    }

                });

        });





        /**
         * Form Submit Button Event
         */
//            $(s.dataFormId).submit(function(e){
        $('#regForm').submit(function(e){
            e.preventDefault();

            var freVal = $('#frequencies_dd').val();
            $('#frequencies').val(freVal);
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
        //****End of form submit


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
