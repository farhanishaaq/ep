{{--<h3 class="mT10 mB0 c3">Duty Days View</h3>
<hr class="w95p fL mT0" />
<p class="col-xs-12 fL taR"></p>--}}
<section class="form-Section col-md-12 h695 fL">
    <div class="container w100p">
        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Doctor Name</label>
            <div class="col-xs-6">
                <label class="form-control">{{ $doctor->employee->user->full_name }}</label>
                <span id="errorStatus" class="field-validation-msg"></span>
            </div>
        </div>
        <table class="table tblSchedule ">
            <thead>
            <tr>
                <th colspan="4" class="taL">Duty Schedule For Dr. {{ $doctor->employee->user->full_name }}</th>
            </tr>
            <tr>
                <th>Days</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dutyDays as $dutyDay)
                <tr>
                    <th>{{$dutyDay->day}}</th>
                    <td>{{$dutyDay->start}}</td>
                    <td>{{$dutyDay->end}}</td>
                    <td><a href="javascript:void(0)" class="timeSlotLink">View TimeSlots<span class="glyphicon glyphicon-chevron-right"></span></a></td>
                </tr>
                @if($dutyDay->timeSlots->count())
                    <tr class="timeSlotTbl dN">
                        <td colspan="4" class="pL40i">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="3" class="taL">Time Slots</th>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Time Slot</th>
                                    <th>How Many Appointments</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dutyDay->timeSlots as $t)
                                    <tr>
                                        <td>{{$t->id}}</td>
                                        <td>{{$t->slot}}</td>
                                        <td>{{$t->appointments->count()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</section>
<script>
    //****Go To Create Duty Day Form
    $('.timeSlotLink').click(function (e) {
        var elmIcon = $(this).find('span');
        var elm = $(this).parent('td').closest('tr').next('.timeSlotTbl');

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
