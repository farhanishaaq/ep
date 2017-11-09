/**
 * Created by mrashid on 4/17/2016.
 */
var DoctorsList = function(win,doc, options){
    var W = win;
    var D = doc;
    var defaults = {
        getDoctorFormUrl: "",
        formMode: '',
        listCols: 5
    };
    var settings = $.extend(defaults, options || {});
    var s = settings;
    var drScheduleFormUrl=null;
    var drId=null;
    var drScheduleViewUrl = null;

    //*** Prescription Bootsrap-Modal-Events
    var scheduleModalEvents = function () {
        //****BS-Modal Show Event
        $('.viewPresc').click(function () {
            drScheduleViewUrl = $(this).attr('dr-schedule-view-url');
        });

        //****BS-Modal Show Event
        $('#myModal').on('show.bs.modal', function () {
            if(drScheduleViewUrl){
                $.ajax({
                    type: 'GET',
                    url:  drScheduleViewUrl ,
                    async: true,
                    success: function (response) {
                        if(response == "Error"){

                        }else{
                            $('#scheduleViewTbody').html(response);
                        }
                    }
                });
            }
        });
    }

    var allPluginsInitializer = function(){

        //****For List
        // console.log(s.listCols);
        if($('#tblRecordsList tr.row-data').length){
            $('#tblRecordsList').DataTable({
                "columnDefs": [ {
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


        //******
        scheduleModalEvents();

    }

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

        //****Go To Create Duty Day Form
        $('.openScheduleFrom').click(function (e) {
            e.preventDefault()
            drScheduleFormUrl = $(this).attr('dr-schedule-form-url');
            console.log(drScheduleFormUrl);
            goTo(drScheduleFormUrl);

        });

        //****Go To Create Duty Day Form
        $('.openScheduleView').click(function (e) {
            e.preventDefault()
            drScheduleViewUrl = $(this).attr('dr-schedule-view-url');
            // drId = $(this).attr('doctor-id');
            // var completeUrl =drScheduleViewUrl + drId;
            console.log(drScheduleViewUrl);
        });

        


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
