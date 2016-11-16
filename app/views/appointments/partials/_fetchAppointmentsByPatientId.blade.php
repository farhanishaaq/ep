
    @if(($appointments) != null)
        @if(($appointments->count()))
            @foreach($appointments as $a)
                <tr>
                    {{--<th>{{$a->id}}</th>--}}
                    <td>{{$a->patient_id}}</td>
                    <td>{{$a->created_at}}</td>
                    <td><a href="javascript:void(0)" class="timeSlotLink" id="timeSlotLink" data="{{ $a->patient_id }}">View Vital Signs<span class="glyphicon glyphicon-chevron-right"></span></a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7"> There is no record found</td>
            </tr>
        @endif
    @else
            <tr>
               
                <td colspan="7"> There is no record found</td>
            </tr>
    @endif

    <script>
        //****Go To Create Duty Day Form
        $('.timeSlotLink').click(function (e) {
            var elmIcon = $(this).find('span');
//            var elm = $(this).parent('td').closest('tr').next('#vitalSignTable');
            var elm = $('#vitalSignTable');

            if(elmIcon.hasClass('glyphicon-chevron-right')){
                elmIcon.removeClass('glyphicon-chevron-right');
                elmIcon.addClass('glyphicon-chevron-down');
            }else{
                elmIcon.removeClass('glyphicon-chevron-down');
                elmIcon.addClass('glyphicon-chevron-right');
            }

            if(elm.hasClass('dN')){

                elm.removeClass('dN');
            }
            else{

                elm.addClass('dN');

            }
        });
    </script>