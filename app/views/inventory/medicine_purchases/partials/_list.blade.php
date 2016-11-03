@if(($medicinePurchases) != null)
    @if(($medicinePurchases->count()))
        @foreach($medicinePurchases as $mP)
            <tr class="row-data">
                <td>{{{ $mP->company_name }}}</td>
                <td>{{{ $mP->business_unit_name }}}</td>
                <td>{{{ $mP->date }}}</td>
                <td>
                    {{--<a href="{{route('prescriptions.show',[$mP->id])}}" class="btn-view-icon fL" title="View Prescription"></a>--}}
                    {{--<span class="fL">&nbsp;|&nbsp;</span><a href="{{route('printPrescription',[$mP->id])}}" class="btn-pdf-icon fL" title="PDF Prescription"></a>--}}
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