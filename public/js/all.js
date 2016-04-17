/**
 * Created by mrashid on 4/17/2016.
 */

function setRadioValInHidden(hiddenFieldId,clickedElement){
    //var nameSelector = 'rdo-'+hiddenFieldId;
    //var selectedRadioVal = $('[name="'+ nameSelector +'"]:checked').val();
    //console.log(clickedElement.attr('class'));

    var selectedRadio = clickedElement.children('input[type="radio"]');
    selectedRadio.prop('checked');
    var selectedRadioVal = selectedRadio.val();
    $('#'+hiddenFieldId).val(selectedRadioVal);
}
