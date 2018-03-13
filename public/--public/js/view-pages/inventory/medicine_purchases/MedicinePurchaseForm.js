/**
 * Created by Zeeshan on 9/8/2016.
 */

var MedicinePurchaseForm = function(win,doc, options){
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

    /**
     *
     * @param rowIndex
     */
    var calculateTotalPrice = function(obj) {

        if(!parseInt(obj.qty)){
            obj.qty = 0;
        }
        if(!parseFloat(obj.unitPrice)){
            obj.unitPrice = 0;
        }
        var total  = obj.qty * obj.unitPrice;
        obj.totalElement.val(total);
    };

    /**
     *
     * @param rowIndex
     */
    var createNewRow = function(rowIndex,$beforeCurrentRow) {
        var $template = $('#detailRowTemplate');
        var $clone = $template
            .clone()
            .removeClass('dN')
            .removeAttr('id')
            .attr('id','detail-row-' + rowIndex)
            .attr('data-row-index', rowIndex)
            .addClass('removablRow')
            .insertBefore($beforeCurrentRow);

        console.log($clone);
        // Update the name attributes
        $clone.find('.row-count-display').html(rowIndex+1).end()
            .find('[name="quantity[-1]"]').attr('name', 'quantity[' + rowIndex + ']').end()
            .find('[name="unit_price[-1]"]').attr('name', 'unit_price[' + rowIndex + ']').end()
            .find('[name="medicine_id[-1]"]').attr('name', 'medicine_id[' + rowIndex + ']').end()
            .find('[name="total_price[-1]"]').attr('name', 'total_price[' + rowIndex + ']').end();


        //** medicine_id select2
        $('[name="medicine_id['+ rowIndex +']"]').select2({
            tags: "true",
            placeholder: "Medicine"
        });


        //**** initialize with Zero
        //$('[name="total_price['+ rowIndex +']"]').val(0);

        //**** on blur of quantity calculate total
        $('[name="quantity['+ rowIndex +']"]').blur(function(){
            var qtyVal = $(this).val();
            var unitPriceVal = $('[name="unit_price['+ rowIndex +']"]').val();
            var totalElementVal = $('[name="total_price['+ rowIndex +']"]');
            calculateTotalPrice({qty: qtyVal, unitPrice: unitPriceVal,totalElement: totalElementVal});
        });

        //**** on blur of unit_price calculate total
        $('[name="unit_price['+ rowIndex +']"]').blur(function(){
            var qtyVal = $('[name="quantity['+ rowIndex +']"]').val();
            var unitPriceVal = $(this).val();
            var totalElementVal = $('[name="total_price['+ rowIndex +']"]');
            calculateTotalPrice({qty: qtyVal, unitPrice: unitPriceVal, totalElement: totalElementVal});
        });
    };




    var allPluginsInitializer = function(){

        //** medicine_id select2
        $('[name="medicine_id['+ rowIndex +']"]').select2({
            tags: "true",
            placeholder: "Medicine"
        });


        /**
         * business_unit_id select2
         */
        $('#business_unit_id').select2({
            tags: "true",
            placeholder: "Business unit"
        });

        $('#Manufacturer').select2({
            tags: "true",
            placeholder: "Manufacturer"
        });

    };

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

            //rowIndex = 0;

        //**** on blur of quantity calculate total
        $('[name="quantity['+ rowIndex +']"]').blur(function(){
            var qtyVal = $(this).val();
            var unitPriceVal = $('[name="unit_price['+ rowIndex +']"]').val();
            var totalElementVal = $('[name="total_price['+ rowIndex +']"]');
            calculateTotalPrice({qty: qtyVal, unitPrice: unitPriceVal,totalElement: totalElementVal});
        });

        //**** on blur of unit_price calculate total
        $('[name="unit_price['+ rowIndex +']"]').blur(function(){
            var qtyVal = $('[name="quantity['+ rowIndex +']"]').val();
            var unitPriceVal = $(this).val();
            var totalElementVal = $('[name="total_price['+ rowIndex +']"]');
            calculateTotalPrice({qty: qtyVal, unitPrice: unitPriceVal, totalElement: totalElementVal});
        });

            $('#regForm').on('click', '.addButton', function () {
                    var $beforeCurrentRow = $('#detail-row-'+rowIndex);
                    rowIndex++;
                    createNewRow(rowIndex,$beforeCurrentRow);

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


            /**
             * Form Submit Button Event
             */
    //            $(s.dataFormId).submit(function(e){
            $('#regForm').submit(function(e){
                e.preventDefault();
                var frm = $(this);
                // console.log(frm.serialize());
    //                var validator = s.validationRulesForForm(frm);

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
