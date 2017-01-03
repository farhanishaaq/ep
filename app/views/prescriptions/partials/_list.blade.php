@if(($prescriptions) != null)
@if(($prescriptions->count()))
@foreach($prescriptions as $prescription)
<tr class="row-data">
    <td>{{{ $prescription->code }}}</td>
    <td>{{{ $prescription->appointment->date }}}</td>
    <td>{{{ $prescription->patient->user->full_name }}}</td>
    <td>{{{ $prescription->appointment->doctor->user->full_name }}}</td>
    <td>
        <a href="{{route('prescriptions.show',[$prescription->id])}}" class="btn-view-icon fL" title="View Prescription"></a>
        <span class="fL">&nbsp;|&nbsp;</span>{{ link_to_route('prescriptions.edit', '', [$prescription->id], ['class' => 'btn-edit-icon fL','title'=> 'Edit Record'])}}
        <span class="fL">&nbsp;|&nbsp;</span><a href="{{route('printPrescription',[$prescription->id])}}" class="btn-pdf-icon fL" title="PDF Prescription"></a>
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