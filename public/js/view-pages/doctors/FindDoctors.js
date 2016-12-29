/**
 * Created by aitzazwattoo on 11/28/2016.
 */
var FindDoctors = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        formMode: ''
    };
    var settings = $.extend(defaults, options || {});
    var s = settings;

    var allPluginsInitializer = function(){

        //****For List
        if($('#tblRecordsList tr.row-data').length){
            $('#tblRecordsList').DataTable({
                "columnDefs": [
                    {
                        "targets": 6,
                        "orderable": false
                    },
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
                ],
                "order": [[ 0, "desc" ]],
                "lengthMenu": [20, 40, 60, 80, 100],
            });
        }

    }

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
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
