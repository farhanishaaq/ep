/**
 * Created by Zeeshan on 9/8/2016.
 */

var MedicineCategoryForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
        saveCloseUrl: "",
        formMode: '',
    };

    var settings = $.extend(defaults, options || {});
    var s = settings;
    var saveCloseClicked = false;
    var rowIndex = 0;

    var allPluginsInitializer = function(){

        //** dosage_form select2
        $('#dosage_form').select2({
            tags: "true",
            placeholder: "Dosage Form"
        });


        /**
         * parent_id select2
         */
        $('#parent_id').select2({
            tags: "true",
            placeholder: " Parent Category"
        });

        /**
         * menufacturer_id select2
         */
        $('#Manufacturer').select2({
            tags: "true",
            placeholder: " Medicine Manufacturer"
        });

    };

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        //***For is_derived Radio Selection
        $('.btn.btn-primary-2.is_derived').click(function(){
            setRadioValInHidden('is_derived',$(this));
        });

        /**
         * Form Submit Button Event
         */
            //            $(s.dataFormId).submit(function(e){
        $('#regForm').submit(function(e){
            e.preventDefault();
            var frm = $(this);
            // console.log(frm.serialize());
            //  var validator = s.validationRulesForForm(frm);

            if (frm.valid()) {
                var formData = frm.serialize();
                var saveUrl = frm.attr('action') || "";

            }else{
                showMsg('Invalid Form!',window.MESSAGE_TYPE_ERROR);
            }
            var formData = frm.serialize();
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
