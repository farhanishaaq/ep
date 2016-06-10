<h3 class="mT10 mB0 c3">Duty Days View</h3>
<hr class="w95p fL mT0" />
<p class="col-xs-12 fL taR"></p>

<section class="form-Section col-md-12 h695 fL">
    <div class="container w100p">
        <h3 class="mT15 mB0 c3">Duty Days Of Doctor</h3>
        <hr class="w95p fL mT0" />
        <hr class="w95p fL mT0" />

        <div class="form-group">
            <label class="col-xs-5 control-label asterisk">Doctor Name</label>
            <div class="col-xs-6">
                <label class="form-control">{{ $doctor->name }}</label>
                <span id="errorStatus" class="field-validation-msg"></span>
            </div>
        </div>
        <table class="table tblSchedule">
            <thead>
                <tr>
                    <th colspan="3" class="taC">Duty Schedule For Dr. {{ $doctor->name }}</th>
                </tr>
                <tr>
                    <th>Days</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
            @foreach($dutyDays as $dutyDay)
                <tr>
                    <th>{{$dutyDay->day}}</th>
                    <td>{{$dutyDay->start}}</td>
                    <td>{{$dutyDay->end}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>



    </div>
</section>
<div class="col-xs-12 taR pR0 mT20">
    <input type="button" id="cancel" value="Go Back" onclick="goTo('{{URL::previous()}}')" />
</div>
