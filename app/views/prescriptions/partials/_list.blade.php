@if(($prescriptions) != null)
@if(($prescriptions->count()))
@foreach($prescriptions as $prescription)
<tr class="row-data">
    <td>{{{ $prescription->code }}}</td>
    <td>{{{ $prescription->patient->name }}}</td>
    <td>{{{ $prescription->appointment->employee->name }}}</td>
    <td>
        <a href="{{route('prescriptions.show',[$prescription->id])}}" class="btn-view-icon fL" title="View Prescription"></a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="6"> There is no record found</td>
</tr>
@endif
@else
<tr>
    <td colspan="6"> There is no record found</td>
</tr>
@endif

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            if($('#tblRecordsList tr.row-data').length){
                $('#tblRecordsList').DataTable({
                    "columnDefs": [ {
                        "targets": 3,
                        "orderable": false
                    } ]
                });
            }
        } );
    </script>
@stop