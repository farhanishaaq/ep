<table width="650" height="1300" border="0">

    <tr>
        <td width="272" height="55"><label>Current Visit Date*</label></td>
        <td width="333">
            <label> {{ (isset($appointment))?  date('j F, Y', strtotime($appointment->date)) :  date('j F, Y', strtotime($prescription->appointment->date)) }}</label>
        </td>
    </tr>

    <tr>
        <td width="272" height="55"><label>Doctor Name*</label></td>
        <td width="333">

            <label> {{ (isset($appointment))? $appointment->employee->name : $prescription->appointment->employee->name}}</label>

        </td>
    </tr>

    <tr>
        <td width="272" height="55"><label>Prescription Code:</label></td>
        <td width="333" colspan="2">
            {{ Form::input('text', 'code', null, array('required' => 'true')) }}
        </td>
    </tr>
    <style type="text/css">
        .hide {
            display: none;
        }
    </style>
    <tr>
        <td width="272"><label>Inventory Medicines:</label></td>
        <td width="333" height="60">
            {{ Form::select("medicineName[0]", [null => 'Select first medicine']+$medicine, null,
            ['style' => 'width: 95%; height: 38px']) }}
        </td>
        <td width="150">
            <input type="text" class="form-control" name="quantity[0]" placeholder="quantity"
            style="width: 83%" />
        </td>
        <td width="30">
            <button class="btn btn-default addButton" type="button"><i class="fa fa-plus"></i></button>
        </td>
    </tr>
    <tr id="moreMedicine" class="hide actual">
        <td width="272"></td>
        <td width="333" height="60">
            {{ Form::select("medicine", [null => 'Select first medicine']+$medicine, null,
             ['style' => 'width: 95%; height: 38px']) }}
        </td>
        <td width="150">
            <input type="text" class="form-control" name="med_qty" placeholder="quantity"
                   style="width: 83%" />
        </td>
        <td width="30">
            <button class="btn btn-default removeButton" type="button"><i class="fa fa-minus"></i></button>
        </td>
    </tr>
    <script type="text/javascript">
        $(document).ready(function () {
            bookIndex = 0;
            $('#regForm')
                    .on('click', '.addButton', function () {
                        bookIndex++;
                        var $template = $('#moreMedicine'),
                                $clone = $template
                                        .clone()
                                        .removeClass('hide')
                                        .removeAttr('id')
                                        .attr('data-book-index', bookIndex)
                                        .insertBefore($template);

                        // Update the name attributes
                        $clone
                                .find('[name="medicine"]').attr('name', 'medicineName[' + bookIndex + ']').end()
                                .find('[name="med_qty"]').attr('name', 'quantity[' + bookIndex + ']').end();

                        // Add new fields
                        // Note that we also pass the validator rules for new field as the third parameter
//                        $('#bookForm')
//                                .formValidation('addField', 'book[' + bookIndex + '].title', titleValidators)
//                                .formValidation('addField', 'book[' + bookIndex + '].isbn', isbnValidators)
//                                .formValidation('addField', 'book[' + bookIndex + '].price', priceValidators);
                    })
                    // Remove button click handler
                    .on('click', '.removeButton', function () {
                        var $row = $(this).parents('.actual'),
                                index = $row.attr('data-book-index');

                        // Remove fields
//                        $('#bookForm')
//                                .formValidation('removeField', $row.find('[name="book[' + index + '].title"]'))
//                                .formValidation('removeField', $row.find('[name="book[' + index + '].isbn"]'))
//                                .formValidation('removeField', $row.find('[name="book[' + index + '].price"]'));

                        // Remove element containing the fields
                        $row.remove();
                    });
        });
    </script>
    <tr>
        <td width="272"><label>Other Medicines:</label></td>
        <td width="333"
            colspan="2">{{ Form::textarea('medicines', null, array('rows' => '7', 'cols' => '20', 'placeholder' => 'Other medicines...', "style" => "font-size: 1.2em; resize: none; margin-top: 10px") ) }}</td>
    </tr>

    <tr>
        <td width="272"><label>Note:</label></td>
        <td width="333"
            colspan="2">{{ Form::textarea('note', null, array('required' => 'true', 'rows' => '7', 'cols' => '20', 'placeholder' => 'note', "style" => "font-size: 1.2em; resize: none; margin-top: 10px") ) }}</td>
    </tr>

    <tr>
        <td width="272"><label>Procedure</label></td>
        <td width="333"
            colspan="2">{{ Form::textarea('procedure', null, array('required' => 'true', 'rows' => '7', 'cols' => '20', 'placeholder' => 'procedure', "style" => "font-size: 1.2em; margin-top: 2px; resize: none;") ) }}</td>
    </tr>

    <tr>
        @if(isset($appointment))
            <input name="patient_id" type="hidden" value="{{ $appointment->patient->id }}">
            <input name="appointment_id" type="hidden" value="{{ $appointment->id }}">
        @endif

        <td colspan="3">
            <center>
                <div class="btn-wrap">
                    <a class="btn_3" href="javascript:document.getElementById('regForm').reset();" data-type="reset">Reset</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <input type="submit" value="Save" class="submit"/>
                </div>
            </center>
        </td>
    </tr>
</table>

