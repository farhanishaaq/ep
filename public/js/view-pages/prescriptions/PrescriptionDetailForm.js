/**
 * Created by Ali on 9/26/2016.
 */
var PrescriptionDetailForm = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        rowCount: ""

    };

    var settings = $.extend(defaults, options || {});
    var s = settings;

    var allPluginsInitializer = function(){

        for (i = 0; i <= s.rowCount; i++) {

            /**
             * usage_type select2
             */
            $('[name="usage_type['+i+']"]').select2({
                tags: "true",
                placeholder: "Usage Type"
            });


            /**
             * dosage_form select2
             */
            $('[name="dosage_form['+i+']"]').select2({
                tags: "true",
                placeholder: "Dosage Form"
            });

            /**
             * medicine_id select2
             */
            $('[name="medicine_id['+i+']"]').select2({
                tags: "true",
                placeholder: "Medicine"
            });

            /**
             * dosage_strength select2
             */
            $('[name="dosage_strength['+i+']"]').select2({
                tags: "true",
                placeholder: "Strength"
            });

            /**
             * quantity_unit select2
             */
            $('[name="quantity_unit['+i+']"]').select2({
                tags: "true",
                placeholder: "Unit"
            });

            /**
             * frequencies select2
             */
            $('[name="frequencies_dd['+i+']"]').select2({
                tags: "true",
                placeholder: "Frequencies"
            });
        }



    };

    var eventsBindings = function () {

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
